// Copyright 2016 Google Inc. All rights reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


import uniq from 'lodash/uniq';
import React from 'react';
import metadata from 'javascript-api-utils/lib/metadata';
import {
  formatValue,
  formatDimension,
  mergeCellWithNeighborIfSame} from './pivot-table';

let columns;
window.addEventListener('load', () => {
  metadata.get().then((c) => {
    columns = c;
  });
});


/**
 * Accepts the report object from the API response and returns a
 * two-dimensional array representing the table rows and cells.
 * @param {Object} report The API response's report object.
 * @return {Array}
 */
function constructTableCellFromReport(report) {
  // Create local aliases.
  let {columnHeader, data: {rows, totals}} = report;

  if (!rows) return;

  let {metricHeaderEntries = []} = columnHeader.metricHeader;
  let {dimensions = []} = columnHeader;

  let metricHeaderRow = 0;
  let resultsEndRow = rows.length;
  let dimensionEndCol = dimensions.length - 1;
  let metricStartCol = dimensionEndCol + 1;
  let metricEndCol = dimensionEndCol + metricHeaderEntries.length;
  let rowCount = rows.length + 2;
  let colCount = dimensions.length + metricHeaderEntries.length;

  // Creates the initial list of cells.
  // This will be a two-dimensional array: cells[<tr>][<td>].
  let cells = [];

  for (let r = 0; r < rowCount; r++) {
    cells[r] = cells[r] || [];

    for (let c = 0; c < colCount; c++) {
      // Creates a new cell object.
      let cell = cells[r][c] = {r, c, classes: [], text: ''};


      if (r === metricHeaderRow) {
        // Metric header rows
        cell.isHeader = true;

        // Primary metric column headers.
        if (c >= metricStartCol && c <= metricEndCol) {
          let metric = metricHeaderEntries[c - metricStartCol].name;
          cell.classes.push('PivotTable-metricHeader');
          cell.text = metric;
        }

        // Dimension results.
        if (c <= dimensionEndCol) {
          let dimensionName = dimensions[c];
          cell.isHeader = true;
          cell.classes.push('PivotTable-dimensionHeader');
          if (c === dimensionEndCol) {
            cell.classes.push('PivotTable-dimensionHeader--lastCol');
          }
          if (r === resultsEndRow) {
            cell.classes.push('PivotTable-dimensionHeader--lastRow');
          }

          cell.text = columns.get(dimensionName).uiName;
          cell.dimensions = dimensionName;
        } else if (c >= metricStartCol && c <= metricEndCol) {
          // Primary metric results.
          let metricName = metricHeaderEntries[c - metricStartCol].name;
          cell.classes.push('PivotTable-value');
          if (r === resultsEndRow) {
            cell.classes.push('PivotTable-value--lastRow');
          }
          cell.text = metricName;
        }
      } else if (r > metricHeaderRow && r <= resultsEndRow ) {
        // Data value rows.
        cell.classes.push('PivotTable-value');
        let row = rows[r - 1];
        if (c <= dimensionEndCol) {
          // Dimension value cells.
          let dimensionValue = row.dimensions[c];
          let dimensionName = dimensions[c];
          cell.text = formatDimension(dimensionValue, dimensionName);
        } else {
          // Metric value cells.
          let value = row.metrics[0].values[c - metricStartCol];
          let type = metricHeaderEntries[c - metricStartCol].type;

          cell.text = formatValue(value, type);
        }
      } else {
        // Totals row
        cell.isHeader = true;
        cell.classes.push('PivotTable-total');
        if (c <= dimensionEndCol) {
          cell.isHeader = true;
          cell.text = cell.dimensions = 'Totals';
          if (c > 0) mergeCellWithNeighborIfSame(cell, cells[r][c - 1]);
        } else if (c >= metricStartCol && c <= metricEndCol) {
          // Metric totals.
          let value = totals[0].values[c - metricStartCol];
          let type = metricHeaderEntries[c - metricStartCol].type;
          cell.text = formatValue(value, type);
        }
      }
    }
  }
  return cells;
}

/**
 * A components that renders the pivot table visualization.
 */
export default class ExpressionTable extends React.Component {

  /**
   * React lifecycyle method below:
   * http://facebook.github.io/react/docs/component-specs.html
   * ---------------------------------------------------------
   */


  /** @return {Object} The React component. */
  render() {
    let {result} = this.props.response;

    if (result) {
      let report = result.reports[0];
      let cells = constructTableCellFromReport(report);

      if (cells) {
        return (
          <div className="PivotTable">
            <table className="PivotTable-table">
              <tbody>
                {cells.map((row, r) => (
                 <tr className="PivotTable-tr" key={r}>
                    {row.map((cell, c) => {
                      if (cell.ref) return undefined;
                      let tag = cell.isHeader ? 'th' : 'td';
                      let props = {key: c};
                      cell.classes.push(`PivotTable-${tag}`);

                      if (cell.colSpan) props.colSpan = cell.colSpan;
                      if (cell.rowSpan) props.rowSpan = cell.rowSpan;

                      props.className = uniq(cell.classes).join(' ');

                      return React.createElement(tag, props, cell.text);
                    })}
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        );
      } else {
        return <p>No data was returned for this request.</p>;
      }
    } else {
      return null;
    }
  }
}

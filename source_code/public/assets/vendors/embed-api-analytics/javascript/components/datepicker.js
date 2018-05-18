// Copyright 2015 Google Inc. All rights reserved.
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


/* global $ */


import React from 'react';
import Icon from './icon.js';


const ANIMATION_DURATION = 200;


/**
 * A components that renders a jQuery datepicker.
 */
export default class Datepicker extends React.Component {

  state = {
    value: this.props.value || '',
  }


  /**
   * Updates the state when the datepicker change event is fired.
   * @param {Event} e
   */
  handleChange = (e) => {
    this.setState({value: e.target.value});
    this.props.onChange.call(this, e);
  }


  /**
   * React lifecycyle methods below:
   * http://facebook.github.io/react/docs/component-specs.html
   * ---------------------------------------------------------
   */


  /**
   * Instantiates the jQuery datepicker instance on the component once it's
   * mounted and adds event listeners.
   */
  componentDidMount() {
    let isShowing = false;
    let opts = {
      changeMonth: true,
      changeYear: true,
      constrainInput: false,
      duration: ANIMATION_DURATION,
      dateFormat: 'yy-mm-dd',
      showOn: false,
      onClose: function() {
        // Use setTimeout to avoid race conditions with the icon click event.
        setTimeout(() => isShowing = false, ANIMATION_DURATION);
      },
    };

    let $input = $(this.refs.input);
    let $icon = $(this.refs.icon);

    $input.datepicker(opts).on('change', (e) => {
      this.handleChange(e);
      this.props.onChange(e);
    });

    $icon.on('click', function() {
      $input.datepicker(isShowing ? 'hide' : 'show');
      isShowing = !isShowing;
    });
  }


  /**
   * Destroys the jQuery datepicker instance when the component is unmounted.
   */
  componentWillUnmount() {
    $(this.refs.input).datepicker('destroy').off();
  }


  /** @return {Object} The React component. */
  render() {
    return (
      <div className="FormFieldAddOn">
        <input
          ref="input"
          className="FormField FormFieldAddOn-field"
          name={this.props.name}
          value={this.state.value}
          onChange={this.handleChange}
          placeholder={this.props.placeholder} />
        <button
          ref="icon"
          type="button"
          className="FormFieldAddOn-item"
          tabIndex="-1"
        >
          <Icon type="event" />
        </button>
      </div>
    );
  }
}

 // Bar chart
 new Chart(document.getElementById("bar-chart"), {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March", "April", "May", "June", "July"],
    datasets: [
    {
      label: "Số lượt xem trang",
      backgroundColor: "#3e95cd",
      data: [2478,5267,734,784,433,2478,5267,734,784,433,3423,12312,2478,5267,734,784,433,2478,5267,734,784,433,3423,12312,2478,5267,734,784,433,2478,5267]
    }
    ]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: 'Số lượt truy cập website'
    }
  }
});

//Read more http://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/

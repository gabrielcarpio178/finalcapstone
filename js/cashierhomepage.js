$(document).ready(function () {
  $("#nav").load("cashiernav.php");

  // $("#content_3").on("click", function () {
  //   window.location = "cashierrequest.php";
  // });
  graph();
});

function graph(){

  const data = {
    labels: ['Non Bago Fee', 'Certificate', 'Cash In'],
    datasets: [{
      data: [2, 3, 4],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)'
      ],
      borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)'
    ],
      borderWidth: 1
    }]
  };

  const bar = {
    type: 'bar',
    data: data,
    options: {
      plugins:{
        legend: {
          display: false  
       },
        stacked100: {
          enable: true,
        },
        title: {
          display: true,
          text: 'BCC Digital Payment Cashier Daily Collection',
        },

      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
    plugins: [ChartDataLabels]
  };

  var bars = $("#bar");
  chart = new Chart(bars, bar);

}

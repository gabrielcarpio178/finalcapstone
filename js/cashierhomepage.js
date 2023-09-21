$(document).ready(function () {
  $("#nav").load("cashiernav.php");

  $("#content_3").on("click", function () {
    window.location = "cashierrequest.php";
  });
});

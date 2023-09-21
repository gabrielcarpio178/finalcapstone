$(document).ready(function () {
  $("#navbar").load("usernav.php");

  $("#btnscan_qr").on("click", function () {
    window.location = "userscanner.php";
  });
});

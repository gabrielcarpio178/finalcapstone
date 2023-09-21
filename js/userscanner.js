$(document).ready(function () {
  $("#navbar").load("usernav.php");
  $("#html5-qrcode-button-camera-permission").addClass("btn btn-primary");
  input_balance();
});

let teller_id;
const scanner = new Html5QrcodeScanner("reader", {
  qrbox: {
    width: 200,
    height: 200,
  },
  fps: 20,
});

scanner.render(success, error);
function success(result) {
  $.ajax({
    url: "../../controller/Dbuserresultqr.php",
    type: "POST",
    data: { result: result },
    cache: false,
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (res) {
      $(".loader").hide();
      if (res == "not_found") {
        $(".message").removeClass("show");
      } else {
        var data = JSON.parse(res);
        $(".teller-store").text(data.store_name);
        $("#result").removeClass("show");
        $("#cancel-scan").hide();
        $(".message").addClass("show");
        teller_id = data.teller_id;
        $("#reader").remove();
        scanner.clear();
      }
    },
  });
}

function error(err) {
  console.error(err);
}

function input_balance() {
  $("#input_balance").on("submit", function (e) {
    e.preventDefault();
    var user_id = $("#user_id").val();
    var input_amount = $("#input_amount").val();
    $.ajax({
      url: "../../controller/Dbuserinsterpurchase.php",
      type: "POST",
      data: {
        teller_id: teller_id,
        user_id: user_id,
        input_amount: input_amount,
      },
      cache: false,
      success: function (res) {
        Swal.fire({
          title: "Send success",
          text: "Amount send " + res,
          icon: "success",
        }).then(function () {
          window.location = "userscanqr.php";
        });
      },
    });
  });
}

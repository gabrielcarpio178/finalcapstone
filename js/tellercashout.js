$(document).ready(function () {
  let amount;
  let teller_id;
  $("#submit_cashout").on("submit", function (e) {
    e.preventDefault();
    teller_id = $("#teller_id").val();
    amount = $("#amount").val();
    if (amount.length == 0) {
      $(".input").append('<p id="message">Please insert amount</p>');
    } else {
      $.ajax({
        url: "../../controller/Dbtellercashout.php",
        type: "POST",
        data: {
          amount: amount,
          teller_id: teller_id,
        },
        cache: false,
        success: function (res) {
          if (res == "invalid_input") {
            $("#amount").addClass("is-invalid");
            $(".input #balance_id").text("Not enough wallet balance");
            $("#message").remove();
          } else if (res == "valid") {
            $("#submit_cashout").hide();
            $("#submit_password").show();
            $(".input #balance_id").remove();
          }
        },
      });
    }
  });

  $("#submit_password").on("submit", function (e) {
    e.preventDefault();
    var password = $("#password").val();
    $.ajax({
      url: "../../controller/Dbtellercashout_insert.php",
      type: "POST",
      data: {
        amount: amount,
        teller_id: teller_id,
        password: password,
      },
      cache: false,
      success: function (res) {
        if (res == "wrong") {
          $("#amount").addClass("is-invalid");
          $(".input_password #balance_id_password").text("Wrong password");
        } else {
          var result = JSON.parse(res);

          var date = new Date(result.date);
          var mounth = date.getMonth();
          var day = date.getDate();
          var year = date.getFullYear();
          var hour = date.getHours();
          var min = date.getMinutes();
          var refnum = result.refnum;
          var monthFull = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ];
          var ampm = hour >= 12 ? 'pm' : 'am';
          hour = hour % 12;
          hour = hour ? hour : 12;
          min = min < 10 ? '0'+min : min;
          var strTime = hour + ':' + min + ' ' + ampm;
  
          $(".amount-cashout").text(result.amount);
          $(".date_submit").text(
            monthFull[mounth] +
              " " +
              day +
              ", " +
              year +
              ", " +
              strTime
          );

          $("#amount").removeClass("is-invalid");
          $(".input #balance_id").remove();
          $("#password").val("");
          $("#message-info").slideDown().show();
          $(".ref_number").text("reference Number: "+refnum);
          var def = parseInt($(".label-amount").text()) - result.amount;
          $(".label-amount").text(def);
        }
      },
    });
  });
});

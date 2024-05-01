$(document).ready(function () {
  $("li a").on("click", function () {
    $("li a").removeClass("onclick");
    $(this).addClass("onclick");
  });

  $("#home").on("click", function (e) {
    e.preventDefault();
    window.location = "tellerhomepage.php";
  });

  $("#icon_menu").on("click", function (e) {
    e.preventDefault();
    window.location = "teller_menu.php";
  });

  $("#order").on("click", function (e) {
    e.preventDefault();
    window.location = "tellerorder.php";
  });

  $("#history").on("click", function (e) {
    e.preventDefault();
    window.location = "tellerhistory.php";
  });

  $("#cash").on("click", function (e) {
    e.preventDefault();
    window.location = "tellercashout.php";
  });

  $("#logout").on("click", function (e) {
    e.preventDefault();

    $.ajax({
      url: "../../controller/Dblogout.php?logout=click",
      beforeSend: function () {
        $(".loader").show();
      },
      success: function (res) {
        $(".loader").hide();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Goodbye!',
          showConfirmButton: false,
          timer: 1500
        }).then(function () {
          window.location = "../../signin.php";
        });
      },
    });
  });
});

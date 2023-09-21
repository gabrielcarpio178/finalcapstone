$(document).ready(function () {
  $("li a").on("click", function () {
    $("li a").removeClass("onclick");
    $(this).addClass("onclick");
  });

  let a = true;
  $("#icon_menu").on("click", function (e) {
    e.preventDefault();
    if (a) {
      $("#sidebar").animate({
        width: "20%",
      });
      $("span").show();
      a = false;
    } else {
      $("#sidebar").animate({
        width: "6%",
      });
      a = true;
      $("span").hide();
    }
  });

  $("#home").on("click", function (e) {
    e.preventDefault();
    window.location = "userhomepage.php";
  });

  $("#history").on("click", function (e) {
    e.preventDefault();
    window.location = "userhistory.php";
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

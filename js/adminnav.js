$(document).ready(function () {

  // $("#usermanagement").hover(function(){
  //   $(".flex-user").slideDown().show();
  // },function(){
  //   $(".flex-user").hide();
  // });

  // $(".flex-user").hover(function(){
  //   $(this).show();
  // },function(){
  //   $(this).hide();
  // });

  $("#user_management").on("click", function (e) {
    e.preventDefault();
    window.location = "adminusermanagement.php";
  });

  $("#btn_post").on('click', function(){
      window.location = 'adminpostanouncement.php';
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

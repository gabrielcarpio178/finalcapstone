$(document).ready(function () {
  $("#navbar").load("usernav.php");

  $(".btn-profile").on("click", function () {
    $(".profile-data").slideDown(function () {
      $(this).show();
    });
  });

  $("#scanqr").on("click", function () {
    window.location = "userscanqr.php";
  });

  $("#close").on("click", function () {
    $(".profile-data").slideUp(function () {
      $(this).hide();
    });
  });

  $("#purchase").on("click", function () {
    window.location = "purchase.php";
  });

  $("#inputpayment").on('click', function(){
    window.location = "userinputpayment.php";
  });

  announcement('Buyer');

});

function announcement(usertype){

  $.ajax({
    url: '../../controller/Dbannoucement_show.php',
    type: 'POST',
    data: {usertype: usertype},
    cache: false,
    success: function(res){
      $("#annoucement").text(res);
      console.log(res);
    }

  });

}

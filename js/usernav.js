$(document).ready(function () {
  isnot_active();
  var user_id = $("#user_id").val();
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
      $(".bell").css({visibility: 'hidden'});
    } else {
      $("#sidebar").animate({
        width: "5%",
      });
      a = true;
      $("span").hide();
      $(".bell").css({visibility: 'visible'});
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
    logout(user_id);
  });

  $("#change_password").on('click', function(){
    window.location="userprofile.php";
  });
});

function logout(user_id){
  $.ajax({
    url: `../../controller/Dblogout.php?logout=${user_id}`,
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (res) {
      console.log(res);
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
}


function isnot_active(){
  var user_id = $("#user_id").val();
  $.ajax({
    url: '../../controller/DbuserGetStatues.php',
    type: 'POST',
    data: {
      user_id : user_id
    },
    cache: false,
    success: function(res){
      var results = JSON.parse(res);
      if(results.statues=='not-active-account'){
        Swal.fire({
          allowOutsideClick: false,
          title: "Account Deactivated",
          text: "Hi, Welcome Back! Your account has been deactivated. Logging in will cancel the deactivation. Are you sure?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            deactivate_data(results.user, 'Activate', false);
          }else{
            logout(user_id);
          }
        });
      }
    }
  })
}



function deactivate_data(user_id, isActive, islogin){
  Swal.fire({
    allowOutsideClick: false,
    title: "Are you sure?",
    text: `You want to ${isActive} your account?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: `Yes, ${isActive} it!`
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../../controller/DbuserUpdateActive.php',
        type: 'POST',
        data: {
          user_id : user_id
        },
        success: function(res){
          Swal.fire({
            position: "center",
            icon: "success",
            title: `${isActive} Success`,
            showConfirmButton: false,
            timer: 1500
          }).then(function(){
            if(islogin==false){
              $("#close_modal").click();
            }else{
              logout(user_id);
            }
            
          });
        }
      });
    }else{
      isnot_active();
    }
  });
  
}
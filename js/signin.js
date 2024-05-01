$(document).ready(function () {

  $("#signup").click(function () {
    window.location = "signup.php";
  });

  $("#forgotform").on('click', function(){
    window.location="forgotEmail.php";
  })
  // submit

  $("#singin").on("submit", function (e) {
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();

    if (username == "" && password == "") {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Missing Input!',
        showConfirmButton: false,
        timer: 1000
      });
    } else {
      $.ajax({
        url: "controller/Dbsignin.php",
        type: "POST",
        data: $(this).serialize(),
        cache: false,
        beforeSend: function () {
          $(".loader").show();
        },
        success: function (res) {
          if (res == "login") {
            $(".loader").hide();          
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Hi! Welcome',
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location = "users/user_buyer/userhomepage.php";
            });
          } else if (res == "firstlogin") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'First time login',
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location = "users/user_buyer/usertype.php";
            });
          } else if (res == "teller") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Hi! Canteen',
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location = "users/teller/tellerhomepage.php";
            });
          } else if (res == "admin") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Hi! Admin',
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location = "users/admin/admindashboard.php";
            });
          } else if (res == "cashier") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Hi! Cashier',
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location = "users/cashier/cashierhomepage.php";
            });
          } else if (res == "wrong") {
            getdatafromApi(username, password);
          }
        },
      });
    }
  });
  let x = true;
  $(".icon-password .icon-pass").on("click", function(){
    if(x==true){

      $(this).html('<i class="fa-solid fa-eye"></i>');
      $('#password').prop('type', 'text');
      x = false;
    }else if(x==false){
      $(this).html('<i class="fa-solid fa-eye-slash"></i>');
      
      $('#password').prop('type', 'password');
      x = true;
    }
});

function getdatafromApi(username, password){
  $.ajax({
    url:'controller/DbgetdataIntoApi.php',
    type: 'POST',
    data: {username: username,
    password: password},
    cache: false,
    success: function(res){
      $(".loader").hide();
      if(res == "login"){
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Welcome!',
          showConfirmButton: false,
          timer: 1500
        }).then(function () {
          window.location = "users/user_buyer/userhomepage.php";
        });
      }else if(res == "Invalid Credentials"){
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Wrong username and password',
          showConfirmButton: false,
          timer: 1000
        })
      }
    }
  })
}
});


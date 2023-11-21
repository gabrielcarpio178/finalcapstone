$(document).ready(function () {
  // change display
  $("#forgotform").click(function () {
    $(".signin-form").css('display', 'none');
    $(".forgot-form").css('display', 'block');
  });

  $("#login").click(function () {
    $(".signin-form").css('display', 'block');
    $(".forgot-form").css('display', 'none');
  });

  $("#input_code").on('keyup', function(){
    var input_length = $(this).val().length;
    if(input_length<=10&&input_length!=0){
      $(".message").text("Number length: "+input_length);
      $(".message").css('color', "black");
    }else if(input_length>10){
      $(".message").text("Number length: "+input_length);
      $(".message").css('color', "red");
    }else if(input_length==0){
      $(".message").text("");
    }
  });

  $("#enter_code").on('submit', function(e){
    e.preventDefault();
    var input_length = $("#input_code").val();
    if(input_length.length==0){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input code',
        showConfirmButton: false,
        timer: 1000
      });
    }else if(input_length.length>10||input_length.length<10){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input 10 digits code',
        showConfirmButton: false,
        timer: 1000
      });
    }else if(input_length.length==10){
      $.ajax({
        url: 'controller/Dbuserchangepass.php',
        type: 'POST',
        data: {reset_code : input_length},
        cache: false,
        beforeSend: function(){
          $(".loader").show();
        },
        success: function (res){
          $(".loader").hide();
          if(res=='invalid'){
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Invalid',
              showConfirmButton: false,
              timer: 1000
            });
          }else{
            $("#close_input_code").click();
          }
        }
      });
    }
  });

  $("#signup").click(function () {
    window.location = "signup.php";
  });

  // submit

  $("#singin").on("submit", function (e) {
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();

    if (username == "" && password == "") {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Messing input!',
        showConfirmButton: false,
        timer: 1000
      });
      // Swal.fire("Failed", "", "error");
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
              title: 'Hi! Welcome Back',
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
              title: 'Hi! teller',
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

  $("#forgot_form").on('submit',function(e){
    e.preventDefault();
    var email_input = $("#email_input").val();
    $.ajax({
      url: 'controller/DbuserForgotPassword.php',
      type: 'POST',
      data: {email_input:email_input},
      cache: false,
      success: function(res){
        if(res=='invalid'){
          $(".loader").hide();
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Email Not Found!',
            showConfirmButton: false,
            timer: 1000
          });
        }else{
          var result = JSON.parse(res);
          getresetcode(result.id, result.usertype);
          $("#btn-forgot-pass").html('<div id="reset_forgot_code" data-bs-toggle="modal" data-bs-target="#forgot_password"> Use Reset Code </div>')
        }
      }
    });
  })

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

function getresetcode(id, user_buyer){

  $.ajax({
    url: 'controller/Dbgetresetcode.php',
    type: 'POST',
    data: {
      id:id,
      user_buyer:user_buyer
    },
    cache: false,
    success: function(res){
      $("#reset_forgot_code").click();
    }
  });
}


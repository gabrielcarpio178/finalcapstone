$(document).ready(function () {
  $("#phonenumber").keyup(function () {
    if (this.value.length == 0) {
      $("#phonenumber")
        .removeClass("form-control form-group-lg is-invalid")
        .addClass("form-control form-group-lg");
    } else if (this.value.length < 11) {
      $("#phonenumber")
        .removeClass("form-control form-group-lg is-valid")
        .addClass("form-control form-group is-invalid");
    } else if (this.value.length > 11) {
      $("#phonenumber")
        .removeClass("form-control form-group-lg is-valid")
        .addClass("form-control form-group is-invalid");
      $("#message").removeClass("valid-feedback").addClass("invalid-feedback");
      $("#message").html(
        "Sorry, input phone number is to long. The digit number must be 11"
      );
    } else {
      $("#phonenumber")
        .removeClass("form-control form-group-lg is-invalid")
        .addClass("form-control form-group is-valid");
    }
  });

  $("#login").click(function () {
    window.location = "signin.php";
  });
  $("#signup").submit(function (e) {
    e.preventDefault();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var gender = $("#gender").val();
    var address = $("#address").val();
    var phonenumber = $("#phonenumber").val();
    var usertype = $("#usertype").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var conpassword = $("#conpassword").val();
    if (
      firstname == "" ||
      lastname == "" ||
      email == "" ||
      phonenumber == "" ||
      username == "" ||
      password == "" ||
      conpassword == ""
    ) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Messing input!',
        showConfirmButton: false,
        timer: 1000
      });
    } else if (password != conpassword) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Password and Confirm Password not match!',
        showConfirmButton: false,
        timer: 1000
      });
    } else if (phonenumber.length != 11) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'invalid number length!',
        showConfirmButton: false,
        timer: 1000
      });
    } else {
      $.ajax({
        url: "controller/Dbsignup.php",
        type: "POST",
        data: $(this).serialize(),
        cache: false,
        beforeSend: function () {
          $(".loader").show();
        },
        success: function (res) {
          if (res == "success") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Add user!',
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location = "signin.php";
            });
          } else if (res == "invalidinput") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Username and Password are already used!',
              showConfirmButton: false,
              timer: 1000
            });
          } else if (res == "contact_already_used") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'contact already used!',
              showConfirmButton: false,
              timer: 1000
            });
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

  let y = true;
  $(".icon-conpassword .icon-conpass").on("click", function(){
    if(y==true){
      $(this).html('<i class="fa-solid fa-eye"></i>');
      $('#conpassword').prop('type', 'text');
      y = false;
    }else if(y==false){
      $(this).html('<i class="fa-solid fa-eye-slash"></i>'); 
      $('#conpassword').prop('type', 'password');
      y = true;
    }
  });



});

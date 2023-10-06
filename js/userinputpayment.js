$(document).ready(function(){
    getbalance();
    $(".eye-icon").hide();
    $("#navbar").load("usernav.php");
    $("#non_bago").on('click', function(){
      $(".insert_amount").attr("id", "non_bago-submit");
      $(".label-form b").text(`Non-Bago Fee`);
      $(".forms-method").css('background-color','rgba(0, 174, 255, 0.253)');
      $("#input").val("");
      $("#input").attr("type","number");
      $(".eye-icon").hide();
      $(".sign-peso").text("₱");
      $('label').show();
    });

    $("#cert_e").on('click', function(){
      $(".insert_amount").attr("id", "cert_e-submit");
      $(".label-form b").text(`
      Certificate of Enrollment`);
      $(".forms-method").css('background-color','rgba(247, 0, 255, 0.253)');
      $("#input").val("");
      $("#input").attr("type","number");
      $(".eye-icon").hide();
      $(".sign-peso").text("₱");
      $('label').show();
    });

    $("#cert_t").on('click', function(){
      $(".insert_amount").attr("id", "cert_t-submit");
      $(".label-form b").text(`Certificate of Transfer Crendentials`);
      $(".forms-method").css('background-color','rgba(255, 0, 55, 0.253)');
      $("#input").val("");
      $("#input").attr("type","number");
      $(".eye-icon").hide();
      $(".sign-peso").text("₱");
      $('label').show();
    });

    let x = true;
    $(".eye-icon").on('click',function(){
      if(x==true){
        $(this).html('<i class="fa-solid fa-eye"></i>');
        $('.input-class').prop('type', 'text');
        x = false;
      }else if(x==false){
        $(this).html('<i class="fa-solid fa-eye-slash"></i>');
        $('.input-class').prop('type', 'password');
        x = true;
      }
    });

});

function inputpassword(){
  $(".insert_amount").attr("id", "password-submit");
  $(".label-form b").html(`<center>Please Enter Your Password</center>`);
  $("#input").attr("type","password");
  $("#input").val("");
  $(".sign-peso").text("");
  $('label').hide();
  $("#submit_amount").text("PROCEED");
  $(".eye-icon").show();
}

function submitpassword(){
  let validate = false;
  $("#password-submit").on('submit', function(e){
    e.preventDefault();
    var password = $("#input").val();
    if(password==""||password.length==0){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Enter Your Password',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      $.ajax({
        url: '../../controller/DbuserInputPayment_password.php',
        type: "POST",
        data: {password : password},
        cache: false,
        success: function(res){
          if(res=="success"){
            validate = true;
          }else{
            validate = false;
          }
        }
      });
    }
  });
  return validate;
}                                                                                                                                                                                                                                                                                                                                                                             44

function submit_non_bago(res){
  $("#non_bago-submit").on('submit', function(e){
    e.preventDefault();
    var input_non_bago = $("#input").val();
    if(input_non_bago<parseInt(res)){
      inputpassword();
      console.log(submitpassword());
      // paymentproceed(input_non_bago, 'non-bago-fee');
    }else{
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }
  });
}

function submit_cert_e(res){
  $("#cert_e-submit").on('submit', function(e){
    e.preventDefault();
    var input_cert_e = $("#input").val();
    if(input_cert_e<parseInt(res)){
      inputpassword();
      // paymentproceed(input_cert_e, 'cert_e');
    }else{
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }
  });
}

function submit_cert_t(res){
  $("#cert_t-submit").on('submit', function(e){
    e.preventDefault();
    var input_cert_t = $("#input").val();
    if(input_cert_t<parseInt(res)){
      inputpassword();
      // paymentproceed(input_cert_t, 'cert_t');
    }else{
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }
  });
}

function getbalance(){
    var amount_balance = false;
    var user_id = $("#user_id").val();
    $.ajax({
      url: '../../controller/Dbgetuserbalance.php',
      type: 'POST',
      data: {user_id:user_id},
      cache: false,
      success: function(res){
        return_value = parseInt(res);
        var amount = `${res}.00`;
        var parts = amount.toString().split(".");
        var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
        $("#walllet_balance").html(`₱${num}`);
        submit_non_bago(res);
        submit_cert_e(res);
        submit_cert_t(res);
      }
    });

  }

  function paymentproceed(input_amount, typeOf_payment){
    
  }
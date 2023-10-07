$(document).ready(function(){
    getbalance();
    $(".eye-icon").hide();
    $("#navbar").load("usernav.php");
    non_bago_form();
    
    $("#non_bago").on('click', function(){
      non_bago_form();
    });

    $("#cert_e").on('click', function(){
      cert_e_form();
    });

    $("#cert_t").on('click', function(){
      cert_t_form();
    });


});

function non_bago_form(){
  $(".forms-method").css('background-color','rgba(0, 174, 255, 0.253)');
  $(".sumbit_password").css('background-color','rgba(0, 174, 255, 0.253)');
  $("#input").val("");
  
  htmlform = `
      <div class="label-form"><b>Non-Bago Fee</b></div>
      <form class="insert_amount" id="">
        <label for="Input">Enter Amount</label>
        <div class="group">
            <div class="sign-peso">₱</div>
            <input type="number" id="input" class="form-control input-class">
        </div>
        <button type="submit" id="submit_amount" class="btn btn-primary">Send</button>
      </form>`
  $(".forms-method").html(htmlform);
  $(".forms-method").fadeIn().show();
  $(".sumbit_password").fadeOut().hide();
  $(".forms-method .insert_amount").attr('id','non_bago-submit');
  getbalance();
}

function cert_e_form(){
  $(".forms-method").css('background-color','rgba(247, 0, 255, 0.253)');
  $(".sumbit_password").css('background-color','rgba(247, 0, 255, 0.253)');
  $("#input").val("");
  htmlform = `
      <div class="label-form"><b>Certificate of Enrollment</b></div>
      <form class="insert_amount">
        <label for="Input">Enter Amount</label>
        <div class="group">
            <div class="sign-peso">₱</div>
            <input type="number" id="input" class="form-control input-class">
        </div>
        <button type="submit" id="submit_amount" class="btn btn-primary">Send</button>
      </form>`
  $(".forms-method").html(htmlform);
  $(".forms-method").fadeIn().show();
  $(".sumbit_password").fadeOut().hide();
  $(".forms-method .insert_amount").attr('id','cert_e-submit');
  getbalance();
}

function cert_t_form(){
  $(".forms-method").css('background-color','rgba(255, 0, 55, 0.253)');
  $(".sumbit_password").css('background-color','rgba(255, 0, 55, 0.253)');
  $("#input").val("");
  htmlform = `
      <div class="label-form"><b>Certificate of Transfer Crendentials</b></div>
      <form class="insert_amount">
        <label for="Input">Enter Amount</label>
        <div class="group">
            <div class="sign-peso">₱</div>
            <input type="number" id="input" class="form-control input-class">
        </div>
        <button type="submit" id="submit_amount" class="btn btn-primary">Send</button>
      </form>`
  $(".forms-method").html(htmlform);
  $(".forms-method").fadeIn().show();
  $(".sumbit_password").fadeOut().hide();
  $(".forms-method .insert_amount").attr('id','cert_t-submit');
  getbalance();
}

function showpassword(){
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
}
function getbalance(){
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

function submit_non_bago(res){
  $("#non_bago-submit").on('submit', function(e){
    e.preventDefault();
    var input_non_bago = $("#input").val();
    if(input_non_bago>parseInt(res)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }else if(input_non_bago.length==0||input_non_bago==""){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input Amount.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      inputpassword(input_non_bago, 'non-bago-fee');
    }
  });
}
function submit_cert_e(res){  
  $("#cert_e-submit").on('submit', function(e){
    e.preventDefault();
    var input_cert_e = $("#input").val();
    if(input_cert_e>parseInt(res)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }else if(input_cert_e.length==0||input_cert_e==""){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input Amount.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      inputpassword(input_cert_e, 'certificate_of_enrollment');
    }
  });
}

function submit_cert_t(res){
  $("#cert_t-submit").on('submit', function(e){
    e.preventDefault();
    var input_cert_t = $("#input").val();
    if(input_cert_t>parseInt(res)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }else if(input_cert_t.length==0||input_cert_t==""){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input Amount.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      inputpassword(input_cert_t, 'cert_transfers');
    }
  });
}

function inputpassword(input_amount, type_payment){

  passwordform = `
      <div class="label-form"><center>Please Enter Your Password</center></div>
      <form class="insert_password" id="password_insert">
          <div class="group">
              <input type="password" id="password_input" class="form-control input-class">
              <div class="eye-icon"><i class="fa-solid fa-eye-slash"></i></div>
          </div>
          <button type="submit" id="submit_password" class="btn btn-primary">Send</button>
      </form>`;
      $(".sumbit_password").html(passwordform);
  $(".forms-method").fadeOut().hide();
  $(".sumbit_password").fadeIn().show();
  showpassword();
  getbalance();

  $("#password_insert").on("submit",function(e){
    e.preventDefault();
    var password = $("#password_input").val();
    if(password.length==0||password==""){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Enter Your Password!',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      $.ajax({
        url:'../../controller/DbuserInputPayment_password.php',
        type: 'POST',
        data: {password : password},
        cache: false,
        success: function(res){
          if(res=='success'){
            input_insertedData(input_amount, type_payment);
          }else{
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'Please Enter Your Password!',
              showConfirmButton: false,
              timer: 1000
            });
          }
        }
      });
    }
  });

}

function input_insertedData(input_amount, type_payment){
  var user_id = $("#user_id").val();
  $.ajax({
    url: '../../controller/Dbuserinsertpayment.php',
    type: 'POST',
    data:{
      user_id : user_id,
      input_amount : input_amount,
      type_payment : type_payment
    },
    cache: false,
    success: function(res){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Payment Sent!',
        showConfirmButton: false,
        timer: 1000
      }).then(function () {
        window.location.reload();
      });
    }
  });
}

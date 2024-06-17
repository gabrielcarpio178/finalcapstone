$(document).ready(function(){
    getbalance();
    $(".eye-icon").hide();
    $("#navbar").load("usernav.php");
    non_bago_form();
    cert_e_form();
    isInBago();
    $("#non_bago").on('click', function(){
      non_bago_form();
      cert_e_form();
      isInBago();
    });

    show_cert(false);
    $("#cert_t").on('click', function(){
      cert_t_form();
      cert_e_form();
    });
    $(".success-message").hide();

    $("input[name='purpose']").change(function() {
      var selected = $(this).val();
      if(selected=='other'){
        $('#text_area').removeAttr("disabled");
      }else{
        $('#text_area').attr("disabled",'disabled');
      }
    });
    
});
function show_cert(x){
  let i = x;
  $("#show_certificate").on('click', function(){
    if(i==false){
      $("#available_display").removeAttr('style');
      $(this).html('<i class="fa-solid fa-angle-up icon-font"></i>');
      i=true;
    }else{
      $("#available_display").attr('style', 'display: none !important;');
      $(this).html('<i class="fa-solid fa-angle-down icon-font"></i>');
      i=false;
    }
  });
}

function non_bago_form(){
  isInBago();
  $(".forms-method").css('background-color','rgba(0, 174, 255, 0.253)');
  $(".sumbit_password").css('background-color','rgba(0, 174, 255, 0.253)');
  htmlform = `
      <div class="d-flex flex-row justify-content-between label-form">
        <b class="category_1"></b>
        <div class="message"></div>
      </div>
      <form class="insert_amount d-flex flex-column gap-3" id="">
        <label for="Input">Enter Amount</label>
        <div class="group">
          <div class="sign-peso">₱</div>
          <input type="number" id="input" class="form-control input-class">
        </div>
        <button type="submit" id="submit_amount" class="btn btn-primary mt-1">Send</button>
      </form>`
  $(".forms-method").html(htmlform);
  $(".forms-method").fadeIn().show();
  $(".sumbit_password").fadeOut().hide();
  $(".forms-method .insert_amount").attr('id','non_bago-submit');
  getbalance();
  $(".forms-method").fadeIn().show();
  $(".success-message").fadeOut().hide(); 
  
}

function isInBago(){
  var user_id = $("#user_id").val();
  $.ajax({
    url: '../../controller/DbusergetAddress.php',
    type: 'POST',
    data: {user_id:user_id},
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      if(result.ispaid=="paid"){
        $("#non_bago-submit :input").val(result.bcc_amount).prop("disabled", "disabled");
        $(".message").text('Paid');
      }else{
        $("#non_bago-submit :input").val(result.bcc_amount).prop("disabled", "disabled");
      }
    }
  });
}

function cert_e_form(){
  var user_id = $("#user_id").val();
  var balance = $("#available_balance").val();
  $.ajax({
    url:'../../controller/Dbuserinputpayment_categories.php',
    type: 'POST',
    data: {user: 'user'},
    cache: false,
    success: function(res){
      var categories = JSON.parse(res);
      //content_1
      var content_1 = `${(categories[0]).cashierRates_amount}.00`;
      var content_1_parts = content_1.toString().split(".");
      var content_1_num = content_1_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (content_1_parts[1] ? "." + content_1_parts[1] : "");
      $(".category_1").text((categories[0]).cashierRatesCertificate);
      // $(".price_1").text(`₱ ${content_1_num}`);
      //content_2
      db_cert = '';
      for(let x = 2; x<categories.length; x++){
        db_cert += `<div class="db-cert" onclick="cert('${(categories[x]).cashierRates_amount}','${(categories[x]).cashierRatesCertificate}')">${(categories[x]).cashierRatesCertificate}</div>
        <hr>`;
      }
      $(".available-data").html(db_cert);
      //content_3
      var content_3 = `${(categories[1]).cashierRates_amount}.00`;
      var content_3_parts = content_3.toString().split(".");
      var content_3_num = content_3_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (content_3_parts[1] ? "." + content_3_parts[1] : "");
      $(".category_2").text((categories[1]).cashierRatesCertificate);
      // $(".price_2").text(`₱ ${content_3_num}`);
      $("#input").val(content_3_num).prop("disabled", "disabled");
      submit_non_bago(balance, (categories[0]).cashierRatesCertificate, user_id, (categories[0]).cashierRates_amount);
      submit_cert_t(balance, (categories[1]).cashierRatesCertificate,  user_id, (categories[1]).cashierRates_amount);
    }
  })
}
function cert(cashierRates_amount, cashierRatesCertificate){
  show_cert(false);
  $("#available_display").attr('style', 'display: none !important;');
  var user_id = $("#user_id").val();
  var balance = $("#available_balance").val();
  $(".forms-method").css('background-color','rgba(247, 0, 255, 0.253)');
  $(".sumbit_password").css('background-color','rgba(247, 0, 255, 0.253)');
  var content = `${cashierRates_amount}.00`;
  var content_parts = content.toString().split(".");
  var content_num = content_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (content_parts[1] ? "." + content_parts[1] : "");
  htmlform = `
      <div class="d-flex flex-column label-form">
        <b>Certificate</b>
        <div>${cashierRatesCertificate}</div>
      </div>
      <form class="insert_amount d-flex flex-column gap-3">
        <label for="Input">Enter Amount</label>
        <div class="group">
            <div class="sign-peso">₱</div>
            <input type="number" id="input" class="form-control input-class">
        </div>
        <button type="submit" id="submit_amount" class="btn btn-primary mt-1">Send</button>
      </form>`;
  
  $(".forms-method").html(htmlform);
  $(".forms-method").fadeIn().show();
  $(".sumbit_password").fadeOut().hide();
  $(".forms-method .insert_amount").attr('id','cert_e-submit');
  getbalance();
  $(".forms-method").fadeIn().show();
  $(".success-message").fadeOut().hide();
  $("#input").val(content_num).prop("disabled", "disabled");
  submit_cert_e(balance, cashierRatesCertificate, user_id, cashierRates_amount);
}
function cert_t_form(){
  $(".forms-method").css('background-color','rgba(255, 0, 55, 0.253)');
  $(".sumbit_password").css('background-color','rgba(255, 0, 55, 0.253)');
  htmlform = `
      <div class="label-form"><b class="category_2"></b></div>
      <form class="insert_amount d-flex flex-column gap-3">
        <label for="Input">Enter Amount</label>
        <div class="group">
            <div class="sign-peso">₱</div>
            <input type="number" id="input" class="form-control input-class">
        </div>
        <button type="submit" id="submit_amount" class="btn btn-primary mt-1">Send</button>
      </form>`
  $(".forms-method").html(htmlform);
  $(".forms-method").fadeIn().show();
  $(".sumbit_password").fadeOut().hide();
  $(".forms-method .insert_amount").attr('id','cert_t-submit');
  getbalance();
  $(".forms-method").fadeIn().show();
  $(".success-message").fadeOut().hide();
  $("#input").val("");
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
      $("#available_balance").val(res);
    }
  });

}

function submit_non_bago(res, non_bago_category ,user_id, amount){
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
    }else if(parseInt(amount)!=parseInt(input_non_bago)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Incorrect Amount Entered.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      inputpassword(input_non_bago, non_bago_category, user_id);
    }
  });
}
function submit_cert_e(res, cert, user_id, amount){  
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
    }else if(parseInt(amount)!=parseInt(input_cert_e)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Incorrect Amount Entered.',
        showConfirmButton: false,
        timer: 1000
      });
    }
    else if(input_cert_e.length==0||input_cert_e==""){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input Amount.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      inputpassword(input_cert_e, cert, user_id);
    }
  });
}

function submit_cert_t(res, torFee, user_id, amount){
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
    }else if(parseInt(amount)!=parseInt(input_cert_t)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Incorrect Amount Entered.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      inputpassword(input_cert_t, torFee, user_id);
    }
  });
}

function inputpassword(input_amount, type_payment, user_id){

  passwordform = `
      <div class="label-form"><center>Please Enter Your Password</center></div>
      <form class="insert_password" id="password_insert">
          <div class="group">
              <input type="password" id="password_input" class="form-control input-class">
              <div class="eye-icon"><i class="fa-solid fa-eye-slash"></i></div>
          </div>
          <button type="submit" id="submit_password" class="btn btn-primary mt-4">Send</button>
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
        data: {
          password : password,
          user_id : user_id
        },
        cache: false,
        success: function(res){
          console.log(res);
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
    beforeSend: function () {
      $(".loader").show();
    },
    success: function(res){
      $(".loader").hide();
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Payment Sent!',
        showConfirmButton: false,
        timer: 1000
      }).then(function () {
        $(".sumbit_password").fadeOut().hide();
        $(".success-message").fadeIn().show();
        var result = JSON.parse(res);
        console.log(result);
        var date = new Date(result.payment_date);
        var mounth = date.getMonth();
        var day = date.getDate();
        var year = date.getFullYear();
        var hour = date.getHours();
        var min = date.getMinutes();
        var monthFull = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "June",
          "July",
          "Aug",
          "Sept",
          "Oct",
          "Nov",
          "Dec",
        ];
        var ampm = hour >= 12 ? 'pm' : 'am';
        hour = hour % 12;
        hour = hour ? hour : 12;
        min = min < 10 ? '0'+min : min;
        var strTime = hour + ':' + min + ampm;
        $(".type-of-payment").text(`${result.payment_type}`);
        $(".payment-total").text(`${result.payment_amount}.00`);
        $(".date").text(`${monthFull[mounth]}/${day}/${year} ${strTime}`);
        $(".ref").text(`${result.payment_ref}`);
        btn_ok();
      });
    }
  });
}

function btn_ok(){
  $("#btn-ok").on('click', function(){
    $(".forms-method").fadeIn().show();
    $(".success-message").fadeOut().hide();
    $("#input").val("");
    getbalance();
    isInBago();
  });
}



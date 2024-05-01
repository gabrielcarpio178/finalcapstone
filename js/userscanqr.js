$(document).ready(function () {
  $("#navbar").load("usernav.php");
  let d = false;
  $("#search_canteen").on('keyup',function(){
    var search = $(this).val();
    if(search.length<=0){
      $(".result").hide();
    }else{
      $(".result").slideDown().show();
       $.ajax({
        url: '../../controller/Dbbuyerseach_teller.php',
        type: 'POST',
        data: {search:search},
        cache: false,
        beforeSend: function(){
          $(".result").html('<div>Searching....</div>');
        },
        success: function(res){
          // console.log(res);
          var data = JSON.parse(res);
          // console.log(data[0]);
          let html = '';
          if(data[0].length==0){
            $(".result").html('<div>No result..</div>');
          }else{
            for(let i = 0; i<data[0].length; i++){
              html += `<div class="teller" onclick = "getseach(${(data[1])[i]})">${(data[0])[i]}</div>
              <hr>`;
            }
            $(".result").html(html);
          }
          if(d==true){
            scanner.clear();
          }
        }
      });
    }

  });

  $("#btnscan_qr").on("click",function(){
    $("main").show();
    $(".demo-btnscan").hide();
    startcamera();
    d = true;
  })
  getbalance();
  input_balance();
  $("#success_okay").on("click", function(){
    $(".success-message").slideUp().hide();
  });

  let l = true;
  $(".pass-icon .icon-pass").on("click", function(){
    if(l==true){
      $(this).html('<i class="fa-solid fa-eye"></i>');
      $('#input_password').prop('type', 'text');
      l = false;
    }else if(l==false){
      $(this).html('<i class="fa-solid fa-eye-slash"></i>');
      $('#input_password').prop('type', 'password');
      l = true;
    }
  });
});


function getbalance(){

  var user_id = $("#user_id").val();
  
  $.ajax({
    url: '../../controller/Dbgetuserbalance.php',
    type: 'POST',
    data: {user_id:user_id},
    cache: false,
    success: function(res){
      $("#balance_amount").val(res);
    }
  });

}
let x = false;
function getseach(teller_qr){
  $.ajax({
    url: "../../controller/Dbuserresultqr.php",
    type: "POST",
    data: { result: teller_qr },
    cache: false,
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (res) {
      $(".loader").hide();
      if(res=='not_found'){
        $(".alert-danger").show();
        x =false;
      }else{
        var data = JSON.parse(res);
        $(".teller-store").text((data.store_name).charAt(0).toUpperCase() + (data.store_name).slice(1));
        input_balance(data.teller_id);
        $("#input_amount").val('');
        $(".demo-btnscan").hide();
        $("#search_canteen").val('');
        $(".result").hide();
        $("main").hide();
        $("#result_password").hide();
        $("#result").show();
        x = true;
      }
    }
  });
  
}


function input_balance(teller_id) {
  $("#input_balance").on("submit", function (e) {
    e.preventDefault();
    var user_id = $("#user_id").val();
    var input_amount = $("#input_amount").val();
    var user_balance = $("#balance_amount").val();
    if(input_amount==""){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Please Input amount.',
        showConfirmButton: false,
        timer: 1000
      });
    }
    else if(parseInt(user_balance) < parseInt(input_amount)){
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Insufficient Balance.',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      $("#result_password").show();
      $("#result").hide();
      $("#submit_password").on("click", function(){
        var password = $("#input_password").val();
        $.ajax({
          url: '../../controller/Dbuserinputpassword.php',
          type: 'POST',
          data: {password: password},
          cache: false,
          success: function(res){
            if(res=='valid'){
              purchasesuccess(teller_id, user_id, input_amount);
            }else{
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Wrong password.',
                showConfirmButton: false,
                timer: 1000
              });
            }
          }
        })
      });
    }
    
  });
}

function purchasesuccess(teller_id, user_id, input_amount){

  $.ajax({
    url: "../../controller/Dbuserinsterpurchase.php",
    type: "POST",
    data: {
      teller_id: teller_id,
      user_id: user_id,
      input_amount: input_amount,
    },
    cache: false,
    success: function (datas) {
      var info = JSON.parse(datas);
      $("#canteen_staff_name").text(info.store_name);
      $(".inserted-amount").text(info.order_amount);
      var date = new Date(info.deadline_time);
      var mounth = date.getMonth();
      var day = date.getDate();
      var year = date.getFullYear();
      var hour = date.getHours();
      var min = date.getMinutes();
      var monthFull = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];
      var ampm = hour >= 12 ? 'pm' : 'am';
      hour = hour % 12;
      hour = hour ? hour : 12;
      min = min < 10 ? '0'+min : min;
      var strTime = hour + ':' + min + ampm;
      $("#datetime").text(monthFull[mounth]+" "+day+", "+year+", "+strTime);
      $("#ref_num").text(info.order_num);
      $(".success-message").slideDown().show();
      $("#input_amount").val('');
      $("#search_canteen").val('');
      $(".result").hide();
      $("main").hide();
      $("#result_password").hide();
      $("#result").hide();
      $("#input_password").val('');
      $(".demo-btnscan").show();
      startcamera();
    }
  });

}
function startcamera(){
    const scanner = new Html5QrcodeScanner("reader", {
    qrbox: {
      width: 200,
      height: 200,
    },
    fps: 20,
  });

  scanner.render(success, error);
  function success(result) {
    getseach(result);
    if(x==true){
      scanner.clear();
    }
  }

  function error(err) {
    console.error(err);
  }
}





$(document).ready(function () {
  $("#nav").load('storenav.php'); 
  getrunningBalance();


});

function getrunningBalance(){
  var user_id = $("#teller_id").val();
  $.ajax({
    url: '../../controller/Dbtellergetrunningbalance.php',
    type: 'POST',
    data: {
      user_id : user_id
    },
    cache: false,
    success: function(res){
      var amount = `${res}.00`;
      var parts = amount.toString().split(".");
      var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
      $(".amount").text(num);
      input_amount(parseInt(res), user_id);
    }
  })
}

function input_amount(balance, user_id){
  form = `
  <form id="input_amount" class="input-form">
    <div class="label-input">
        Request Cash Out
    </div>
    <div class="form-set">
        <div class="insert-data-group">
            <label for="insert_amount">
                Input Amount
            </label>
            <div class="insert-amount">
                <div class="peso-insert">₱</div>
                <input type="number" id="insert_data" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send</button>
    </div>
  </form>`;
  $(".input-amount").html(form);
  submit_cashout(balance, user_id);
}

function input_password(amountInsert, user_id){
  form = `
  <form id="input_password" class="password-form">
    <div class="label-password">
        Please enter your password
    </div>
    <div class="form-set-password">
        <div class="set-password">
            <input type="password" id="insert_password" class="form-control">
            <div class="icon-pass">
                <i class="fa-solid fa-eye-slash"></i>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Proceed</button>
    </div>
  </form>`;
  $(".input-password").html(form);
  $(".input-amount").fadeOut().hide();
  $(".input-password").fadeIn().show();
  showpassword();
  submit_password(amountInsert, user_id);
}

function showpassword(){
  let i = false;
  $(".icon-pass").on('click', function(){
    if(i==false){
      $(this).html('<i class="fa-solid fa-eye"></i>');
      $('#insert_password').prop('type', 'text');
      i = true;
    }else if(i==true){
      $(this).html('<i class="fa-solid fa-eye-slash"></i>');
      $('#insert_password').prop('type', 'password');
      i = false;
    }
  });
}

function submit_cashout(runningBalance, user_id){
  $("#input_amount").on('submit', function(e){
    e.preventDefault();
    var insert_amount = $("#insert_data").val();
    if(insert_amount.length==0){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Please enter amount',
        showConfirmButton: false,
        timer: 1000
      });
    }else if(insert_amount>runningBalance){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Insufficient Balance',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      input_password(insert_amount, user_id);
    }
  })
}

function submit_password(amount, user_id){
  $("#input_password").on('submit', function(e){
    e.preventDefault();
    var insert_password = $("#insert_password").val();
    if(insert_password.length==0){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Please enter password',
        showConfirmButton: false,
        timer: 1000
      });
    }else{
      $.ajax({
        url: '../../controller/DbtellercashoutEnterpass.php',
        type: 'POST',
        data: {
          insert_password : insert_password
        },
        cache: false,
        success: function(res){
          if(res=="success"){
            inputAmountInDatabase(amount, user_id);
          }else if(res=="wrong"){
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Wrong password!',
              showConfirmButton: false,
              timer: 1000
            });
          }
        }
      });
    }
  });
}

function inputAmountInDatabase(amount, user_id){
  $.ajax({
    url: '../../controller/DbtellerCashoutInsertAmount.php',
    type: 'POST',
    data: {
      amount : amount,
      user_id : user_id
    },
    cache: false,
    success: function(){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Sent Success!',
        showConfirmButton: false,
        timer: 1000
      }).then(function(){
        // window.location.reload;
      });
    }
  });
}
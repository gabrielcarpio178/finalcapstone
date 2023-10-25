$(document).ready(function () {
  $("#nav").load("cashiernav.php");
  displayTable('non_bago_table', 0);
  let i;
  $("#non_bago").on("click", function () {
    $(this).addClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 1;
    displayTable('non_bago_table', 0);
  });

  $("#tor").on("click", function () {
    $(this).addClass("fucos-class"); 
    $(".focus-1").removeClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 2;
    displayTable('tor', 0);
  });

  $("#cash_out").on("click", function () {
    $(this).addClass("fucos-class"); 
    $(".focus-1").removeClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 3;
    displayTable('cashout_out_table', 0);
  });

  $("#certificate").on("click", function () {
    $(this).addClass("fucos-class"); 
    $(".focus-1").removeClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 4;
    displayTable('certificate', 0);
  });

  let x = false;
  $("#certificate_show").on("click",function(){
    if(x==false){
      $("#cert-content").removeAttr("style");
      $("#certificate_show").html(`<i class="fa-solid fa-angle-down">`);
      x = true;
    }else{
      $("#cert-content").prop("style", "display: none !important");
      $("#certificate_show").html(`<i class="fa-solid fa-angle-up">`);
      x = false;
    }
    
  })

  addCertificateRow();
  submitcertificate();
  displayRate();
  editSave();
});
let i = 0;
function addCertificateRow(){
  input = 
  `
  <div class="d-flex flex-row justify-content-between align-items-center data_set gap-3 w-100">
    <input type="text" name="category_name[]" class="form-control category_name">
    <input type="number" name="category_amount[]" class="form-control category_amount">
    <input class="btn btn-danger w-25 remove" value="&#10006;" id="remove_row_${i}" onclick="removeRow(${i})">
  </div>
  `;
  $("#input-content").append(input);
  i++;
}

function removeRow(y){
  if(($(`.data_set`).length)!=1){
    $(`#input-content > div > #remove_row_${y}`).parent().children().remove();
    i--;
  }
  
}

function submitcertificate(){
  $("#addCertificate_submit").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: '../../controller/DbcashierAddCerticate.php',
      type: 'POST',
      data: $(this).serialize(),
      cache: false,
      success: function(res){
        if(res=="empty"){
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Empty Row',
            showConfirmButton: false,
            timer: 1000
          })
        }else if(res=="success"){
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Save success',
            showConfirmButton: false,
            timer: 1000
          }).then(function(){
            location.reload(true);
          })
        }
      }
    })
  })
}

function displayRate(){
  $.ajax({
    url: '../../controller/DbcashierGetPaymentRate.php',
    type: 'POST',
    data: {cashier : 'cashier'},
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      if(result.length!=0){
        certificate_rate = '';
        $("#non_bago_fee").text(`${(result[0]).cashierRates_amount}.00`);
        $("#certTCre").text(`${(result[1]).cashierRates_amount}.00`);
        for(let x = 2; x<result.length; x++){
          certificate_rate += `
          <div class="d-flex flex-row justify-content-between w-75">
            <div class="rate-label">${(result[x]).cashierRatesCertificate}</div>
            <div class="rate-label">${(result[x]).cashierRates_amount}.00</div>
          </div>`;
        }
        $("#cert-content").html(certificate_rate);
        editRate(result);
      }
    }
  });
}

function editRate(result){

  edit = 
  `
  <div class="d-flex flex-row justify-content-between align-items-center gap-3 w-100">
    <input type="hidden" name="category_id[]" class="form-control category_amount" value="${(result[0]).cashierRates_id}">
    <input type="text" name="category_name[]" class="form-control category_name" readonly value="Non Bago Fee">
    <input type="number" name="category_amount[]" class="form-control category_amount" value="${(result[0]).cashierRates_amount}">
  </div>
  <div class="d-flex flex-row justify-content-between align-items-center gap-3 w-100">
    <input type="hidden" name="category_id[]" class="form-control category_amount" value="${(result[1]).cashierRates_id}">
    <input type="text" name="category_name[]" class="form-control category_name" readonly value="Transcript of Record">
    <input type="number" name="category_amount[]" class="form-control category_amount" value="${(result[1]).cashierRates_amount}">
  </div>
  `;
  for(let x = 2; x<result.length; x++){
    edit += 
      `
      <div class="d-flex flex-row justify-content-between align-items-center gap-3 w-100">
        <input type="hidden" name="category_id[]" class="form-control category_amount" value="${(result[x]).cashierRates_id}">
        <input type="text" name="category_name[]" class="form-control category_name" value="${(result[x]).cashierRatesCertificate}">
        <input type="number" name="category_amount[]" class="form-control category_amount" value="${(result[x]).cashierRates_amount}">
      </div>
      `;
  }

  $("#edit_input-content").html(edit);
}

function editSave(){
  $("#editCertificate_submit").on("submit",function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you want to update this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, update it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../../controller/DbcashierEditCerticate.php',
          type: 'POST',
          data: $(this).serialize(),
          cache: false,
          success: function(res){
            if(res=="success"){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Save success',
                showConfirmButton: false,
                timer: 1000
              }).then(function(){
                location.reload(true);
              })
            }else{
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Empty Row',
                showConfirmButton: false,
                timer: 1000
              })
            }
          }
        })
      }
    })
  })
}

function displayTable(content, num_page){
  $.ajax({
    url: '../../controller/DbcashierRequest_table.php',
    type: 'POST',
    data: {
      content : content,
      num_page : num_page
    },
    cache: false,
    success: function(res){
      $('.table-content').html(res);
    }
  });
}

function accept(payment_id, cashout){
  Swal.fire({
    title: 'Are you sure?',
    text: "Do want to accept this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, accept it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../../controller/Dbcashieraccept_request.php',
        type: 'POST',
        data: {
          payment_id : payment_id,
          cashout : cashout
        },
        cache: false,
        beforeSend: function () {
          $(".loader").show();
        },
        success: function(res){
          if(res=="success"){
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Accepted Success',
              showConfirmButton: false,
              timer: 1000
            }).then(function(){
              $($(`#${payment_id}`).children()).remove();
            });
          }
        }
      });
    }
  })
}

function deletePayment(payment_id, isCashout){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, cancel it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../../controller/Dbcashierdelete_request.php',
        type: 'POST',
        data: {
          payment_id : payment_id,
          isCashout : isCashout
        },
        cache: false,
        beforeSend: function () {
          $(".loader").show();
        },
        success: function(res){
          if(res=="success"){
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Deleted Success',
              showConfirmButton: false,
              timer: 1000
            }).then(function(){
              $($(`#${payment_id}`).children()).remove();
            });
          }
        }
      });
    }
  })
}

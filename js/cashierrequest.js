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

  $("#cash_out").on("click", function () {
    $(this).addClass("fucos-class"); 
    $(".focus-1").removeClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 2;
    displayTable('cashout_out_table', 0);
  });

  $("#certificate").on("click", function () {
    $(this).addClass("fucos-class"); 
    $(".focus-1").removeClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 3;
    displayTable('certificate', 0);
  });

});

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

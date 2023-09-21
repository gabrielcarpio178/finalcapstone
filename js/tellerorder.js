$("#nav").load("storenav.php");
$(document).ready(function () {
  
  submittime();
  acceptedview();
  pendingview();
  proceed();
  orderview();
  // decline();

});

let i = false;

function acceptedview(){
  $("#btnaccept").on('click', function(){
    $(".info-table").load("../../controller/Dbtelleracceptedtable.php");
    if(i==false){
      $("#btnaccept").addClass("fucos-info");
      $("#btnpending").removeClass("fucos-info");
      i = true;
    }
  });
}

function pendingview(){
  $("#btnpending").on('click', function(){
    $(".info-table").load("../../controller/Dbtellerpendingtable.php");
    if(i==true){
      $("#btnpending").addClass("fucos-info");
      $("#btnaccept").removeClass("fucos-info");
      i = false;
    }
  });
}

function submittime() {
  $("#submitdeadline").on("submit", function (e) {
    e.preventDefault();
    var order_num = $("#order_num").val();
    var inserted_time = $("#inputedtime").val();
    var order_date = $("#order_date").val();
    var current_time = moment().format('YYYY-MM-DD HH:mm:ss');
    var deadline = moment(current_time, "YYYY-MM-DD HH:mm:ss").add(inserted_time, 'minutes').format('YYYY-MM-DD HH:mm:ss');
    if(inserted_time!=""){
      $.ajax({
        url: "../../controller/Dbtellerinserttime.php",
        type: "POST",
        data: {
          deadline: deadline,
          order_date: order_date
        },
        cache: false,
        success: function (res) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: "Deadline Time And Date " + res,
            showConfirmButton: false,
            timer: 1000
          }).then(function () {
            $(".info-table").load("../../controller/Dbtellerpendingtable.php");
            $("#btnpending").addClass("fucos-info");
            $("#btnaccept").removeClass("fucos-info");
            i = false;
            var pending = $(".pending-number").text();
            var approved = parseInt($(".approved-number").text());
            $(".pending-number").text(pending-1);
            $(".approved-number").text(approved+1);
            $("#close_modal_summary").click();
            $("#inputedtime").val("");
          });
        },
      });
    }else{
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: "Please input",
        showConfirmButton: false,
        timer: 1000
      })
    }
  });

}

function orderview(){

  $(".info").on('click', function(){

    var order_num = $(this).attr('id');
    $.ajax({
      url: "../../controller/Dbshoworder_info.php",
      type: "POST",
      data: {
        order_num : order_num
      },
      cache: false,
      success: function (res) {
       $(".table-order").html(res);
      },
    });

    decline(order_num);
    declinereserve(order_num);

  })

}

function viewaccepted(order_num){
    $.ajax({
      url: "../../controller/Dbshoworder_info.php",
      type: "POST",
      data: {
        order_num : order_num
      },
      cache: false,
      success: function (res) {
       $(".procced_info").html(res);
      },
    });

    decline(order_num);
    declinereserve(order_num);

}

function proceed() {

  $("#proceed").on("click", function(){
    var order_ref = $(".order_number").text();
    Swal.fire({
      title: "Are you sure?",
      text: "This order is receive to a customer?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
    }).then((result) => {
      if (result.isConfirmed) {
  
        $.ajax({
          url: "../../controller/Dbtellerproceed.php",
          type: "POST",
          data: {
            order_ref: order_ref,
          },
          cache: false,
          success: function (res) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "Order Proceed!",
                showConfirmButton: false,
                timer: 1000
            }).then(function () {
                $(".info-table").load("../../controller/Dbtelleracceptedtable.php");       
                $("#btnaccept").addClass("fucos-info");
                $("#btnpending").removeClass("fucos-info");
                i = true;
                var approved = $(".approved-number").text();
                $(".approved-number").text(approved-1);
                $("#close_modal").click();
            });
          },
        });

      }
    });
  })
  
}
function decline(order_num) {

  $("#decline_order").on("click", function(){
      Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to delete this order!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/Dbteller_delete_order.php",
          type: "POST",
          data: { order_num: order_num },
          cache: false,
          success: function (res) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: "Order has been deleted!",
              showConfirmButton: false,
              timer: 1000
            }).then(function () {
              $(".info-table").load("../../controller/Dbtellerpendingtable.php");
              $("#btnpending").addClass("fucos-info");
              $("#btnaccept").removeClass("fucos-info");
              i = false;
              var pending = $(".pending-number").text();
              $(".pending-number").text(pending-1);
              $("#close_modal_summary").click();
              window.location.reload();
            });
          },
        });
      }
    });

  });


  
}

function declinereserve(order_num) {

  $("#decline_reserve").on("click", function(){

    $.ajax({
        url: "../../controller/Dbtellerdeleteserve.php",
        type: "POST",
        data: {
          order_num: order_num,
        },
        cache: false,
        success: function (res) {
          if (res == "success") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: "Order Pending",
              showConfirmButton: false,
              timer: 1000
            }).then(function () {
              
              $(".info-table").load("../../controller/Dbtelleracceptedtable.php");       
              $("#btnaccept").addClass("fucos-info");
              $("#btnpending").removeClass("fucos-info");
              i = true;
              var pending = parseInt($(".pending-number").text());
              var approved = $(".approved-number").text();
              $(".pending-number").text(pending+1);
              $(".approved-number").text(approved-1);
              $("#close_modal").click();

            });
          }
        },
      });

  });

}

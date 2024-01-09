$(document).ready(function(){
  $("#nav").load('storenav.php'); 
  getContentData('pending');
  count_order();
});

function count_order(){
  $.ajax({
    url: '../../controller/Dbtellercountorder.php',
    type: 'POST',
    data: {teller : 'teller'},
    cache: false,
    success: function(res){
      var counts = JSON.parse(res);
      $("#count_pending").text(counts.pending);
      $("#count_accepted").text(counts.accepted);
    }
  })
}

function getContentData(type_info){
  count_order();
  $.ajax({
    url: '../../controller/DbtellerOrder.php',
    type: 'POST',
    data: {type_info : type_info},
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      table_info = '';
      let count_pending = parseInt(0);
      let count_accepted = parseInt(0);
      if(result.length!=0){
        for(let i = 0; i<result.length; i++){
          if((result[i]).order_set_time=='not_set'){
            count_pending++;
          }else{
            count_accepted++;
          }
          var date = new Date((result[i]).order_time);
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
          var ampm = hour >= 12 ? 'PM' : 'AM';
          hour = hour % 12;
          hour = hour ? hour : 12;
          min = min < 10 ? '0'+min : min;
          var strTime = hour + ':' + min + ampm;
          var insert_date = `${monthFull[mounth]}-${day}-${year} ${strTime}`;
          var amount = `${(result[i]).total_amount}.00`;
          var parts = amount.toString().split(".");
          var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
  
          if((result[i]).order_set_time!='not_set'){
            var date = new Date((result[i]).order_set_time);
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
            var ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12;
            hour = hour ? hour : 12;
            min = min < 10 ? '0'+min : min;
            var deadline_time = " Deadline-time: "+hour + ':' + min + ampm;
          }else{
            var deadline_time = "";
          }
          table_info += `
          <div class="d-flex flex-row align-items-center justify-content-between content_data" onclick="getorder_numModal('${(result[i]).order_num}', '${(result[i]).statues}')">
            <div class="d-flex flex-column">
              <div class="d-flex flex-row">
                <b>
                  ${(result[i]).name}
                </b>
                <div>
                  , ${(result[i]).department}
                </div>
              </div>
              <div>
                ${insert_date} ${deadline_time}
              </div>
            </div>
            <div>
              ₱${num}
            </div>
          </div>
          `;
        }
        $("#table_content").html(table_info);
      }else{
        $("#table_content").html('No Record');
      }
    }
  })
}

function getorder_numModal(order_num, statues){
  $.ajax({
    url: '../../controller/DbtellerGetOrder.php',
    type: 'POST',
    data: {
      order_num : order_num
    },
    cache: false,
    success: function(res){
      var data_result = JSON.parse(res);
      if(statues=='not_set'){
        struc_table = `
        <table class="table table-hover">
          <thead>
              <tr>
                  <th scopre="col">
                    <input type="checkbox" class="form-check-input" name="select-all" id="select_all" onclick="toggle(this)">
                  </th>
                  <th scope="col">Product</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Quantity</th>
              </tr>
          </thead>
          <tbody class="table-body-data" id="table_body">

          </tbody>
        </table>
        `;
      }else{
        struc_table = `
        <div id="ref_no" class="d-flex flex-row gap-2 ">
        <div class="label">Reference No.</div>
        <div>${order_num}</div>
        </div>
        <table class="table table-hover">
          <thead>
              <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Quantity</th>
              </tr>
          </thead>
          <tbody class="table-body-data" id="table_body">

          </tbody>
        </table>
        `;
      }
      
      $("#table-content").html(struc_table);
      table_order = "";
      let total_amount = parseInt(0);
      let total_qty = parseInt(0);
      for(let i = 0; i<data_result.length; i++){
        if(statues=="not_set"){
          total_amount += parseInt((data_result[i]).order_amount);
          total_qty += parseInt((data_result[i]).order_quantity);
          table_order += `
            <tr>
              <td>
                <input type="checkbox" class="form-check-input" name="type" value="${(data_result[i]).order_id}"/>
              </td>
              <td>
                <div class="d-flex flex-column">
                  <b>${(data_result[i]).orderproduct_name}</b>
                  <p>${(data_result[i]).order_productcategory}</p>
                </div>
              </td>
              <td>
                <b>${(data_result[i]).order_amount}.00<b>
              </td>
              <td>
                <b>${(data_result[i]).order_quantity}<b>
              </td>
            </tr>
          `;
        }else{
          if((data_result[i]).statues!='DECLANE'){
            total_amount += parseInt((data_result[i]).order_amount);
            total_qty += parseInt((data_result[i]).order_quantity);
            table_order += `
              <tr>
                <td>
                  <div class="d-flex flex-column">
                    <b>${(data_result[i]).orderproduct_name}</b>
                    <p>${(data_result[i]).order_productcategory}</p>
                  </div>
                </td>
                <td>
                  <b>${(data_result[i]).order_amount}.00<b>
                </td>
                <td>
                  <b>${(data_result[i]).order_quantity}<b>
                </td>
              </tr>
            `;
          }
        }
      }
      td_html = (statues=='not_set')?'<td></td>':'';
      table_order += `
      <tr>
        ${td_html}
        <td class="d-flex flex-column">
          <b>TOTAL</b>
        </td>
        <td>
          <b>${total_amount}.00<b>
        </td>
        <td>
          <b>${total_qty}<b>
        </td>
      </tr>
      `;
      if(statues=='not_set'){
        $(".accent_btn").text('Accept');
        $(".accent_btn").attr("data-bs-toggle", "modal").attr("data-bs-target", "#insert_time").removeAttr('id');
        insert_date(order_num);
      }else{
        $(".accent_btn").text('Proceed');
        $(".accent_btn").removeAttr("data-bs-toggle").removeAttr("data-bs-target").attr('id', `${order_num}`);
        procced(order_num);
      }
      $(".decline").attr("onclick", `declane('${order_num}')`);
      $("#table_body").html(table_order);
      $("#order_info").click();

    } 
  })
  
}

function toggle(source) {
  var checkboxes = $('input[type="checkbox"]');
  for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
          checkboxes[i].checked = source.checked;
  }
}

function insert_date(order_num){
  $("#submitdeadline").on("submit", function (e) {
    e.preventDefault();
    var inserted_time = $("#inputedtime").val();
    var current_time = moment().format('YYYY-MM-DD HH:mm:ss');
    var deadline = moment(current_time, "YYYY-MM-DD HH:mm:ss").add(inserted_time, 'minutes').format('YYYY-MM-DD HH:mm:ss');
    if(inserted_time!=""){
      var selected_array = [];
      $("input:checkbox[name=type]:checked").each(function(){
        // insertOrder($(this).val(), order_num, deadline);
        // console.log($(this).val());
        selected_array.push($(this).val());
      });
      insertOrder(selected_array, order_num, deadline);
    }
  })
}

function insertOrder(order_id, order_num, deadline){
  $.ajax({
    url: "../../controller/Dbtellerinserttime.php",
    type: "POST",
    data: {
      order_id: order_id, 
      deadline: deadline,
      order_num : order_num
    },
    cache: false,
    success: function (res) {
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Order Accepted',
        showConfirmButton: false,
        timer: 1000
      }).then(function(res){
        // $("#close_time").click();
        getContentData('pending');
      })
    },
  });
}



function procced(order_num){
  $(`#${order_num}`).on('click', function(){
    var order_ref = $(this).attr('id');
    $.ajax({
      url: '../../controller/Dbtellerproceed.php',
      type: 'POST',
      data: {order_ref : order_ref},
      cache: false,
      success: function(){
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Order Success!',
          showConfirmButton: false,
          timer: 1000
        }).then(function(){
          $("#close_modal_summary").click();
          getContentData('accepted');
        })
        
      }
    })
  })
}

function declane(order_num){
  $.ajax({
    url: '../../controller/DbtellerDecline.php',
    type: 'POST',
    data: {order_num : order_num},
    cache: false,
    success: function(res){
      if(res=='ACCEPTED'){
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Order Pending',
          showConfirmButton: false,
          timer: 1000
        }).then(function(){
          getContentData('accepted');
          $("#close_modal_summary").click();
        });
      }else{
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Order Decline',
          showConfirmButton: false,
          timer: 1000
        }).then(function(){
          getContentData('pending');
          $("#close_modal_summary").click();
        });
      }
    }
  })
}
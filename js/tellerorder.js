$(document).ready(function(){
  $("#nav").load('storenav.php'); 
  getContentDate('pending');
});

function getContentDate(type_info){
  $.ajax({
    url: '../../controller/DbtellerOrder.php',
    type: 'POST',
    data: {type_info : type_info},
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      table_info = '';
      for(let i = 0; i<result.length; i++){
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
        <div class="d-flex flex-row align-items-center justify-content-between content_data" onclick="getorder_numModal('${(result[i]).order_num}')">
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
    }
  })
}

function getorder_numModal(order_num){
  $.ajax({
    url: '../../controller/DbtellerGetOrder.php',
    type: 'POST',
    data: {
      order_num : order_num
    },
    cache: false,
    success: function(res){
      var data_result = JSON.parse(res);
      table_order = "";
      let total_amount = parseInt(0);
      let total_qty = parseInt(0);
      for(let i = 0; i<data_result.length; i++){
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
              <b>${(data_result[i]).order_amount}<b>
            </td>
            <td>
              <b>${(data_result[i]).order_quantity}<b>
            </td>
          </tr>
        `;
      }
      table_order += `
      <tr>
        <td class="d-flex flex-column">
          <b>TOTAL</b>
        </td>
        <td>
          <b>${total_amount}<b>
        </td>
        <td>
          <b>${total_qty}<b>
        </td>
      </tr>
      `;
      insert_date(order_num);
      $("#table_body").html(table_order);
      $("#order_info").click();
    } 
  })
  
}

function insert_date(order_num){
  $("#submitdeadline").on("submit", function (e) {
    e.preventDefault();
    var inserted_time = $("#inputedtime").val();
    var current_time = moment().format('YYYY-MM-DD HH:mm:ss');
    var deadline = moment(current_time, "YYYY-MM-DD HH:mm:ss").add(inserted_time, 'minutes').format('YYYY-MM-DD HH:mm:ss');
    if(inserted_time!=""){
      $.ajax({
        url: "../../controller/Dbtellerinserttime.php",
        type: "POST",
        data: {
          deadline: deadline,
          order_num : order_num
        },
        cache: false,
        success: function (res) {
          console.log(res);
        },
      });
    }
  })
}
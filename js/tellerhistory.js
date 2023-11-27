let name_ = 'all';
let department_ = 'all';
let date_filter_ = 'all'
$(document).ready(function(){
  $("#nav").load("storenav.php");
  getdatatable(name_, department_, date_filter_);

  $(".txt, #department, .checkbox").each(function() {
    $(this).change(function(){
      department_ = $(this).val();
      getdatatable(name_, department_, date_filter_);
    })
  });

  $("#name").on('keyup', function(){
    name_ = $(this).val();
    getdatatable(name_, department_, date_filter_);
  });

  $(".txt, #date, .checkbox").each(function() {
    $(this).change(function(){
      date_filter_ = $(this).val();
      getdatatable(name_, department_, date_filter_);
    })
  });

});

function getdatatable(name, department, date_filter){
  $.ajax({
    url: '../../controller/Dbtellergethistortdata.php',
    type: 'POST',
    data: {
      name : name,
      department : department,
      date_filter : date_filter
    },
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      if(result.length==0){
        $(".table-info").text("no result");
      }else{
        data_content = "";
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
          data_content += `
            <div class="d-flex flex-row align-items-center justify-content-between content_data" onclick="getorder_numModal(${(result[i]).order_num})">
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
                  ${insert_date}
                </div>
              </div>
              <div>
                ₱${num}
              </div>
            </div>
          `;
        }
        $(".table-info").html(data_content);
      }
    }
  })
}

function getorder_numModal(order_num){
  $.ajax({
    url: '../../controller/DbtellergetorderByorder_num.php',
    type: 'POST',
    data: {order_num : order_num},
    cache: false,
    success: function(res){
      var data_result = JSON.parse(res);
      $(".name").text((data_result[0]).name);
      $("#department_info").text((data_result[0]).department);
      $("#student_id").text((data_result[0]).user_data_id);
      var date = new Date((data_result[0]).date);
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
      var amount = `${(data_result[0]).total_amount}.00`;
      var parts = amount.toString().split(".");
      var num = "₱"+parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
      $("#date_time").text(insert_date);
      $("#amount").text(num);
      $("#reference_num").text((data_result[0]).ref_num);
      $("#btn_showModal").click();
    }
  })
}

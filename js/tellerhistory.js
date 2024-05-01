let name_ = 'all';
let department_ = 'all';
let date_filter_ = 'all'
let statues = '';
$(document).ready(function(){
  $("#nav").load("storenav.php");
  getdatatable(name_, department_, date_filter_, statues);
  $("#filter_cashout").prop("style","display: none !important");
  $(".txt, #department, .checkbox").each(function() {
    $(this).change(function(){
      department_ = $(this).val();
      getdatatable(name_, department_, date_filter_, statues);
      if(department_!='CASHOUT'){
        $("#filter_cashout").prop("style","display: none !important");
      }else{
        $("#filter_cashout").prop("style","display: block !important");
      }
    })
  });

  $("#name").on('keyup', function(){
    name_ = $(this).val();
    getdatatable(name_, department_, date_filter_ , statues);
  });

  $(".txt, #date, .checkbox").each(function() {
    $(this).change(function(){
      date_filter_ = $(this).val();
      getdatatable(name_, department_, date_filter_, statues);
    })
  });

  $(".txt, #statues, .checkbox").each(function() {
    $(this).change(function(){
      statues = $(this).val();
      getdatatable(name_, department_, date_filter_, statues);
    })
  });

});


function getdatatable(name, department, date_filter, statues){
  $.ajax({
    url: '../../controller/Dbtellergethistortdata.php',
    type: 'POST',
    data: {
      name : name,
      department : department,
      date_filter : date_filter,
      statues: statues
    },
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      // console.log(res);
      result.sort(function(a, b){
        let d1 = new Date(a.order_time), d2 = new Date(b.order_time);
          return d2 - d1;
      });
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
          if(((result[i]).type_content)!='cashout'){
            type_content =(result[i]).name;
          }else{
            type_content = 'CASHOUT';
          }
          data_content += `
            <div class="d-flex flex-row align-items-center justify-content-between content_data" onclick="getorder_numModal('${(result[i]).order_num}', '${(result[i]).type_content}')">
              <div class="d-flex flex-column">
                <div class="d-flex flex-row">
                  <b>
                    ${type_content}
                  </b>
                  <div style="text-transform: uppercase;">
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

function getorder_numModal(order_num, type_content){
  $.ajax({
    url: '../../controller/DbtellergetorderByorder_num.php',
    type: 'POST',
    data: {
      order_num : order_num,
      type_content : type_content
    },
    cache: false,
    success: function(res){
      var data_result = JSON.parse(res);
      $(".name").text((data_result[0]).name);
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
      var href = `../../tellerhistoryPrint.php?order_num=${order_num}&&type_content=${type_content}`;
      $("#download_recept").prop("href", href);
      $("#date_time").text(insert_date);
      $("#amount").text(num);
      $("#reference_num").text((data_result[0]).ref_num);
      $("#btn_showModal").click();
      if(type_content!='cashout'){
        student_class = `
          <label for="student_id">User ID: </label>
          <p id="student_id" class="student_id">${(data_result[0]).statues}</p>
        `;
        department_class = `
          <label for="department_info">Department: </label>
          <p id="department_info" class="department_info">${(data_result[0]).department}</p>
        `;
        payment_for = `
          <label for="payment_for">Payment for: </label>
          <p id="payment_for">Purchase</p>  
        `;
        $("#student_class").html(student_class);
        $("#department_class").html(department_class);
        $("#payment_for").html(payment_for);
      }else{
        student_class = `
          <label for="student_id">Status: </label>
          <p id="student_id" class="student_id" style="text-transform: uppercase;">${(data_result[0]).statues}</p>
        `
        payment_for = `
          <label for="payment_for">Payment for: </label>
          <p id="payment_for">CASHOUT</p>  
        `;
        $("#student_class").html(student_class);
        $("#department_class").html('');
        $("#payment_for").html(payment_for);
      }
    }
  })
}

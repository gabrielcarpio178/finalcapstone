$(document).ready(function () {
  $("#navbar").load("usernav.php");

  $(".btn-profile").on("click", function () {
    $(".profile-data").slideDown(function () {
      $(this).show();
    });
  });

  $("#scanqr").on("click", function () {
    window.location = "userscanqr.php";
  });

  $("#close").on("click", function () {
    $(".profile-data").slideUp(function () {
      $(this).hide();
    });
  });

  $("#purchase").on("click", function () {
    window.location = "purchase.php";
  });

  $("#inputpayment").on('click', function(){
    window.location = "userinputpayment.php";
  });

  $("#send_money").on('click',function(){
    window.location = "usersend_money.php";
  });

  $("#accountbalance").on('click', function(){
    window.location = "useraccount_balance.php";
  });

  notification();
  
  $(".bell").on('click', function(){
    
    $(".notification").slideToggle();
    notification();

  });

  announcement('Buyer');
  getbalance();
});

function announcement(usertype){

  $.ajax({
    url: '../../controller/Dbannoucement_show.php',
    type: 'POST',
    data: {usertype: usertype},
    cache: false,
    success: function(res){
      $("#annoucement").text(res);
    }

  });

}


function notification(){
  var user_id = $("#user_id").val();
  var date = new Date();
  var current_time = (parseInt(date.getHours())*60)+parseInt(date.getMinutes());
  let currentDay= String(date.getDate()).padStart(2, '0');
  let currentMonth = String(date.getMonth()+1).padStart(2,"0");
  let currentYear = date.getFullYear();
  let currentDate = `${currentDay}-${currentMonth}-${currentYear}`;
  let gender_info = '';
  let store_name = '';
  let statues = '';
  let time = '';
  let data_show = '';
  let none_view = "";
  $.ajax({
    url: '../../controller/Dbusernotification.php',
    type: 'POST',
    data: {user_id : user_id},
    cache: false,
    success: function(res){
      var data = JSON.parse(res);
      data.sort(function(a, b){
        let d1 = new Date(a.date), d2 = new Date(b.date);
          return d2 - d1;
      });
      var count = 0;
      for(let i = 0; i<data.length; i++){
        if((data[i]).isSeen=='0'){
          count++;
        }
        var date = new Date((data[i]).date);
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
        var insert_date = `${monthFull[mounth]}-${day}-${year} ${strTime}`;
        if((data[i]).isSeen=='0'){
          none_view = "none_view";
        }else{
          none_view = "";
        }  
        
        if((data[i]).type=='cashin'){
          data_show += `
            <div class="message_info ${none_view}" onclick="update('${(data[i]).cashin_id}','${user_id}','${(data[i]).type}')" id="${(data[i]).cashin_id}">
              <div class="messages">
                <img src ='../../image/avatar.jpg' class="canteen-staff-pp">
                <div class="message-order">
                  <b>${(data[i]).cashin_amount}</b> pesos have been successfully added to your digital wallet.
                </div>
              </div>
              <p class="date">${insert_date}</p>
            </div>
          `;
        }
        else if((data[i]).type=='purchase'){
          var image = (data[0][i]=='male')? '../../image/avatar.jpg':'../../image/female_avatar.png';
          gender_info += "<img src='"+image+"'>";   
          let db_day = String(new Date((data[i]).date).getDate()).padStart(2, '0');
          let db_month = String(new Date((data[i]).date).getMonth()+1).padStart(2,"0");
          let db_year = new Date((data[i]).date).getFullYear();
          let db_date = `${db_day}-${db_month}-${db_year}`;    
          var database_mins =  parseInt(parseInt(new Date((data[i]).date).getHours())*60+parseInt(new Date((data[i]).date).getMinutes()));
          var deadline = database_mins-current_time;
          var ago_hours = Math.floor((database_mins+current_time)/60);
          var ago_mins = (database_mins+current_time) % 60;
          var day = Math.floor(ago_hours/24);
          var hours = Math.floor(((ago_hours/24)-day)*24);
          var mins = parseInt((((ago_hours/24)-day)*24) % 60);
          
          if(currentDate==db_date){
              if(deadline<=0){
                var deadline = 0;
              }
          }else{
            var deadline = 0;
            
          }

          if((data[i]).statues=="ACCEPTED"&&deadline!=0){
            data_show += `
            <div class="message_info ${none_view}" onclick="update('${(data[i]).order_num}','${user_id}','${(data[i]).type}')">
                <div class="messages">
                  <img src ='${image}' class="canteen-staff-pp">
                  <div class="message-order"><b>${(data[i]).store_name}</b> accept your order Pick up time <b>${deadline} minutes.</b> Otherwise your order will automatically be cancelled.</div>
                </div>
                <p class="date">${insert_date}</p>
              </div>`;
          }else if((data[i]).statues=="ACCEPTED"&&deadline==0){
            data_show += `
            <div class="message_info ${none_view}" onclick="update('${(data[i]).order_num}','${user_id}','${(data[i]).type}')" id="${(data[i]).order_num}">
              <div class="messages">
                <img src ='${image}' class="canteen-staff-pp">
                <div class="message-order">Failed to pick up within the time scheduled <b>${(data[i]).store_name}</b> cancelled your order.</div>
              </div>
              <p class="date">${insert_date}</p>
            </div>`;
          }else if((data[i]).statues=="CANCELED"){
            data_show += `
            <div class="message_info ${none_view}" onclick="update('${(data[i]).order_num}','${user_id}','${(data[i]).type}')" id="${(data[i]).order_num}">
              <div class="messages">
                <img src ='${image}' class="canteen-staff-pp">
                <div class="message-order">Failed to pick up with some reason <b>${(data[i]).store_name}</b>.</div>
              </div>
              <p class="date">${insert_date}</p>
            </div>`;
          }else if((data[i]).statues=="PROCEED"){
              data_show += `
              <div class="message_info ${none_view}" onclick="update('${(data[i]).order_num}','${user_id}','${(data[i]).type}')" id="${(data[i]).order_num}">
                <div class="messages">
                  <img src ='${image}' class="canteen-staff-pp">
                  <div class="message-order">Successfully paid and picked up the order from the <b>${(data[i]).store_name}</b>.</div>
                </div>
                <p class="date">${insert_date}</p>
              </div>`;
            }else if(data[1][i]=="PURCHASE"&&deadline==0){
              data_show += `
                <div class="message_info onclick="update('${(data[i]).order_num}','${user_id}','${(data[i]).type}')" id="${(data[i]).order_num}">
                  <div class="messages">
                    <img src ='${image}' class="canteen-staff-pp">
                    <div class="message-order">Successfully send payment.</div>
                  </div>
                  <p class="date">${insert_date}</p>
                </div>`;
            }

        }

      }
      
      $(".count-number").text(count);
      $(".noti-data").html(data_show);
    }
  });  
  multipleseen(user_id);
  
}

function update(num, user_id, type){
  $.ajax({
    url: '../../controller/Dbbuyerupdate_statues.php',
    type: 'POST',
    data: {
      user_id : user_id,
      num : num,
      type : type
      },
    cache: false,
    success: function(res){
      var result = JSON.parse(res);
      if(result[1]=='1'){
        $(`#${result[0]}`).addClass("none_view");
        $(".count-number").text(parseInt($(".count-number").text())+1);
      }else if(result[1]=='0'){
        $(`#${result[0]}`).removeClass("none_view");
        $(".count-number").text(parseInt($(".count-number").text())-1);
      }
    }
  });
}

function multipleseen(user_id){
  $(".button").on("click", function(){
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to clear this all!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, clear it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../../controller/Dbbuyermultipleseen.php',
          type: 'POST',
          data: {user_id: user_id},
          cache: false,
          success: function(res){
            var orders_num = JSON.parse(res);
            console.log(orders_num);
            for(let i = 0; i<orders_num.length; i++){
              $(`#${orders_num[i]}`).removeClass("none_view");
              $(".count-number").text(0);
            }
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Success',
              showConfirmButton: false,
              timer: 1000
            });
          }
        });
      }
    })
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
      var amount = `${res}.00`;
      var parts = amount.toString().split(".");
      var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
      $(".balance_amount").html(`₱${num}`);
    }
  });

}


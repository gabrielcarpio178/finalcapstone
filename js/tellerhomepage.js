$("#nav").load('storenav.php'); 
$("#home").addClass("active-class");
$(document).ready(function(){
    getnoti();
    let show = false;
    $("#btn_bell").on('click', function(){
      $("#noti_content").toggle('slow', function(){
        if(show==false){
          $(this).removeAttr('style');
          show = true;
        }else{
          $(this).attr('style', "display: none !important;");
          show = false;
        }
        
      })
    })
    var date = new Date();
    var mounth = date.getMonth();
    var day = date.getDate();
    if(day<10){
        day="0"+day;
    }
    var year = date.getFullYear();
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
  $("#date").text(monthFull[mounth]+" "+day+" - "+year)

    $("#menu-teller").on('click', function(){
        window.location="teller_menu.php";
    });
    
    $("#order-teller").on('click', function(){
        window.location="tellerorder.php";
    });

    $("#cash_out").on('click', function(){
        window.location="tellercashout.php";
    })

    $(".summary-income").on("click",function(){
        window.location="tellersummary.php";
    });

    announcement('Canteen Staff');
    
});

function announcement(usertype){

  $.ajax({
    url: '../../controller/Dbannoucement_show.php',
    type: 'POST',
    data: {usertype: usertype},
    cache: false,
    success: function(res){
      $(".welcome").text(res);
    }
  });

}

function getnoti(){
  $.ajax({
    url: '../../controller/Dbteller_noti.php',
    type: 'POST',
    data: {
      user_id : 'user_id'
    },
    cache: false,
    success: function(res){
      var result_noti = JSON.parse(res);
      result_noti.sort(function(a, b){
        let d1 = new Date(a.order_time), d2 = new Date(b.order_time);
          return d2 - d1;
      });
      html_noti = '';
      let num_noti = parseInt(0);
      setOfSeen= [];
      let none_view = '';
      for(let i = 0; i<result_noti.length; i++){
        if((result_noti[i]).isSeen=='0'){
          none_view = "none_view";
          num_noti++;
          setOfSeen.push({'id':(result_noti[i]).order_id, 'type' : (result_noti[i]).type});
        }else if((result_noti[i]).isSeen=='1'){
          none_view = "";
        }  
        var date = new Date((result_noti[i]).order_time);
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
        if((result_noti[i]).type=='order'){
          var image_gender = ((result_noti[i]).gender=='male'||(result_noti[i]).gender=='MALE')? '../../image/avatar.jpg':'../../image/female_avatar.png'; 
          var image = ((result_noti[i]).image_profile!=null)? `../user_buyer/profile/${(result_noti[i]).image_profile}`: image_gender;
          if((result_noti[i]).statues=='PURCHASE'){
            html_noti += `
              <div class="d-flex flex-row gap-3 p-2 align-items-center noti_content_info ${none_view}" onclick="isSeen('${(result_noti[i]).order_id}', '${(result_noti[i]).type}')">
                <img src="${image}" class="image_noti">
                <div class="d-flex flex-column gap-1">
                  <div class="message">
                    You've just received <b>${(result_noti[i]).order_amount}.00</b> from ${(result_noti[i]).name}
                  </div>
                  <div class="date">
                    ${insert_date}
                  </div>
                </div>
              </div>
            `;
          }else{
            html_noti += `
              <div class="d-flex flex-row gap-3 p-2 align-items-center noti_content_info ${none_view}" onclick="isSeen('${(result_noti[i]).order_id}', '${(result_noti[i]).type}')">
                <img src="${image}" class="image_noti">
                <div class="d-flex flex-column gap-1">
                  <div class="message">
                    <b>${(result_noti[i]).name}</b> placed an order worth ${(result_noti[i]).order_amount}.00 pesos.
                  </div>
                  <div class="date">
                    ${insert_date}
                  </div>
                </div>
              </div>
            `;
          }
        }else{
          html_noti += `
            <div class="d-flex flex-row gap-3 p-2 align-items-center noti_content_info ${none_view}" onclick="isSeen('${(result_noti[i]).order_id}', '${(result_noti[i]).type}')">
              <img src="../../image/female_avatar.png" class="image_noti">
              <div class="d-flex flex-column gap-1">
                <div class="message">
                  The cashout request worth <b>${(result_noti[i]).cashout_amount}.00</b> pesos has been approved.
                </div>
                <div class="date">
                  ${insert_date}
                </div>
              </div>
            </div>
          `;
        }
      }
      $(".noti-info").html(html_noti);
      $(".num_noti").text(num_noti);
      $("#btn_clear").on('click', function(){
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
            for(let x = 0; x<setOfSeen.length; x++){
              isSeen((setOfSeen[x]).id, (setOfSeen[x]).type);
            }
          }
        })
      })
    }
  })
}

function isSeen(id, type_info){
  $.ajax({
    url: '../../controller/DbtellerNotiSeen.php',
    type: 'POST',
    data: {
      id : id,
      type_info : type_info
    },
    success: function(res){
      getnoti();
    }
  })
}
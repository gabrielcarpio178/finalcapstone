$("#nav").load('storenav.php'); 
$("#home").addClass("active-class");
$(document).ready(function(){

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
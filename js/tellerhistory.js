let number = 1;
let name;
let department = "ALL";
let date = "";
info();

//search by name
$("#name").on('keyup', function(){

  name = $(this).val();
  $.ajax({
    url: "../../controller/Dbtellerhistorytable.php",
    type: "POST",
    data: {
      name : name,
      page: number,
      department: department,
      date : date,
    },
    cache: false,
    success: function (res) {
      $(".table-info").html(res);
      info();
    },
  });
  
})

//sort by department

$(".txt, #department, .checkbox").each(function() {

  $(this).change(function(){
    createSummary();
  });

});

function createSummary() {

  department = $('#department').find(":selected").text();
  $.ajax({
    url: "../../controller/Dbtellerhistorytable.php",
    type: "POST",
    data: {
      department : department,
      name : name,
      page: number,
      date : date,
    },
    cache: false,
    success: function (res) {
      $(".table-info").html(res);
      info();
      
    },
  });   
   

}

//search by date

$(".txt, #date, .checkbox").each(function() {

  $(this).change(function(){
    getdate();
  });

});

function getdate() {

  date = $("#date").val();
  $.ajax({
    url: "../../controller/Dbtellerhistorytable.php",
    type: "POST",
    data: {
      department : department,
      name : name,
      page: number,
      date : date,
    },
    cache: false,
    success: function (res) {
      $(".table-info").html(res);
      info();
      // console.log(res);
    },
  });   


}


//next page
function next(num) {
  $.ajax({
    url: "../../controller/Dbtellerhistorytable.php",
    type: "POST",
    data: {
      page: num,
      department : department,
      name : name,
      date : date,
    },
    cache: false,
    success: function (res) {
      $(".table-info").html(res);
      info();
      // console.log(res);
    },
  });
}
// previos page
function prev(num) {
  $.ajax({
    url: "../../controller/Dbtellerhistorytable.php",
    type: "POST",
    data: {
      page: num,
      department : department,
      name : name,
      date : date,
    },
    cache: false,
    success: function (res) {
      $(".table-info").html(res);
      info();
    },
  });
}

// pagge number
function page_num(num) {
  number = num;
  $.ajax({
    url: "../../controller/Dbtellerhistorytable.php",
    type: "POST",
    data: {
      page: num,
      department : department,
      name : name,
      date : date,
    },
    cache: false,
    success: function (res) {
      $(".table-info").html(res);
      info();
    },
  });
}

function info(){
  $(".info").on('click', function(){
    var order_num = $(this).attr('id');
    $.ajax({
      url: "../../controller/Dbtellershowuser_info.php",
      type: "POST",
      data: {
        order_num : order_num,
      },
      cache: false,
      success: function (res) {
        var data = JSON.parse(res);
        // console.log(data);
        $(".justify-content-between #name").text(data.name);
        $('.justify-content-between #department_info').text(data.department);
        $('.justify-content-between #reference_num').text(data.order_num);
        $('.justify-content-between #amount').text(data.total_amount+".00");
        $('.justify-content-between #student_id').text(data.usertype);
        var date = new Date(data.date_time);
        var mounth = date.getMonth();
        var day = date.getDate();
        var year = date.getFullYear();
        var hour = date.getHours();
        var min = date.getMinutes();
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
        var ampm = hour >= 12 ? 'pm' : 'am';
        hour = hour % 12;
        hour = hour ? hour : 12;
        min = min < 10 ? '0'+min : min;
        var strTime = hour + ':' + min + ampm;

        $('.justify-content-between #date_time').text(monthFull[mounth]+" "+day+", "+year+", "+strTime);
      },
    });
  })
}


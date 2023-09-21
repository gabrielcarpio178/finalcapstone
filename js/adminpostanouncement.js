$(document).ready(function(){
    $("#nav").load("adminnav.php");

    $('#post_announcement').on('submit', function (e) {
        e.preventDefault();
        // console.log('submit');
        var input_post = $("#input_post").val();
        var post_to = $("#post_to").val();
        if (input_post == "" || !post_to) {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: "empty input!",
            showConfirmButton: false,
            timer: 1000
          });
        } else {
          $.ajax({
            url: "../../controller/Dbadminpost_announcement.php",
            type: "POST",
            data: $(this).serialize(),
            cache: false,
            beforeSend: function () {
              $(".loader").show();
            },
            success: function (res) {
              if (res == "success") {
                $(".loader").hide();
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: "POST!",
                  showConfirmButton: false,
                  timer: 1000
                })
                .then(function () {
                  window.location = "adminpostanouncement.php";
                });
              }
            },
          });
        }
    });

    saveEdit();
    
    $(".txt, #search, .checkbox").each(function() {

      $(this).change(function(){
        search();
      });
    
    });

    $(".txt, #sortby, .checkbox").each(function() {

      $(this).change(function(){
        sortby();
      });
    
    });

    $(".txt, #post_to_filer, .checkbox").each(function() {

      $(this).change(function(){
        post_to();
      });
    
    });

    all();

});



function edit(id){
  $.ajax({
    url: '../../controller/Dbeditpostannoucement.php',
    type: 'POST',
    data: {id : id},
    cache: false,
    success: function(res){
      var data = JSON.parse(res);
      $("#edit_post").text(data.post);
      $("#edit_post_to option[value='"+data.post_type+"']").attr("selected","selected");
      $("#id").val(data.announcement_id);
    }
  });
}

function saveEdit(){
  $('#edit_announcement').on('submit', function (e) {
    e.preventDefault();
    // console.log('submit');
    var edit_post = $("#edit_post").val();
    var edit_post_to = $("#edit_post_to").val();
    var id = $("#id").val();
    if (edit_post == "" || !edit_post_to) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: "empty input!",
        showConfirmButton: false,
        timer: 1000
      });
    } else {
      // console.log(edit_post+" "+edit_post_to+" "+id);
      Swal.fire({
        title: 'Do you want to Post?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          edit_and_post(edit_post, edit_post_to, id, 'active');
        } else if (result.isDenied) {
          edit_and_post(edit_post, edit_post_to, id, 'not-active');
        }
      })
      
    }
  });
}

function edit_and_post(edit_post, edit_post_to, id, posted){
  $.ajax({
    url: "../../controller/Dbadminsaveedit_announcement.php",
    type: "POST",
    data: {
      edit_post: edit_post,
      edit_post_to : edit_post_to,
      id : id,
      posted: posted,
    },
    cache: false,
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (res) {
      // console.log(res);
      if (res == "success") {
        $(".loader").hide();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: "SAVE SUCCESS",
          showConfirmButton: false,
          timer: 1000
        })
        .then(function () {
          window.location = "adminpostanouncement.php";
        });
      }
    },
  });
}

function delete_post(id){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this action!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
      url: "../../controller/Dbadmindelete_announcement.php",
      type: "POST",
      data: {
        id : id,
      },
      cache: false,
      beforeSend: function () {
        $(".loader").show();
      },
      success: function (res) {
        // console.log(res);
        if (res == "success") {
          $(".loader").hide();
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: "DELETE SUCCESS",
            showConfirmButton: false,
            timer: 1000
          })
          .then(function () {
            window.location = "adminpostanouncement.php";
          });
        }
      },
    });
      
    }
  })
  
}
let date = undefined;
let number_data = undefined;
function search(){

  var search = $("#search").val();
    $.ajax({
      url: '../../controller/Dbanouncementtable.php',
      type: 'POST',
      data: {search : search,
        num : 1,
        number_data : number_data
      },
      cache: false,
      success: function(res){
        console.log(res);
        $("#table-info").html(res);
        date = search;
      }
    })
}

function prev(prev){
  $.ajax({
    url: '../../controller/Dbanouncementtable.php',
    type: 'POST',
    data: {num : prev,
    number_data: number_data,
    search: date
  },
    cache: false,
    success: function(res){
      // console.log(res);
      $("#table-info").html(res);
    }
  })
}

function next(num){
  $.ajax({
    url: '../../controller/Dbanouncementtable.php',
    type: 'POST',
    data: {
    num : num,
    number_data: number_data,
    search: date
  },
    cache: false,
    success: function(res){
      // console.log(res);
      $("#table-info").html(res);
    }
  })
}

function page(num){

  $.ajax({
    url: '../../controller/Dbanouncementtable.php',
    type: 'POST',
    data: {num : num,
    search: date,
    number_data, number_data},
    cache: false,
    success: function(res){
      console.log(res);
      $("#table-info").html(res);
    }
  })

}

function sortby(){
  number_data = $("#sortby").val();
  $.ajax({
    url: '../../controller/Dbanouncementtable.php',
    type: 'POST',
    data: {num : 1,
    search: date,
    number_data: number_data
    },
    cache: false,
    success: function(res){
      // console.log(res);
      $("#table-info").html(res);
    }
  })

}

function all(){
  $("#all").on('click', function(){
    window.location.reload();
  })

}

function post_to(){
  var post_to = $("#post_to_filer").val();
  $.ajax({
    url: '../../controller/Dbanouncementtable.php',
    type: 'POST',
    data: {
      post_to : post_to,
      num : 1,
      number_data : number_data
    },
    cache: false,
    success: function(res){
      // console.log(res);
      $("#table-info").html(res);
      date = search;
    }
  })
}
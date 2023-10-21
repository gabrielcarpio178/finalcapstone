let search = '';
let sortBy = 'all';
$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    displaydata('', 'all', 0);

    $("#search_user").on("keyup", function(){
        search = $(this).val();
        displaydata(search, sortBy, 0);
    });

    $(".txt, #sortBy, .checkbox").each(function() {
        $(this).change(function(){
            sortBy = $(this).val();
            displaydata(search, sortBy, 0);
        }); 
    });

});

function displaydata(search, sortBy, page_num){
    $.ajax({
        url:'../../controller/DbcashierAccountBalanceTable.php',
        type: 'POST',
        data:{
            search:search,
            sortBy:sortBy,
            page_num:page_num
        },
        cache: false,
        success:function(res){
            $(".table-content").html(res);
        }
    })
}

function page(num){
    displaydata(search, sortBy, num);
}
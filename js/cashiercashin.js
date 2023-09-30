$(document).ready(function () {
    $("#nav").load("cashiernav.php");
    search_user();
    
});

function search_user(){
    $("#search").on("keyup", function(){
        var search = $(this).val();
        if(search.length!=0){
            $(".logo-id").fadeOut().hide();
            $.ajax({
                url: '../../controller/Dbcashiersearch_cashin.php',
                type: 'POST',
                data: {search: search},
                caches: false,
                success: function(res){
                    var result = JSON.parse(res);
                    html='';
                    // console.log(result);
                    if(result[1].length != 0){
                        $('.search-table').fadeIn().show();
                        for(let i = 0; i<result[1].length; i++){
                            html += `<tr onclick="getuser(${(result[5])[i]})">
                                        <td>${(result[0])[i]} ${(result[1])[i]}</td>
                                        <td>${(result[2])[i]}</td>
                                        <td>${(result[4])[i]}</td>
                                        <td>${(result[3])[i]}</td>
                                    </tr>`;
                        }
                        $(".table-body").html(html);
                        $(".message").hide();
                    }else{
                        $(".message").text("No Result");
                    }
                    

                }
            });

        }else{
            $('.search-table').fadeOut().hide();
            $(".logo-id").fadeIn().show();
            $(".message").hide();
        }
       
    });
}

function getuser(user_id){
    // console.log(user_id);
    $.ajax({
        url: '../../controller/Dbcashiergetuser.php',
        type: 'POST',
        data: {user_id: user_id},
        cache: false,
        success: function(res){
            var data_user = JSON.parse(res);
            // console.log(data_user);
        }
    });
}
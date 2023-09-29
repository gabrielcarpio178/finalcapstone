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
                    console.log(result);
                    if(result[1].length != 0){
                        $('.search-table').fadeIn().show();
                        for(let i = 0; i<result[1].length; i++){
                            html += `<tr>
                                        <td>${(result[0])[i]} ${(result[1])[i]}</td>
                                        <td>${(result[3])[i]}</td>
                                        <td>${(result[4])[i]}</td>
                                        <td>${(result[2])[i]}</td>
                                    </tr>`;
                        }
                        $(".table-body").html(html);
                        $(".message").text("");
                    }else{
                        $(".message").text("No Result");
                    }
                    

                }
            });

        }else{
            $('.search-table').fadeOut().hide();
            $(".logo-id").fadeIn().show();
            $(".message").text("");
        }
       
    });
}
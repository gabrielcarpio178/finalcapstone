$(document).ready(function(){
    $("#navbar").load("usernav.php");  
    displaydata();
});

function displaydata(){
    var user_id = $("#user_id").val();
    $.ajax({
        url: '../../controller/Dbuserordersummary.php',
        type: 'POST',
        data: {
            user_id : user_id
        },
        cache: false,
        success : function(res){
            var result = JSON.parse(res);
            table = '';
            for(let i=0;i<result.length;i++){
                table += `
                    <div class="table-data">
                        <div class="d-flex flex-row justify-content-between  mt-lg-5 table-head" onclick="table_info('${(result[i]).order_num}', '${i}')" >
                        
                            <div>${(result[i]).store_name}</div>
                            <div>Date: ${(result[i]).order_date}</div>
                        
                        </div>
                    </div>
                    <div class="table-order_${i} table-order">
                        <div class="content-table_${i}">

                        </div>
                        <div class="table-info">

                        </div>
                    </div>
                `;
            }
            $("#tableData").html(table);
        }
    })
}

let r;

function table_info(order_num, i){
    

    if(r==i){
        $(".table-order_"+r).slideUp("slow", function(){
            $(this).hide();
        });
        r = undefined;
    }else{
        $(".table-order_"+r).slideUp("slow", function(){
            $(this).hide();
        });
        $.ajax({
            url: '../../controller/Dbusershoworder.php',
            type: 'POST',
            data:{
                order_num : order_num
            },
            cache: false,
            success: function(res){              
                var data_res = JSON.parse(res);
                table_row = ''
                let total_amount = 0;
                let total_qty = 0;
                for(let i=0; i<data_res.length;i++){
                    let statues_class = ''
                    if((data_res[i]).statues!=null){
                        if((data_res[i]).statues=='PROCEED'||(data_res[i]).statues=='ACCEPTED'){
                            statues_class = 'accepted';
                            var icon = '<i class="fa-solid fa-check"></i>'
                        }else if((data_res[i]).statues=='CANCELED'||(data_res[i]).statues=='DECLANE'){
                            statues_class = 'cancel';
                            var icon = '<i class="fa-solid fa-x"></i>'
                        }
                    }

                    table_row += `
                        <tr class="${statues_class}">
                            <td>${icon}</td>
                            <td>
                                <div class="d-flex flex-column product">
                                    <div class="fw-bold">${(data_res[i]).orderproduct_name}</div>
                                    <div>${(data_res[i]).order_productcategory}</div> 
                                </div>
                            </td>
                            <td>${(data_res[i]).order_amount}.00</td>
                            <td>${(data_res[i]).order_quantity}</td>
                        </tr>
                    `;
                    total_amount = parseInt(total_amount) + parseInt((data_res[i]).order_amount);
                    total_qty = parseInt(total_qty) + parseInt((data_res[i]).order_quantity);
                }
                contenttable = `
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Product</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            ${table_row}
                            <tr>
                                <td class=""></td>
                                <td class="fw-bold">Total</td>
                                <td class="amount">${total_amount}.00</td>
                                <td class="quantity">${total_qty}</td>
                            </tr>
                        </tbody>

                    </table>
                    <center>
                        <button class="btn btn-outline-primary">Procced<button>
                    </center>
                    `;
                $(`.content-table_${i}`).html(contenttable);
            }                
        });
        $(".table-order_"+i).slideDown("slow" , function(){
        $(this).show();
    }) 
        r = i;
    }      

}
// function receiverOrder(order_num, i, teller_id){
//     Swal.fire({
//         title: "Are you sure?",
//         text: "Do you want to receive this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, receive it!"
//         }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: '../../controller/DbuserReceiver_order.php',
//                 type: 'POST',
//                 data: {
//                     order_num : order_num,
//                     teller_id : teller_id
//                 },
//                 cache: false,
//                 success: function(res){
//                     Swal.fire({
//                         position: "center",
//                         icon: "success",
//                         title: "Order Received",
//                         showConfirmButton: false,
//                         timer: 1000
//                     }).then(function(){
//                         window.location = "userordersummary.php"
//                     });
//                 }
//             });
//         }
//     });

// }
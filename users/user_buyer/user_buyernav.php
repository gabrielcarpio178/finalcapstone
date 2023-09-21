<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<style>
    *{
      /*outline: 1px solid black; */
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        background: #F2f2f2; 
    }
    
    #sidebar{                
        background-color: #253958;
        position: absolute;              
    } 
    ul{
        list-style-type: none;                      
    }      
    a{
        color: white;
        text-decoration: none;
        
    }
    .show_button{ 
        padding-left: 25px;
        font-size: 2rem;
        margin-top: 20px;   
    }
    ul li{        
        height: 7vh;        
        padding-top: 25px;
        margin-right: 5px;
              
    }
    li{
        font-size: 2rem;
        margin: 10px 0; 
        font-weight: bold;
                                           
    }
    li a{
        display: flex; 
        position: absolute;
        left: 12px;    
    }
    a .fa-home, .fa-clock-rotate-left, .fa-gear, .fa-right-from-bracket{
        margin: 0 10px;
        
    } 
    
    
    #x{
        display: none;
    }
    span{
        display: none;
        opacity: 0;
    }
       
    li:hover, active{
        background: #ffffff4f;
        border: 1px solid white;
        border-radius: 5%/15%;
    }
    
    @media screen and (min-width: 320px) {        
        #sidebar{
            width: 12%;
            height: 8vh;
        }
        
        ul, #menu, #x, #x-mobile{
            display: none;
        }
        
        ul li{
            padding-left: 25px; 
            height: 10vh;
            padding-top: 12px;             
        }
        .show_button{ 
            padding: 10px;
            font-size: 1.5rem;
            margin-top: 3px;               
        }        
        li{
            font-size: 2rem;            
            font-weight: bold; 
            margin: 35px 0; 
        }                   
         
    }
    @media screen and (min-width: 720px) {
        ul{
            display: none;
        }
        .show_button{  
            font-size: 2rem;                       
        }        
        
    }
    @media screen and (min-width: 1020px) {
        #sidebar{
            width: 8%;
            height: 100vh;   
            display: block;
        }
        ul, #menu{
            display: block;
        }
        #menu-mobile, #x-mobile{
            display: none;
        }               
        .nav-button{
            display: none;
        }
        ul li{
            padding-left: 25px; 
            height: 10vh;
            padding-top: 25px;             
        }
        .show_button{ 
            padding-left: 25px;
            font-size: 2rem;
            margin-top: 20px;   
        }        
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>    
    <div id="sidebar">
        
        <div class="show_button">
            <a href="#" id="menu"><i class="fa-solid fa-bars"></i></a>
                    
            <a href="#" id="x"><i class="fa-solid fa-x"></i></a> 
            
            <a href="#" id="menu-mobile"><i class="fa-solid fa-bars"></i></a>
                    
            <a href="#" id="x-mobile"><i class="fa-solid fa-x"></i></a> 
        </div>        
        
        <ul class = "list-inline">                    
           <li id="home"><a href="#"><i class="fas fa-home"></i>  <span>Home</span></a></li>                    
           <li id="history"><a href="#"><i class="fa-solid fa-clock-rotate-left"></i>  <span>History</span></a></li>                    
           <li id="setting"><a href="#"><i class="fa-solid fa-gear"></i>  <span>Setting</span></a></li>                    
           <li id="logout"><a href="#"><i class="fa-solid fa-right-from-bracket"></i>  <span>Logout</span></a></li>                    
        </ul>
        
    </div>      
                     
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script>
    $(document).ready(function(){
    
        $("#menu").click(function(){
           $("#menu").css("display", "none"); 
           $("#x").css("display", "block");
           $("span").css("display", "block");  
           $("span").css("opacity", "1");                                                                
           $("#sidebar").animate({
               width: "25%",
               opacity: "1"                                                    
           });          
        });
        
         $("#x").click(function(){
           $("#menu").css("display", "block"); 
           $("#x").css("display", "none");
            $("span").css("display", "none"); 
           $("span").css("opacity", "0");                             
           $("#sidebar").animate({
               width: "8%"             
           });          
        });
        
        $("#menu-mobile").click(function(){
            $("#menu-mobile").css("display","none");
             $("#x-mobile").css("display","block");
             $("ul").css("display","block");
              $("span").css("display", "block");
             $("span").css("opacity", "1");  
            $("#sidebar").animate({
               width: "75%",
               height: "73vh",               
               opacity: "1" 
                                                                               
           });
                     
        });
        
        $("#x-mobile").click(function(){
            $("#menu-mobile").css("display","block");
             $("#x-mobile").css("display","none");
             
           $("ul").css("display","none");
           $("span").css("opacity", "0");                  
           $("#sidebar").animate({
               width: "12%",
               height: "8vh",
               borderRadius: "0%"                      
           });
                     
        });
        
        $("#logout").on('click', function(e){
            e.preventDefault();
            
            swal({
                title: "Success",
                text: "Logout",
                type: "success"
               }).then(function() {
               
                  $.ajax({
                      url:"../../controller/Dblogout.php?logout=click",
                      success: function(res){
                         window.location=res; 
                      }
                  });
                
             }); 
            
        });
        
    });
</script>
</html>

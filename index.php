<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/index.css">
    <title>BCC digital payment</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="content mt-4">
                    <h3>BCC Digital Payment System</h3>
                    <h1>WELCOME</h1>
                    <img src="image/icon_1.png" alt="BCC digital payment logo"></img>
                    <p>A new way to make payment easy.<br>Purchase and pay using digital currency.</p>
                    <div class="mt-5">
                        <div class="row signin">
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="signin">Sign in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="js/jquery.min.js"></script>
<script>   
    $(document).ready(function(){
        
        $("#signin").on("click", function(){
            window.location="signin.php";
        });  
        
        $("#signup").on("click", function(){ 
            window.location="signup.php";
        });   
        
    });
</script>
</html>
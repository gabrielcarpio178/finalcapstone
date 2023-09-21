<?php
session_start();
if(!isset($_SESSION['id'])){
   if(!isset($_SERVER['HTTP_REFERER'])){
       header('location: ../../index.php');
    exit;
   }
}else{  
    $id=$_SESSION['id'];   
?>
<link rel="stylesheet" href="../../css/usertype_personnel_form.css">
    <div class="loader"><img src="../../image/loader.gif"></div>  
    <div class="formspersonnel w-100"> 
       <h3>Personnel</h3>                          
       <div class="message">           
          Add new information for personnel
       </div>                 
                         
       <form id="formsubmitpersonnel">
           
           <input type="hidden" name="id_personnel" id="id_personnel" value="<?=$id; ?>">
           
           <label for="department">Department</label>
           <select id="department" name="department">  
               <option value="SASO">SASO</option>
               <option value="Faculty">Faculty</option>
               <option value="Guidance">Guidance</option>
               <option value="Registerar">Registerar</option>
               <option value="Admin">Admin</option>
               <option value="SSG">SSG</option>                                       
           </select>           
           <div class="d-flex justify-content-center">
               <input type="submit" class="btn btn-primary m-2" value="Personnel" name="submit" id="submit"/>
               <button type="button" class="btn btn-danger m-2" id="cancelpersonnel">Cancel</button>
           </div>       
                   
       </form> 
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../js/usertype_personnel_form.js"></script>
            
<?php
}
?>  



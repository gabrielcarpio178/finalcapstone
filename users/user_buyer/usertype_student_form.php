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
    <link rel="stylesheet" href="../../css/usertype_student_form.css">
    <div class="loader"><img src="../../image/loader.gif"></div>   
    <link rel="stylesheet" href="../../css/bootstrap.min.css">   
    <div class="formstudent w-100"> 
       <h3>Student</h3>                          
       <div class="message">           
          Add new information for student
       </div>                 
                         
       <form id="formsubmitstudent">
           
           <input type="hidden" name="id" id="id" value="<?=$id; ?>">
           <label for="studentid">Student ID Numbers</label>
           <input type="number" name="studentid" id="studentid" placeholder="Student ID Numbers">
           <div id="message-input"></div>
           <label for="department_student">Course</label>
           <select id="department_student" name="department_student">                                         <option value="BSCrim">BSCrim</option>                                                                                                          <option value="BSED">BSED</option>
               <option value="BEED">BEED</option>
               <option value="BSOA">BSOA</option>
               <option value="BSIS">BSIS</option>       
           </select>
           <label for="year">Year Level</label>
           <select id="year" name="year">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
               <option value="1st">1st year</option>                                                                                                          
               <option value="2nd">2nd year</option>
<option value="3rd">3rd year</option>
<option value="4th">4th year</option>
           </select>
           <div class="d-flex justify-content-center">
               <input type="submit" class="btn btn-primary m-2" value="student" name="submit" id="submit"/>
               <button type="button" class="btn btn-danger m-2" id="cancelstudent">Cancel</button>
           </div>       
                   
       </form> 
            
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../js/usertype_student_form.js" ><script>
            
<?php
}
?>  



 <?php
 session_start();
 $id=$_SESSION['id'];
 $name=$_SESSION['name'];
 $page=$_SESSION['page'];

 ?>
  <link rel="stylesheet" type="text/css" href="./css/header.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <div class="header">
  <?php
  if($page=='Payment_Info' || $page=='Payment_Response'){
    ?>  
    
    <a href="./Payment_Info.php" class="logo">Quizzer</a>

  <?php
  }
  else{
  ?>
    <a href="./Recruiter_Home.php" class="logo">Quizzer</a>
    <div style="margin-left: 230px;">
      <a class="active" href="./Recruiter_Home.php">Contest</a>
     </div> 

  <?php
    }
  ?>


  
  <div class="header-right" style="margin-right: 50px;">
   <div class="dropdown show">
     <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"><?php echo $name; ?></a>
     <div class="dropdown-menu">
       <a class="dropdown-item" href="#">Profile</a>
       <a class="dropdown-item" href="#">History</a>
     </div>
     <a href="./../login/Logout.php" style="color : #6699ff;font-size: 15px;">Logout</a>
   </div>

 </div>
</div> 
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/contest_description.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<?php session_start(); ?>
<?php include 'Contest_Description_Details.php' ?>


<body style="background-color: #f2f2f2;">

<!-- ===================== HEADER OF PAGE ============================= -->
<div class="header">
    <a href="User_Home.php" style="padding: 0px;"><img src="./../Images/logo.png" class="img-rounded image"></a>
    <a href="User_Home.php" class="logo">Quizzer</a>
    <div style="margin-left: 230px;">
        <a class="active" href="User_Home.php">CONTESTS</a>
        <a href="Practice.php">PRACTICE</a>
        <a href="#about">ARTICLES</a>
    </div>
    <div class="header-right" style="margin-right: 50px;">
        <div class="dropdown show">
          <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" style="font-size: 18px;"><?php echo $userName; ?></a>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="User_Profile.php">PROFILE</a>
              <a class="dropdown-item" href="#">HISTORY</a>
          </div>
          <a href="./../login/Logout.php" style="color : #6699ff;font-size: 15px;">LOGOUT</a>
        </div>
    </div>
</div> 




<!-- CONTEST DETAILS -->

<div style="position: relative;height:450px;">
  <img src="./../uploads/Contest/<?php echo $Image; ?>" alt="<?php echo $companyName; ?>" style="width: 60%;height: 450px;float: right;border-radius: 0px 0px 0px 25px;">
  <div class="card" align="center" style="background-color: #f2f2f2; height:430px;width: 37%;float: left;position: absolute;border-radius: 10px;color : black;padding-top: 10px;margin:10px;box-shadow:5px 5px 3px #d9d9d9;" >
  <p style="font-weight: bold;font-size: 40px;">
    <?php echo $ContestName; ?></p>
  <p><mark class="company-name"><?php echo $companyName; ?></mark></p>
  <p><?php echo $liveOrNot; ?></p>
  <hr class="hr-card">
  <table>
    <tr>
      <td><p class="time-label">START</p></td>
      <td><p class="time-detail"><?php echo $start; ?></p></td>
    </tr>
    <tr>
      <td><p class="time-label">END</p></td>
      <td><p class="time-detail"><?php echo $end; ?></p></td>
    </tr>
    <tr>
      <td><p class="time-label">DURATION</p></td>
      <td><p class="time-detail"><?php echo $duration; ?></p></td>
    </tr>
  </table>
  <hr class="hr-card">
  <p><a href="<?php echo $link; ?>" class="btn <?php echo $buttonclass; ?> btn-lg" name="registerButton"><?php echo $button; ?></a></p>
</div>
</div>





<?php

$guidlines = "There can be 4 types of question.
 1. Multiple Choice Single Answer
 2. Multiple Choice Multiple Answer
 3. One word Answer
 4. True false

 In 1,2,3 you will get +4 and -1 , But in true false type you will get +4 and -2.
 
 NOTE : No mark will be deducted for the unattemped question.";

?>




<!-- ---------------------- HORIZONTAL LINE WITH SHADOW -------------------- -->
<hr class="hr-body">


<div class="main-div">

<!-- ----------------------- EMPTY SPACE BEFORE DESCRIPTION -------------------- -->
  <div class="col-sm-1"></div>

<!-- -------------------- DESCRIPTION IN MIDDLE ---------------------------------- -->
  <div class="col-sm-7"><br> 
      <h4 class="desc-heading">ABOUT THE CHALLENGE</h4><br><br>
      <div style="min-height: 400px;overflow: hidden;">
          <pre style="white-space: pre-wrap;border : none;" class="desc-content"><?php echo $Description; ?></pre>
      </div>
<br><br><br><br><br>
      <h4 class="desc-heading">ABOUT THE COMPANY</h4><br><br>
      <div style="min-height: 400px;overflow: hidden;">
          <pre style="white-space: pre-wrap;border : none;" class="desc-content">ABOUT THE COMPANY</pre>
      </div>
<br><br><br><br><br>
      <h4 class="desc-heading">GUIDLINES</h4><br><br>
      <div style="min-height: 400px;overflow: hidden;">
          <pre style="white-space: pre-wrap;border : none;" class="desc-content"><?php echo $guidlines; ?></pre>
      </div>
  </div>

<!-- ------------------------------- RIGHT POSTION OF LIVE EVENTS AND START BUTTON ----------------- -->
  <div class="col-sm-4">
    <div align="center">
      <a href="<?php echo $link; ?>" class="btn <?php echo $buttonclass; ?> btn-lg" style="font-size: 20px;height: 60px;text-align: center;padding-top: 17px;" name="registerButton" id="register"><?php echo $button; ?></a>
    </div>
<br><br><br><br>
    <div>
      <h5 style="font-weight: bold;font-size: 20px;color : grey;border-bottom:1px solid #cccccc;padding-bottom: 10px;">OTHER LIVE EVENTS </h5><br>
      <table style="width: 100%;font-size: 18px;border-spacing: 0 15px;border-collapse: separate;">
        <?php echo $otherEvents; ?>
      </table>
    </div>
  </div>
</div>




<!-- ----------------------- FOOTER OF PAGE -------------------------- -->
<div id="footer"></div>
<script type="text/javascript">
  $(function(){
      $("#footer").load("Footer.html"); 
    });
</script>




</body>
</html>
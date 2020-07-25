<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/practice_question.css">
  <script type="text/javascript" src="js/add_practice_question.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>


<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizzer";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * from subjects";
$result = mysqli_query($conn,$query);

$subjects = "<option></option>";
while($row = mysqli_fetch_assoc($result)) {
    $subjects.="<option>".$row['SubjectName']."</option>";
}
    $subjects.="<option>Other</option>";

mysqli_close($conn);
?>



<body style="background-color: #f2f2f2;">

<!-- ===================== HEADER ============================= -->
   <div class="header">
      <a href="#" style="padding: 0px;"><img src="./../Images/logo.png" class="img-rounded image"></a>
      <a href="#default" class="logo">QUIZZER</a>
      <div style="margin-left: 230px;">
        <a href="User_Home.php">CONTESTS</a>
        <a class="active" href="Practice.php">PRACTICE</a>
        <a href="#about">ARTICLES</a>
      </div>
      <div class="header-right" style="margin-right: 50px;">
        <div class="dropdown show">
        <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" style="font-size: 18px;"><?php echo $_SESSION['name']; ?></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="#">History</a>
        </div>
        <a href="#logout" style="color : #6699ff;font-size: 15px;">LOGOUT</a>
      </div>
        
      </div>
  </div>



<div class="container">
  <div class="col-sm-1"></div>

  <div class="col-sm-8">
    <br><br>

  <form class="form-horizontal" method="post" id="question-form" onsubmit="return myf()">
    
    <div class="form-group">
      <label class="control-label col-sm-2">Subject :</label>
      <div class="col-sm-10">
      <select class="form-control" style="height: 35px;" name="subject" id="subject" required="required" onchange="check(this.value)">
          <?php echo $subjects; ?>
      </select>
      </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10"  id="othersubject" hidden>
          <input class="form-control" type="text" name="other" id="other">
        </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Question:</label>
      <div class="col-sm-10">          
        <textarea class="form-control" placeholder="Enter Question Here" required="required" id="question" name="question"></textarea>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="radio">
          <input type="radio" name="choice" id="choice" value="a" required="required">
          <textarea class="form-control" type="text" name="choice1" rows="1" required="required" id="choice1"></textarea>
        </div>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="radio">
          <input type="radio" name="choice" id="choice" value="b">
          <textarea class="form-control" type="text" name="choice2" rows="1" id="choice2"></textarea>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="radio">
          <input type="radio" name="choice" id="choice" value="c">
          <textarea class="form-control" type="text" name="choice3" rows="1" id="choice3"></textarea>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="radio">
          <input type="radio" name="choice" id="choice" value="d">
          <textarea class="form-control" type="text" name="choice4" rows="1" id="choice4"></textarea>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Explanation:</label>
      <div class="col-sm-10">          
        <textarea class="form-control" placeholder="Enter Explanation." id="description" name="description"></textarea>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" id="submit" name="submit">Submit</button>
        <span id="message"></span>
      </div>
    </div>
  </form>

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
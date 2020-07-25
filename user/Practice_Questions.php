<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/practice_question.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script type="text/javascript" src="js/practice_questions.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>


<body style="background-color: #f2f2f2;">

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

$userName = $_SESSION['name'];

$SubjectId = $_GET['subjectid'];
$query = "SELECT SubjectName from subjects where SubjectId='$SubjectId'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$SubjectName = $row['SubjectName'];

$tableName = $SubjectId."_subject";
$query = "SELECT * from $tableName";
$result = mysqli_query($conn,$query);

$question = "";
  while($row = mysqli_fetch_assoc($result)) {
      $QuestionId = $row['QuestionId'];
      $Question = $row['Question'];
      $ans = $row['Answer'];
      
      $question.="<li style='font-size: 18px;'><pre class='list1'>".$Question."</pre>
        <ol type='a'>";
          if($row['Choice1'] != NULL)
            $question.="<li><pre class='list2'>".$row['Choice1']."</pre></li>";
          if($row['Choice2'] != NULL)
            $question.="<li><pre class='list2'>".$row['Choice2']."</pre></li>";
          if($row['Choice3'] != NULL)
            $question.="<li><pre class='list2'>".$row['Choice3']."</pre></li>";
          if($row['Choice4'] != NULL)
            $question.="<li><pre class='list2'>".$row['Choice4']."</pre></li>";
        $question.="
        </ol>
        <div><button class='button_desc' style='font-size: 15px;outline: none;' onclick='myfunction(this.id);' id='".$QuestionId."'>View Answer <i class='arrow down'></i></button></div>
        <div id='".$QuestionId."_desc' class='description'>
          <p style='font-size:15px;'><span style='font-weight:bold;'>Answer :</span> ".$ans."</p>
          <p style='font-size:15px;'><span style='font-weight:bold;'>Description :</span> ".$row['Description']."</p>
        </div>
        </li><br><br>";
  }
?>


<!-- ===================== HEADER ============================= -->
   <div class="header">
      <a href="#" style="padding: 0px;"><img src="./../Images/logo.png" class="img-rounded image"></a>
      <a href="User_Home.php" class="logo">Quizzer</a>
      <div style="margin-left: 230px;">
        <a href="User_Home.php">CONTESTS</a>
        <a class="active" href="#features">PRACTICE</a>
        <a href="#about">ARTICLES</a>
      </div>
      <div class="header-right" style="margin-right: 50px;">
        <div class="dropdown show">
        <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" style="font-size: 18px;"><?php echo $userName; ?></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="User_Profile.php">PROFILE</a>
          <a class="dropdown-item" href="#">HISTORY</a>
        </div>
        <a href="#logout" style="color : #6699ff;font-size: 15px;">LOGOUT</a>
      </div>
        
      </div>
  </div> 

<br>
<!-- Showing All Practice Questions -->
<div style="min-height: 400px;">
    <div class="col-sm-1"></div>

    <div class="col-sm-8">
      <h2 style="border-bottom: 1px solid #cccccc;margin-left: 5%;padding-bottom: 5px;"><?php echo $SubjectName; ?></h2><br><br>
      <ol>
        <?php echo $question; ?>
      </ol>
    </div>

    <div class="col-sm-3" align="center">
        <br>
        <h3 class="contest-heading">Want to Contribute ?</h3>
        <button class="btn btn-primary btn-lg" onclick="window.location.href='Add_Practice_Question.php'">Add Question</button>
    </div>
</div>

<style type="text/css">
  .contest-heading {
  font-weight: bold;
  font-size: 20px;
  color : grey;
}
</style>



<div id="footer"></div>
<script type="text/javascript">
  $(function(){
      $("#footer").load("Footer.html"); 
    });
</script>


</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/practice.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
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
$userName = $_SESSION['name'];

date_default_timezone_set('Asia/Kolkata');

// to show live and upcoming contest on right hand side
$query1 = "SELECT * from contest ORDER BY End";
$result = mysqli_query($conn, $query1);

$currentdatetime=date_create(date('Y-m-d H:i:s'));
$live = "";
$upcoming = "";
$livecontest = 0;
$upcomingcontest = 0;

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

          $StartTime = date_create($row['Start']);
          $EndTime = date_create($row['End']);
          $diff=date_diff($EndTime,$currentdatetime);
        
          if($currentdatetime<$StartTime) {

            // for upcoming contest , if current date and time is less than start time of contest
            $upcomingcontest++;
            $month = $StartTime->format('M');
            $day = $StartTime->format('d');
                $upcoming.="<tr>
                            <td style='width: 70%;'><a href='Contest_Description.php?contestid=".$row['ContestId']."' style='color : #4d66ff;'>".$row['ContestName']."</a></td>
                            <td style='width: 30%;' align='right'><i style='color:#737373'>".$month." ".$day."</i></td>
                            </tr>";
        }
        else if($currentdatetime>=$StartTime && $currentdatetime<=$EndTime){

          // for live contest , if current time lie between start and end time of contest
          if(($diff->d)==0) {
              $duration=($diff->h)." Hour";
              if(($diff->h)>1)
                  $duration.="s Left";
              else
                  $duration.=" Left";
          }
          else {
              $duration=($diff->d)." Day";
              if(($diff->d)>1)
                $duration.="s Left";
              else
                $duration.=" Left";
          }
          $live.="<tr>
                  <td style='width: 70%;'><a href='Contest_Description.php?contestid=".$row['ContestId']."' style='color : #4d66ff;'>".$row['ContestName']."</a></td>
                  <td style='width: 30%;' align='right'><i style='color:#737373'>".$duration."</i></td>
                  </tr>";
        }
    }
}

// to show all subjects for practice

$query2 = "SELECT * from Subjects ORDER BY SubjectName";
$result = mysqli_query($conn,$query2);

$subjects = "";
if(mysqli_num_rows($result) > 0 ) {
  while($row = mysqli_fetch_assoc($result)) {
      $subjectname = $row['SubjectName'];
      $subjectid = $row['SubjectId'];

      $tableName = $subjectid."_subject";
      $query3 = "SELECT count(*) as Total from $tableName";
      $result3 = mysqli_query($conn,$query3);
      $row = mysqli_fetch_assoc($result3);
      $noOfQuestion = $row['Total'];

      $subjects.="<tr onclick=window.location='"."Practice_Questions.php?subjectid=".$subjectid."'>
                  <td class='clickable' style='padding: 10px;border-left : 3px solid green;border-radius: 10px;border-right : 3px solid green;'>".$subjectname."<span class='badge badge-pill' style='float: right;background-color: blue;font-size: 15px;'>".$noOfQuestion."</span></td>
                  </tr>";
  }
}

mysqli_close($conn);
?>


<body>
  <!-- ===================== HEADER ============================= -->
<div class="header">
      <a href="#" style="padding: 0px;"><img src="./../Images/logo.png" class="img-rounded image"></a>
      <a href="User_Home.php" class="logo">Quizzer</a>
    <div style="margin-left: 230px;">
        <a href="User_Home.php">CONTESTS</a>
        <a class="active" href="Practice.php">PRACTICE</a>
        <a href="#about">ARTICLES</a>
    </div>
    <div class="header-right" style="margin-right: 50px;">
        <div class="dropdown show">
          <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"><?php echo $userName; ?></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="User_Profile.php">PROFILE</a>
            <a class="dropdown-item" href="#">HISTORY</a>
          </div>
          <a href="./../login/Logout.php" style="color : #6699ff;font-size: 15px;">LOGOUT</a>
        </div> 
    </div>
</div> 




<!-- MAIN CONTENT OF THE PAGE -->
<div style="overflow: hidden;min-height: 1000px;">
    <div class="col-md-2" style="min-height: 800px;background-color: #f2f2f2;"></div>

    <!-- MIDDLE SECTION WHERE ALL SUBJECTS ARE SHOWN -->
    <div class="col-md-6" style="min-height: 800px;background-color: #f2f2f2;">
        <h3 class="page-heading">Practice Quiz | Get as well as Give</h3>
        <table width="100%" style="border-collapse: separate;border-spacing: 10px;font-size: 20px;">
            <?php echo $subjects; ?>
        </table>
    </div>

    <!-- RIGHT SECTION WHERE LIVE AND UPCOMING CONTEST AND SHOWN -->
    <div class="col-md-4" style="padding: 30px;padding-top: 24px;background-color: #e6e6e6;min-height: 800px;">
        <div>
          <h5 class="contest-heading">LIVE CHALLENGES </h5>
          <table class="contest-content">
              <?php echo $live; ?>
          </table>
        </div>

        <br><br>
   
        <div>
          <h5 class="contest-heading">UPCOMING CHALLENGES </h5>
          <table class="contest-content">
            <?php echo $upcoming; ?>
          </table>
        </div>
    
        <br><br><br>
    
        <div>
          <h5 class="contest-heading">Want to Contribute ? </h5>
          <button class="btn btn-primary btn-lg" onclick="window.location.href='Add_Practice_Question.php'">Add Question</button>
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
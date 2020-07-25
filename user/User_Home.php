<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/user_home.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script type="text/javascript" src="./../login/valid.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>


<!-- TO FETCH CONTEST FROM DATABASE -->
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

// sql query for fetching information of all contest
if(isset($_SESSION['id'])) {
  $new = explode('.',$_SESSION['id']);
  $id = $new[0];
  $table=$new[1];
  $currentUserId = $id;
  $userName = $_SESSION['name'];

  $query1 = "SELECT * FROM contest";
  $result = mysqli_query($conn, $query1);

  $live="<div class='row equal'>";          // to store live contest
  $upcoming="<div class='row equal'>";      // to store upcoming contest
  $past="<div class='row equal'>";          // to store past contest

  $livecontest=0;        // no. of live contest
  $upcomingcontest=0;    // no. of upcoming contest
  $pastcontest=0;        // no. of past contest


  date_default_timezone_set('Asia/Kolkata'); // setting time zone to asia kolkata

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $currentdatetime=date_create(date('Y-m-d H:i:s'));   // current date and time
        $starttime=date_create($row["Start"]);               // start time of contest
        $endtime=date_create($row["End"]);                   // end time of contest
        $diff=date_diff($endtime,$currentdatetime);          
        $startday=$starttime->format('d');                   // start time date
        $startmonth=$starttime->format('M');                 // start time month
        $starthours=$starttime->format('h');                 // start time hours
        $startminutes=$starttime->format('i');               // start time minutes 
        $startampm=$starttime->format('A');                  // AM or PM
        
        $recruiterId = $row['RecruiterId'];
        $query2 = "SELECT Organization from recruiters where RecruiterId='$recruiterId'";
        $result2 = mysqli_query($conn,$query2);
        $row1 = mysqli_fetch_assoc($result2);
        $companyName = strtoupper($row1['Organization']);


        if($currentdatetime>$endtime) { 

        	// for past contest , if current date and time is greater that contest end time
        	$pastcontest++;
          $past.="<div class='col-sm-4 d-flex pb-3'>";
        	$past.="<a href='Contest_Description.php?contestid=".$row['ContestId']."' style='text-decoration:none;'>
        			<div class='card mb-3' style='display:inline-block;background-color: #d1b3ff;'>
          			<img style='height: 140px;' class='card-img-top' src=./../uploads/Contest/".$row['Image']." alt='Card image cap'>
          			<div class='card-body' style='background-color: #d1b3ff;' align='center'>
            		<mark style='line-height: 30px;'>".$companyName."</mark>
            		<h5 class='card-title' style='font-size: 20px;font-weight: bold;color:#262626;'>".$row['ContestName']."</h5>
            		<small style='color:#595959;'>HELD ON</small>
            		<p style='font-size: 17px;color:#262626;'>".$startday.",".$startmonth."&nbsp;&nbsp;&nbsp;"."<span style='font-size: 18px;'>".$starthours."&nbsp;:&nbsp;".$startminutes."&nbsp;&nbsp;".$startampm."</span></p>
            		<a href='#' class='btn btn-primary'>PRACTICE</a>
          			</div>
        			</div></a></div>";
        }
        else if($currentdatetime<$starttime) {
        	// for upcoming contest, if current date and time is less than contest start time

          $tableName = $row['ContestId']."_users";
          $query3 ="SELECT * from $tableName where UserId='$currentUserId'";
          $result3 = mysqli_query($conn,$query3);

          if(mysqli_num_rows($result3)>0) {
            $registered=1;
            $buttonclass="btn-primary disabled";
            $button = "REGISTERED";
          }
          else {
            $registered=0;
            $buttonclass="btn-success";
            $button = "REGISTER HERE";
          }

        	$upcomingcontest++;
        	$upcoming.="<div class='col-sm-4 d-flex pb-3'>
                  <a href='Contest_Description.php?contestid=".$row['ContestId']."' style='text-decoration:none;'>
        				  <div class='card' style='display:inline-block;'>
          				<img style='height: 140px;' class='card-img-top' src=./../uploads/Contest/".$row['Image']." alt='Card image cap'>
          				<div class='card-body' style='background-color: #d1b3ff;' align='center'>
            			<mark style='line-height: 30px;'>".$companyName."</mark>
            			<h5 class='card-title' style='font-size: 20px;font-weight: bold;color:#262626;'>".$row['ContestName']."</h5>
            			<small style='color:#595959'>STARTS ON</small>
            			<p style='font-size: 17px;color:#262626;'>".$startday.",".$startmonth."&nbsp;&nbsp;&nbsp;"."<span style='font-size: 18px;'>".$starthours."&nbsp;:&nbsp;".$startminutes."&nbsp;&nbsp;".$startampm."</span></p>
            			<a href='Contest_Description.php?contestid=".$row['ContestId']."' class='btn ".$buttonclass."'>".$button."</a>
          				</div>
        				</div></a></div>";
        }
        else {
        	// for live contest
                $livecontest++;
                $days = $diff->d; 
                $hours = $diff->h;
                $minutes = $diff->i;

                if($days>=0 && $days<=9) {
                    $days="0".$days;
                }
                if($hours>=0 && $hours<=9) {
                    $hours="0".$hours;
                }
                if($minutes>=0 && $minutes<=9) {
                    $minutes="0".$minutes;
                }

        $live.=" <div class='col-sm-4 d-flex pb-3'>
              <a href='Contest_Description.php?contestid=".$row['ContestId']."' style='text-decoration:none;'>
          		<div class='card' style='display:inline-block;'>
          		<img style='height: 140px;' class='card-img-top' src=./../uploads/Contest/".$row['Image']." alt='Card image cap'>
          		<div class='card-body' style='background-color: #d1b3ff;' align='center'>
            	<mark style='line-height: 30px;'>".$companyName."</mark>
            	<h5 class='card-title' style='font-size: 20px;font-weight: bold;color : #262626;'>".$row['ContestName']."</h5>
            	<small style='color:#595959;'>ENDS IN</small><br>
            	<span style='font-size: 20px;color:#262626;'>".$days."&nbsp;:&nbsp;".$hours."&nbsp;:&nbsp;".$minutes."</span>
            	<p style='font-size:10px;font-weight:bold;color:#737373'>DAYS&nbsp;:&nbsp;HRS&nbsp;:&nbsp;MINS</p>
            	<a href='startcontest.php?contestid=".$row['ContestId']."' class='btn btn-success'>START NOW</a>
          		</div>
        		</div></a></div>";
        }
    }
    $live.="</div>";
    $upcoming.="</div>";
    $past.="</div>";
  }
}

// closing connection
mysqli_close($conn);
?> 


<!-- SCROLLSPY FOR SCROLLING LEFT PANEL AND CHANGING ACTIVE LINKS, LIVE-UPCOMING-PAST -->
<body data-spy="scroll" data-target="#myScrollspy">

<!-- ===================== HEADER OF PAGE ============================= -->
<div class="header">
	<a href="#" style="padding: 0px;"><img src="./../Images/logo.png" class="img-rounded image"></a>
    <a href="#" class="logo">Quizzer</a>
    <div style="margin-left: 230px;">
        <a class="active" href="#home">CONTESTS</a>
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



<!-- ------------- VERTICAL SCROLLSPY (LEFT SIDE) -------------------------- --> 

<div style="background-color: #f2f2f2;">
  	<div class="row">
    	<nav class="col-sm-2" id="myScrollspy" style="padding-left: 30px;padding-top: 80px;font-weight: 600;font-size: 16px;">
      		<ul class="nav navbar-nav nav-pills" data-spy="affix" data-offset-top="50">
        		<li class="active"><a href="#live">LIVE</a></li>
        		<li><a href="#upcoming">UPCOMING</a></li>
        		<li><a href="#past">PAST</a></li>
      		</ul>
    	</nav>
    	<div class="col-sm-8">
    	<h3 style="color:#660035;font-family: 'Poiret One', cursive;"> GIVE QUIZZES AND GET HIRED </h3><hr style="border-color: black;">
      		
      	<!-- section of live challenges -->
      		<div id="live" style="min-height: 500px;">
        		<h3 style="font-family: 'Josefin Sans'; text-shadow: 2px 2px #d9d9d9;">LIVE CONTESTS</h3><hr style="width: 500px;border-color: #d9d9d9;" align="left">
      			<?php echo $live; ?> 
      		</div>

      <br><br><br><br><hr style="border-color: black;">
      	<!-- section for upcoming challenges -->	
      		<div id="upcoming" style="min-height: 500px;">
        		<h3 style="font-family: 'Josefin Sans'; text-shadow: 2px 2px #d9d9d9;">UPCOMING CONTESTS</h3><hr style="width: 500px;border-color: #d9d9d9;" align="left">
        		<?php echo $upcoming; ?>
      		</div> 

      <br><br><br><br><hr style="border-color: black;">  
      	<!-- section for past challenges -->
      		<div id="past" style="min-height: 500px;">
        		<h3 style="font-family: 'Josefin Sans'; text-shadow: 2px 2px #d9d9d9;">PAST CONTESTS</h3><hr style="width: 500px;border-color: #d9d9d9;" align="left">
        		<?php echo $past; ?>
      		</div>
    	</div>
  	</div>
  	<br><br><br><br><br>
</div>


<!-- ---------------------- SOCIAL MEDIA ---------------------- -->
<div class="float-sm">
  <div class="fl-fl float-fb">
    <i class="fa fa-facebook"></i>
    <a href="" target="_blank"> Like us!</a>
  </div>
  <div class="fl-fl float-tw">
    <i class="fa fa-twitter"></i>
    <a href="" target="_blank">Follow us!</a>
  </div>
  <div class="fl-fl float-gp">
    <i class="fa fa-google-plus"></i>
    <a href="" target="_blank">Recommend us!</a>
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
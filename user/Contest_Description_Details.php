<?php
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


date_default_timezone_set('Asia/Kolkata'); // setting time zone to asia kolkata
$Id=$_GET['contestid']; // Getting id of contest from link

$query1 = "SELECT * FROM contest where ContestID='$Id'";   // query for showing contest details
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);

$recruiterId = $row['RecruiterId'];
$query2 = "SELECT Organization from recruiters where RecruiterId='$recruiterId'";
$result2 = mysqli_query($conn,$query2);
$row1 = mysqli_fetch_assoc($result2);
$companyName = strtoupper($row1['Organization']);

// fetching all variables
  $ContestName = $row['ContestName'];
  $StartTime = date_create($row['Start']);
  $EndTime = date_create($row['End']);
  $Description = $row['Description'];
  $Image = $row['Image'];
  $currentdatetime=date_create(date('Y-m-d H:i:s'));

// All strings to be printed on html pages on desired locations

$liveOrNot = "";
$start = "&nbsp;:&nbsp;&nbsp;";
$end = "&nbsp;:&nbsp;&nbsp;";
$duration = "&nbsp;:&nbsp;&nbsp;";
$startOn = ""; // either startOn, endOn, heldOn
$button = "";

// ------------ CALCULATING DURATION ------------- 
$diff=date_diff($EndTime,$StartTime);
$hours = $diff->h;
$days = $diff->d;
$minutes = $diff->i;

if($days>0) {
  $duration.=$days."&nbsp;Day";
  if($days>1) 
    $duration.="s&nbsp;";
  if($hours>0) {
    $duration.=$hours."&nbsp;Hour";
    if($hours>1)
      $duration.="s&nbsp;";
  }
}
else if($hours>0) {
  $duration.=$hours."&nbsp;Hour";
    if($hours>1)
      $duration.="s&nbsp;";
    if($minutes>0) {
      $duration.=$minutes."&nbsp;min";
      if($minutes>1)
        $duration.="s&nbsp";
    }
}
else {
  $duration.=$minutes."&nbsp;min";
      if($minutes>1)
        $duration.="s&nbsp";
}


// start time and end time
$start.=$StartTime->format('M')." ".$StartTime->format('d').",&nbsp;".$StartTime->format('H').":".$StartTime->format('i')."&nbsp;".$StartTime->format('A');
$end.=$EndTime->format('M')." ".$EndTime->format('d').",&nbsp;".$EndTime->format('H').":".$EndTime->format('i')."&nbsp;".$EndTime->format('A');
      

$new = explode('.',$_SESSION['id']);
$id = $new[0];
$currentUserId=$id;
$tableName = $_GET['contestid']."_users";
$userName = $_SESSION['name'];


// PAST CONTEST
if($currentdatetime>$EndTime) {
  $buttonclass="btn-primary disable";
  $button.="PRACTICE";
  $link = "Contest_Practice.php?contestid=".$Id;
}
else if($currentdatetime<$StartTime) {
  // UPCOMING CONTEST
    $query3 = "SELECT * from $tableName where UserId='$currentUserId'";
    $result = mysqli_query($conn,$query3);
    
    if(mysqli_num_rows($result)==0){
        $buttonclass="btn-success";
        $button="REGISTER NOW";
        $link = "Contest_Register.php?contestid=".$Id;
    }
    else {
        $buttonclass="btn-info disable";
        $button = "ALREADY REGISTERED";
  }
}
else {
  $link = "Contest_Start.php?contestid=".$Id;
  $buttonclass="btn-success";
  $button.="START NOW";
  $liveOrNot.="<mark style='background-color:#00cc00; border-radius:5px; font-size:12px; color:white; font-weight:bold;'> &nbsp;LIVE&nbsp;</mark>";
}


$otherEvents = "";
$events = 0;
$query2 = "SELECT * from contest ORDER BY End";
$result = mysqli_query($conn, $query2);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result)) {


          $StartTime1 = date_create($row1['Start']);
          $EndTime1 = date_create($row1['End']);
          $diff=date_diff($EndTime1,$currentdatetime);
          if(($diff->d)==0) {
            $duration1=($diff->h)." Hour";
            if(($diff->h)>1) {
              $duration1.="s Left";
            }
            else {
              $duration1.=" Left";
            }
          }
          else {
            $duration1=($diff->d)." Day";
            if(($diff->d)>1) {
              $duration1.="s Left";
            }
            else {
              $duration1.=" Left";
            }
          }
          if($currentdatetime>$StartTime1 && $currentdatetime<$EndTime1) {
            if(($liveOrNot!="" && $row1['ContestId'] != $Id) || ($liveOrNot=="")) {
            $otherEvents.="<tr>
                            <td style='width: 70%;'><a href='Contest_Description.php?contestid=".$row1['ContestId']."' style='color : #4d66ff;'>".$row1['ContestName']."</a></td>
                            <td style='width: 30%;' align='right'><i style='color:#737373'>".$duration1."</i></td>
                          </tr>";
            $events++;
            if($events==4)
              break;
          }
          }
    }
}

mysqli_close($conn);
?>
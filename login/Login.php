<?php
session_start();

$email = $_POST["email"];
$pass = $_POST["pwd"];
$table = $_POST["who"];

$pass = md5($pass);
$conn = mysqli_connect("localhost", "root", "", "quizzer");

if($table=='Recruiters')
	$sql1 = "SELECT * from $table where RecruiterEmail='$email'";
else
  $sql1 = "SELECT * from $table where UserEmail='$email'";


$result1 = mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0)  {
  $row = mysqli_fetch_assoc($result1);
  if($row["Password"] == $pass && $row["Status"]==1)  {
      if($table=='Users') {
        $_SESSION['id'] = $row['UserId'].".".$table;
        $_SESSION['name'] = $row['UserName'];
        header("Location: ./../user/User_Home.php");
      }
      else {
        $_SESSION['id'] = $row['RecruiterId'];
        $_SESSION['name'] = $row['RecruiterName'];
        $_SESSION['email'] = $_POST['email'];

        if($table=='Users')
              header("Location: ./user/User_Profile.php");
       else{
              $sql = "SELECT * from payment_info where RECRUITERID=".$row['RecruiterId']." and STATUS='TXN_SUCCESS'";
              $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) <= 0)
    {
      header("Location: ./../recruiter/Payment_Info.php");
    }
    else
     header("Location: ./../recruiter/Recruiter_Home.php");
 }
      }
  }
  else if($row["Password"] != $pass )  {
    	echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("Incorrect Password !!!");
            </script>
            </body>
            </html>';  }
  else if($row["Status"] != 1)  {
 	    echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("Email id is not verified yet. !!!");
            </script>
            </body>
            </html>';
  }
}   
else {
  echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("You have not registered yet !!");
            </script>
            </body>
            </html>';
}   

mysqli_close($conn);
 
?>
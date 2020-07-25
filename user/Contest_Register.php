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

	$new = explode('.',$_SESSION['id']);
	$id = $new[0];
	$currentUserId=$id;
	$tableName = $_GET['contestid']."_users";

	$query4 = "SELECT * from users where UserId='$currentUserId'";
    $result = mysqli_query($conn,$query4);
    $row = mysqli_fetch_assoc($result);

    $query5 = "INSERT INTO $tableName (UserId,UserName,UserEmail,CollegeName) values ('".$row['UserId']."','".$row['UserName']."','".$row['UserEmail']."','".$row['CollegeName']."')";
    $result1 = mysqli_query($conn,$query5);

    echo "<html>
          <head>
          	<meta http-equiv='refresh' content='0;url=Contest_Description.php?contestid=".$_GET['contestid']."'>
          </head>
          <body>
            <script type='text/javascript'>
              alert('Successfully Registered !!!');
            </script>
          </body>
          </html>";

?>
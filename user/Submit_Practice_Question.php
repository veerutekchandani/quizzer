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

$other = $_GET['other'];
if($other==0)
$subject = $_POST['subject'];
else
$subject = $_POST['other'];
$question = $_POST['question'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$choice4 = $_POST['choice4'];
$answer = $_GET['answer'];
$description = $_POST['description'];

$new = explode('.',$_SESSION['id']);
$id = $new[0];
$currentUserId=$id;

if($other==0) {
	$query = "SELECT SubjectId from subjects where SubjectName='".$subject."'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($result);
	$subjectId = $row['SubjectId'];
	$tableName=$subjectId."_subject";

	$query = "INSERT INTO $tableName (UserId,Question,Choice1,Choice2,Choice3,Choice4,Answer,Description) VALUES ('$currentUserId','$question','$choice1','$choice2','$choice3','$choice4','$answer','$description')";
	$result = mysqli_query($conn,$query);
	if($result) {
		echo "<script>window.location.href='Practice.php'</script>";
	}
	else {
		echo "No Table found with this subject name.";
	}
}
else {
	$query = "SELECT max(SubjectId) as SubjectId from subjects";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($result);
	$subjectId = $row['SubjectId'];
	$subjectId++;

	$tableName=$subjectId."_subject";

	$query = "INSERT INTO subjects VALUES('$subjectId','$subject')";
	$result = mysqli_query($conn,$query);

	$query = "CREATE TABLE $tableName (
  				UserId int(11) NOT NULL,
  				Question text NOT NULL,
  				QuestionId int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  				Choice1 varchar(100) DEFAULT NULL,
  				Choice2 varchar(100) DEFAULT NULL,
  				Choice3 varchar(100) DEFAULT NULL,
  				Choice4 varchar(100) DEFAULT NULL,
  				Answer varchar(2) NOT NULL,
  				Description varchar(500) NOT NULL DEFAULT 'None' )";
  	$result = mysqli_query($conn,$query);

  	$query = "INSERT INTO $tableName (UserId,Question,Choice1,Choice2,Choice3,Choice4,Answer,Description) VALUES ('$currentUserId','$question','$choice1','$choice2','$choice3','$choice4','$answer','$description')";
	$result = mysqli_query($conn,$query);
	if($result) {
		echo "wait";
		//echo "<script>window.location.href='Practice.php'</script>";
	}
	else {
		echo "failed";
	}
} 


?>
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


$ContestId = $_GET['contestid'];   // Getting contest id of contest from url
$tableName = $ContestId."_questions";  // getting tablename as id_question


$query = "SELECT End from contest where ContestId='$ContestId'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

$endtime=$row["End"];


$query = "SELECT * from $tableName";
$result = mysqli_query($conn,$query);
$noOfQuestion = mysqli_num_rows($result);


$sideList = "";
$questions = "";
$i=1;

$TYPE = array();
$ANSWER = array();

while($row = mysqli_fetch_assoc($result)) {

	$type = $row['Type'];
	$questionId = $row['QuestionId'];
	$question = $row['Question'];
	$answer = $row['Answer'];

	$TYPE[$i]=$type;
	$ANSWER[$i]=$answer;

	$sideList.="<li class='list-group-item ";
	if($i==1){
		$sideList.="active";
		$firstquesid = $questionId;
	}
	$sideList.="' id='".$questionId."'>Question ".$i.":</li>";


	$questions.="<div id='ques_".$questionId."'";
	if($i!=1) {
		$questions.=" hidden";
	}

	$questions.="><pre>".$i.": ".$question."</pre><br>";

	$choice1 = $row['Choice1'];
	$choice2 = $row['Choice2'];
	$choice3 = $row['Choice3'];
	$choice4 = $row['Choice4'];

	if($type=="MCSA") {
		$questions.="<div><input type='radio' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice1."</pre></label></div>
		<div><input type='radio' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice2."</pre></label></div>
		<div><input type='radio' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice3."</pre></label></div>
		<div><input type='radio' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice4."</pre></label></div>";
	}
	else if($type == "MCMA") {
		$questions.="<div><input type='checkbox' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice1."</pre></label></div>
		<div><input type='checkbox' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice2."</pre></label></div>
		<div><input type='checkbox' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice3."</pre></label></div>
		<div><input type='checkbox' name='choice_".$questionId."'><label style='width: 90%;'><pre>".$choice4."</pre></label></div>";
	}
	else if($type == "TF") {
		$questions.="<div><input type='radio' name='choice_".$questionId."'><label style='width: 90%;'><pre>True</pre></label></div>
		<div><input type='radio' name='choice_".$questionId."'><label style='width: 90%;'><pre>False</pre></label></div>";
	}
	else {
		$questions.="<textarea placeholder='Enter Answer' id='choice_".$questionId."' cols='80' style='margin-left: 20px;border-radius: 10px;padding: 10px;'></textarea>";
	}
	$questions.="</div>";
	$i++;
}


mysqli_close($conn);
?>
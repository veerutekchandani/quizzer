<?php

session_start();
$_SESSION['page']='Contest_Preview';

$cid=$_POST["contestid"];
$var=$_POST["js_test"];
echo $var;
$someArray = json_decode($var, true);
$message="";
if(isset($_GET["submit"])) {
	if($_GET["submit"]=="true"){    
		submit($someArray,$cid);
	}
	
	
}

?>


<html>

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/userhome.css">
	<link rel="stylesheet" type="text/css" href="css/preview.css">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="css/global.css">


	<script
	src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous">
</script>
<script> 
	$(function(){
		$("#header").load("Header.php"); 
		$("#footer").load("Footer.php"); 
	});
</script> 


<script>
	function func(){
		var simple = '<?php echo $var; ?>';
		


var f = document.createElement('form');
f.action='Contest_Preview.php?submit=true';
f.method='POST';

var i=document.createElement('input');
i.type='hidden';
i.name='contestid';
i.value=<?php echo $cid ?>;
f.appendChild(i);

var j=document.createElement('input');
j.type='hidden';
j.name='js_test';
j.value=simple;
f.appendChild(j);

document.body.appendChild(f);
f.submit();

	}
	
	
	function edit(){
		var simple = '<?php echo $var; ?>';

       
var f = document.createElement('form');
f.action='Edit_Questions.php?submit=true';
f.method='POST';


var i=document.createElement('input');
i.type='hidden';
i.name='contestid';
i.value=<?php echo $cid ?>;
f.appendChild(i);

var j=document.createElement('input');
j.type='hidden';
j.name='js_test';
j.value=simple;
f.appendChild(j);

document.body.appendChild(f);
f.submit();

		
		
	}

	
</script>
</head>



<body>
	<div id="header"></div>

	<div id="headnam" style="background : #f7f7f7;">
		<label  style="font-size:30px;
		color:black;
		font-family: 'Times New Roman', Times, serif;
		font-style: normal;
		font-weight:normal;
		margin-left:20px;
		margin-top:15px;
		margin-bottom:15px;">Preview Questions</label>
	</div>	

	<div id="parent">
		<div id="inside">

			<?php

			$count=1;
			foreach ($someArray as $key => $value) {
				echo $count.".  ".$value["Question"]. "<br>";
				if($value["Type"]=="MCSA" || $value["Type"]=="MCMA"){
					echo "<label style='color:gray;font-weight:normal;font-size:18px;'>(a).  ".$value["Choice1"] . "<br>";
					echo "(b).  ".$value["Choice2"] . "<br>";
					echo "(c).  ".$value["Choice3"] . "<br>";
					echo "(d).  ".$value["Choice4"] . "</label><br>";
				}
				echo "<label style='color:green;font-weight:normal;'>Ans- ".$value["Answer"] . "</label><br><br><br><br>";
				$count++;
			}

			
 //print_r($someArray);  
//echo $var;
//$_SESSION['varname'] = ans;
			?>
			
			
			<Button onclick="func()" class="btn btn-primary"> Save Questions </Button>
			<Button onclick="edit()" class="btn btn-primary"> Edit Questions </Button>
		</div>
	</div>
	

	<div id="footer"></div>

	<?php

	function submit($someArray,$cid){
		require_once("Config.php");
		$count=0;
		$result = $conn->query("delete from ".$cid."_questions");
		foreach ($someArray as $key => $value) {
			
			$sql='';
			
			if($value["Type"]=="MCSA" || $value["Type"]=="MCMA"){
				$sql="insert into ".$cid."_questions (Question,Type,Choice1,Choice2,Choice3,Choice4,Answer) values ('".$value["Question"]."','".$value["Type"]."','".$value["Choice1"]."',
				'".$value["Choice2"]."','".$value["Choice3"]."','".$value["Choice4"]."','".$value["Answer"]."')";
		//		echo $sql;
			}
			else if($value["Type"]=="MCSA"){
				$sql="insert into ".$cid."_questions (Question,Type,Choice1,Choice2,Choice3,Choice4,Answer) values ('".$value["Question"]."','".$value["Type"]."','True',
				'False','','','".$value["Answer"]."')";
			}
			else{
				$sql="insert into ".$cid."_questions (Question,Type,Choice1,Choice2,Choice3,Choice4,Answer) values ('".$value["Question"]."','".$value["Type"]."','',
				'','','','".$value["Answer"]."')";
			}
			
			if(!$result = $conn->query($sql)){
				$count=0;
				die('There was an error running the query [' . $conn->error . ']');
			}
			$count++;

		}
		if($count==$someArray.length)
			;//echo "<script>window.location.href = window.location.href.replace(/[^/]*$/, '')+'Recruiter_Home.php';</script>";

	}
	?>

	<body> 
		
		
		
	</body>
	</html>
	</html>
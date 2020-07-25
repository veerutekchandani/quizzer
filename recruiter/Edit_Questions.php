<?php

session_start();
$_SESSION['page']='Edit_Questions';
require_once("Config.php");

$cid=-1;
if(isset($_GET["contestid"]))
	$cid=$_GET["contestid"];
else if(isset($_POST["contestid"]))
	$cid=$_POST["contestid"];
else
$cid=$_SESSION["cid"];



$var="";
if(isset($_POST["js_test"])) {
	$var=$_POST["js_test"];
	$someArray = json_decode($var, true);

}
else{
	$sql = "SELECT * FROM ".$cid."_questions";
	$result = $conn->query($sql);
	$arr=array(); 
	$var="";			
	if ($result->num_rows > 0) {
                
		$count=1;
		while($row = $result->fetch_assoc()) {
			$arr[]=$row;
		}
		$var=json_encode($arr);
	}
	else{
	}

	$someArray = json_decode($var, true);


}

?>



<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/add_questions.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/userhome.css">

	<?php
	require_once("Config.php");

//$contest_id=$_POST['cid'];

	?>

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


<?php

?>



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
		margin-bottom:15px;">Questions</label>
	</div>	



	<div id="hel"></div> 


	<div id="hide">

		<div id="MCSA">
			<label>Enter question</label>  
			<br/>
			<input type="text" id="Ques" class="maintext"/>
			<br/>


			<input type="radio" name="mcq" id="anso1" value="a"/>
			<label>A. </label>
			<input type="text" class="subtext" id="o1"/>
			<br/>   

			<input type="radio" name="mcq" id="anso2" value="b"/>
			<label>B. </label>
			<input type="text" class="subtext" id="o2"/>
			<br/>

			<input type="radio" name="mcq" id="anso3" value="c"/>
			<label>C. </label>
			<input type="text" class="subtext" id="o3"/>
			<br/>

			<input type="radio" name="mcq" id="anso4" value="d"/>
			<label id="demo" >D.</label>
			<input type="text" class="subtext" id="o4"/>
			<br/>
			<Button id="delete" onclick="deleteQues(this.id)" class="btn btn-primary"> Delete Question </Button>
			<br/>
			<br/>
			<br/>
		</div>


		<div id="MCMA">
			<label>Enter question</label>  
			<br/>
			<input type="text" class="maintext" id="Ques" name="Ques"/>
			<br/>


			<input type="checkbox" id="anso1"  value="a"/>
			<label>A. </label>
			<input type="text" class="subtext" id="o1"/>
			<br/>   

			<input type="checkbox" id="anso2" value="b"/>
			<label>B. </label>
			<input type="text" class="subtext" id="o2"/>
			<br/>

			<input type="checkbox" id="anso3" value="c"/>
			<label>C. </label>
			<input type="text" class="subtext" id="o3"/>
			<br/>

			<input type="checkbox" id="anso4" value="d"/>
			<label>D.</label>
			<input type="text" class="subtext" id="o4"/>
			<br/>
			<Button id="delete" onclick="deleteQues(this.id)" class="btn btn-primary"> Delete Question </Button>

			<br/>
			<br/>
			<br/>
		</div>

		<div id="TF">
			<label>Enter question</label>  
			<br/>
			<input type="text" class="maintext" id="Ques" name="Ques"/>
			<br/>


			<input type="radio" name="bool" id="o1" value="True"/>
			<label>True </label>

			<br/>   

			<input type="radio" name="bool" id="o2" value="False"/>
			<label>False </label>

			<br/>
			<Button id="delete" onclick="deleteQues(this.id)" class="btn btn-primary"> Delete Question </Button>


			<br/>
			<br/>
			<br/>
		</div>

		<div id="AA">
			<label>Enter question</label>  
			<br/>
			<input type="text" class="maintext" id="Ques" name="Ques"/>
			<br/>


			<label>Enter answer  </label>
			<br/>
			<input type="text" class="maintext" id="ans"/>
			<br/>
			<Button id="delete" onclick="deleteQues(this.id)" class="btn btn-primary"> Delete Question </Button>

			<br/>   
			<br/>
			<br/>
		</div>   

	</div>



	<div id="parent">
		<div id="inside">

		</div>	

		<div id="inside2">
			<select id="type" class="subtext" style="width:40%">  
				<option value="MCSA">Multiple Choice,Single answer question</option>
				<option value="MCMA">Multiple Choice,Multiple answer question</option>	
				<option value="TF">True/False question</option>  
				<option value="AA">Add answer Type</option>  
			</select> 
			<br/>
			<br/>

			<div width="50%">
				<Button onclick="myFunction()" class="btn btn-primary"> ADD NEW </Button>&nbsp;&nbsp;&nbsp;
				<Button onclick="submit()" class="btn btn-primary"> Submit </Button>
			</div>

		</div>
	</div>









	<label id="op">  </label>

	<script>
		document.getElementById("hide").style.display = "none";



	</script>  


	<script>
//var x = myFunction(4, 3);
var x=0;


var list=[];
var e = document.getElementById("type");

//alert("hi");
var json='<?php echo $var; ?>';
//alert(json);

var jlist=[];
if(json!="")
	jlist=JSON.parse(json);
//alert(jlist.length);

for(var i=0;i < jlist.length;i++)
{
	//alert(jlist[i].o1);
	addnew(jlist[i].Question,jlist[i].Choice1,jlist[i].Choice2,jlist[i].Choice3,jlist[i].Choice4,jlist[i].Answer,jlist[i].Type);
}

var del=[];
function deleteQues(id) {
	var ids=id.substr(6);
	//alert(ids);
	del.push(ids);
	document.getElementById(ids).style.display = "none";;
}


function addnew(Ques,o1,o2,o3,o4,ans,type) {
	var itm;
	var cln;
	var str = type;
	var q={
		Question: Ques,
		Choice1: o1,
		Choice2: o2,
		Choice3: o3,
		Choice4: o4,
		Answer: ans,
		Type: type
	};
	q.Type=str;
    //alert(str);

    if (str=="MCSA")
    {  
    	itm = document.getElementById("MCSA");

    }
    if (str=="MCMA") 
    {
    	itm = document.getElementById("MCMA");
    }
    if (str=="TF") 
    {
    	itm = document.getElementById("TF");
    }
    if (str=="AA") 
    {
    	itm = document.getElementById("AA");
    }
    cln = itm.cloneNode(true);
    cln.id=x;
    cln.name=x;
    cln.querySelector("#delete").id='delete'+x;
    if (str=="MCSA")
    {  
    	cln.querySelector("#anso1").name='mcq'+x;
    	cln.querySelector("#anso2").name='mcq'+x;
    	cln.querySelector("#anso3").name='mcq'+x;
    	cln.querySelector("#anso4").name='mcq'+x;

    }
    if (str=="TF")
    {  
    	cln.querySelector("#o1").name='bool'+x;
    	cln.querySelector("#o2").name='bool'+x;

    }

    x++;

    cln.querySelector("#Ques").value=Ques;

    if (str=="MCSA")
    {  
    	cln.querySelector("#o1").value=o1;
    	cln.querySelector("#o2").value=o2;
    	cln.querySelector("#o3").value=o3;
    	cln.querySelector("#o4").value=o4;

    	if(ans=="a"){
			//alert("hello");
			cln.querySelector("#anso1").checked=true;
		}
		if(ans=="b"){
			cln.querySelector("#anso2").checked=true;
		}
		if(ans=="c"){
			cln.querySelector("#anso3").checked=true;
		}
		if(ans=="d"){
			cln.querySelector("#anso4").checked=true;
		}


	}
	if (str=="MCMA") 
	{
		cln.querySelector("#o1").value=o1;
		cln.querySelector("#o2").value=o2;
		cln.querySelector("#o3").value=o3;
		cln.querySelector("#o4").value=o4;

		
		if(ans.includes("a")){
			//alert("hello");
			cln.querySelector("#anso1").checked=true;
		}
		if(ans.includes("b")){
			cln.querySelector("#anso2").checked=true;
		}
		if(ans.includes("c")){
			cln.querySelector("#anso3").checked=true;
		}
		if(ans.includes("d")){
			cln.querySelector("#anso4").checked=true;
		}
		
	}
	if (str=="TF") 
	{
		cln.querySelector("#o1").value="True";
		cln.querySelector("#o2").value="False";

		
		if(ans=="True"){
			cln.querySelector("#o1").checked=true;
		}
		else if(ans=="False"){
			cln.querySelector("#o2").checked=true;
		}
		
	}
	if (str=="AA") 
	{
		cln.querySelector("#ans").value=ans;

	}
	
	list.push(q);
	document.getElementById("inside").appendChild(cln);

}





function myFunction() {
	var itm;
	var cln;
	var e = document.getElementById("type");
	var str = e.options[e.selectedIndex].value;
	var q={
		Question: "",
		Choice1: "",
		Choice2: "",
		Choice3: "",
		Choice4: "",
		Answer: "",
		Type: ""
	};
	q.Type=str;
    //alert(str);

    if (str=="MCSA")
    {  
    	itm = document.getElementById("MCSA");

    }
    if (str=="MCMA") 
    {
    	itm = document.getElementById("MCMA");
    }
    if (str=="TF") 
    {
    	itm = document.getElementById("TF");
    }
    if (str=="AA") 
    {
    	itm = document.getElementById("AA");
    }
    cln = itm.cloneNode(true);
    cln.id=x;
    cln.name=x;
    cln.querySelector("#delete").id='delete'+x;
    if (str=="MCSA")
    {  
    	cln.querySelector("#anso1").name='mcq'+x;
    	cln.querySelector("#anso2").name='mcq'+x;
    	cln.querySelector("#anso3").name='mcq'+x;
    	cln.querySelector("#anso4").name='mcq'+x;

    }
    if (str=="TF")
    {  
    	cln.querySelector("#o1").name='bool'+x;
    	cln.querySelector("#o2").name='bool'+x;

    }
    x++;
    list.push(q);
    document.getElementById("inside").appendChild(cln);

}


function validate(){
	
	
	var k=0;
	
	for(var i=0;i<x-k;i++)
	{  
		var z=i+k;
		if(del.includes(""+z)){

			list.splice(i,1);
			var zz=z+"";
		/* del = del.filter(function(value, index, arr){
			 return value == zz;
			});*/
			i--;
			k++;
			continue;
		}
     //alert("here1 "+z); 
     itm = document.getElementById(z);

     list[i].Question=itm.querySelector("#Ques").value;

     if (list[i].Type=="MCSA")
     {
     	list[i].Choice1=itm.querySelector("#o1").value;
     	list[i].Choice2=itm.querySelector("#o2").value;
     	list[i].Choice3=itm.querySelector("#o3").value;
     	list[i].Choice4=itm.querySelector("#o4").value;
     	var answer = document.getElementsByName('mcq'+z);

     	var ans_value="";
     	for(var j = 0; j < answer.length; j++){
     		if(answer[j].checked){
     			ans_value = answer[j].value;
     		}
     	}
		//alert("hi");
		list[i].Answer=ans_value;
		//list[i].o1=;
		//alert("hiiii");
		if(list[i].Choice1==""
			|| list[i].Choice2==""
			|| list[i].Choice3==""
			|| list[i].Choice4=="")
			return false;

	}
	if (list[i].Type=="MCMA") 
	{    
		list[i].Choice1=itm.querySelector("#o1").value;
		list[i].Choice2=itm.querySelector("#o2").value;
		list[i].Choice3=itm.querySelector("#o3").value;
		list[i].Choice4=itm.querySelector("#o4").value;
		var ans_value="";

		if(itm.querySelector("#anso1").checked)
			ans_value+= itm.querySelector("#anso1").value+",";
		if(itm.querySelector("#anso2").checked)
			ans_value+= itm.querySelector("#anso2").value+",";
		if(itm.querySelector("#anso3").checked)
			ans_value+= itm.querySelector("#anso3").value+",";
		if(itm.querySelector("#anso4").checked)
			ans_value+= itm.querySelector("#anso4").value+",";
		list[i].Answer=ans_value;
		
		if(list[i].Choice1==""
			|| list[i].Choice2==""
			|| list[i].Choice3==""
			|| list[i].Choice4=="")
			return false;


	}
	else if (list[i].Type=="TF") 
	{
		list[i].Choice1=itm.querySelector("#o1").value;
		list[i].Choice2=itm.querySelector("#o2").value;
		var answer = document.getElementsByName('bool'+z);
		var ans_value="";
		for(var j = 0; j < answer.length; j++){
			if(answer[j].checked){
				ans_value = answer[j].value;
			}
		}
		list[i].Answer=ans_value;
		//alert(list[i].o1+"  mid "+ans_value);
		if(list[i].Answer=="")
			return false;

	}
	else if (list[i].Type=="AA") 
	{
		list[i].Answer=itm.querySelector("#ans").value;    
	}
	
	if(list[i].Question==""
		|| list[i].Answer=="")
		return false;
	
	
	
}
return true;
}


function submit(){


	if(!validate()){
		alert("Please Fill All Fields to Continue.");
		return 0;
	}
  //alert(list.length);
  
  var op=document.getElementById("op");
  var ans="";   
/*for(var i=0;i<x;i++){
    ans+=list[i].question+"<br/>";
	ans+=list[i].o1+"<br/>";
	ans+=list[i].o2+"<br/>";
	//alert("Now");
	
    if (list[i].type=="MCSA")
    {
    	ans+=list[i].o3+"<br/>";
	    ans+=list[i].o4+"<br/>";
	
	}
    if (list[i].type=="MCMA") 
    {
        ans+=list[i].o3+"<br/>";
	    ans+=list[i].o4+"<br/>";
	
    }
	if (list[i].type=="TF") 
    {
        
    }
	if (list[i].type=="AA") 
    {
        ans+=list[i].ans+"<br/>";
    }
}
*/
/*var queryString = Object.keys(ans).map(function(key) {
    return key + '=' + ans[key]
}).join('&');*/
var myJSON = JSON.stringify(list);
op.innerHTML=ans;


//var href=window.location.href;
//window.location.href = window.location.href.replace(/[^/]*$/, '')+'Contest_Preview.php?contestid='++'&js_test='+myJSON;


var f = document.createElement('form');
f.action='Contest_Preview.php';
f.method='POST';


var i=document.createElement('input');
i.type='hidden';
i.name='contestid';
i.value=<?php echo $cid ?>;
f.appendChild(i);

var j=document.createElement('input');
j.type='hidden';
j.name='js_test';
j.value=toString(myJSON);
f.appendChild(j);

document.body.appendChild(f);
f.submit();

}



</script>



<footer>
	<div id="footer"></div>
</footer>

</body>

</html>
</html>
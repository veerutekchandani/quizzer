<html>

<head>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet"  type="text/css" href="css/global.css">
<link rel="stylesheet" type="text/css" href="css/userhome.css">

<link rel="stylesheet" type="text/css" href="css/recruiter_home.css"> 

 
<?php
session_start();
$_SESSION['page']='Contest_Users';
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


<script>
 function edit(id){
    window.location.href = window.location.href.replace(/[^/]*$/, "")+"Edit_Questions.php?contestid="+id;
 }
 
</script>

</head>



<body>
<div id="header"></div>


   <div id="hel"></div> 
   
   
<?php
require_once("Config.php");
?>
   
   
  <div id="headnam" style="background : #f7f7f7;">
	<label  style="font-size:30px;
	color:black;
	font-family: 'Times New Roman', Times, serif;
	font-style: normal;
	font-weight:normal;
	margin-left:20px;
	margin-top:15px;
	margin-bottom:15px;">Leader Board</label>
  </div>	
   
   
   
  
  <div id="parent" >
     <div id="inside">
      <table>
        <tr>
		  <th>Rank</th>
          <th>Name</th>
          <th>Email</th>
		  <th>Marks</th>
          
        </tr>
		<?php
		    $sql = "SELECT * FROM ".$_GET['contestid']."_users order by Marks desc";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
				$count=0;
                while($row = $result->fetch_assoc()) {
                  $count++;
		?>
        <tr>
		<td><?php echo $count?></td>
          <td><?php echo $row["UserName"]?></td>
          <td><?php echo $row['UserEmail']?></td>
          <td><?php echo $row['Marks']?></td>
		  </td>
		 </tr> 
		<?php
		   
			}
			}
			else{
		?>	
            </table>		
            <label style="text-align:center;margin:10px;font-size:17px;"> No Users Registered. Share Contest link with Students.</label>
        <?php
			}		
		?>
  
</table>
</div>	
  </div>
  
  
  <footer>
<div id="footer"></div>
</footer>


</body>

</html>
</html>
    <?php

    session_start();
    $_SESSION['page']='Add_Contest';
    date_default_timezone_set('Asia/Kolkata');
    $currentdatetime=date_create(date('Y-m-d'));
    $result = $currentdatetime->format('Y-m-d h:i');

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $target_dir = "./../uploads/Contest/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }

    // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }
    // Check file size
      if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }
    // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

  }





  $cid=-1;
  if(isset($_POST["submit"])) {

    require_once("Config.php");

    $name=$_POST['tname'];
    $s_date_time=$_POST['s_date_time'];
    $e_date_time=$_POST['e_date_time'];
    $desc=$_POST['desc'];
    //$image=$_POST['image'];

    $sql="insert into contest (ContestName,Start,End,Description,Image,RecruiterId) values('".$name."','".$s_date_time."','".$e_date_time."','".$desc."','".$_FILES["image"]["name"]."',".$_SESSION['id'].")";

    if(!$result = $conn->query($sql)){
      die('There was an error running the query [' . $conn->error . ']');
    }
    else{
      $sql="select ContestId from contest where ContestName='".$name."'";
     $result = $conn->query($sql);
     $row=$result->fetch_assoc();
     $sql="create table ".$row['ContestId']."_questions (QuestionId int not null auto_increment,Question text not null,Type text not null,Choice1 text not null,
     Choice2 text not null,Choice3 text not null,Choice4 text not null,Answer text not null,primary key(QuestionId))";



     if(!$result = $conn->query($sql))
       die('There was an error running the query [' . $conn->error . ']');
     else { 
       $sql="create table ".$row['ContestId']."_users (UserId int not null auto_increment,UserName varchar(255) not null,UserEmail varchar(255) not null,CollegeName text not null,
       Marks int,primary key(UserId))";
       if(!$result = $conn->query($sql))
         die('There was an error running the query [' . $conn->error . ']');
       else{

         $cid=$row['ContestId'];

         $_SESSION['cid']=$cid;
         echo '<script>window.location.href = window.location.href.replace(/[^/]*$/, "")+"Edit_Questions.php?js_test=[]&contestid='.$cid.'&submit=true";</script>';


       }
     }
   }


 }

 ?>


 <html>

 <head>

  <link href="./boot/boot2/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="./boot/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/userhome.css">
  <link rel="stylesheet" type="text/css" href="css/add_contest.css">
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
  function pagesubmit(){
   alert("here");
 }
</script> 


</head>



<body>
  <div id="header"></div>

  <?php
  require_once("Config.php");
  ?>


  <div  style="background : #f7f7f7;">
   <label style="font-size:30px;
   color:black;
   font-family: 'Times New Roman', Times, serif;
   font-style: normal;
   font-weight:normal;
   margin-left:20px;
   margin-top:15px;
   margin-bottom:15px;">Add Contest</label>
 </div>	


 <div class="container">



 </div>




 
 <div id="parent" >

   <div id="inside">

     <form  method="post" id="register_form" action="Add_Contest.php" onsubmit="return validate()" enctype="multipart/form-data" >


      <div class="form-group">
        <label for="organ">Test Name:</label>
        <input type="textarea" class="form-control" id="tname" placeholder="Enter Test Name" name="tname" required>
      </div>

      <div class="form-group">
        <label for="email">Start Date and Time:</label>
        <div class="controls input-append date form_datetime"  id="sdate"  data-date="1979-09-16T05:25:07Z" data-date-format="yyyy-mm-dd hh:ii" 
        data-link-field="dtp_input1">
        <input size="20" type="text" style="height: 30px" value="" required onkeypress="return false;"  >
        <span class="add-on" style="height: 30px"><i class="icon-th"></i></span>
      </div>
      <input type="text" id="s_date_time" name="s_date_time" value="" hidden />
    </div>

    <div class="form-group">
      <label for="pass">End Date and Time:</label>
      <div class="controls input-append date form_datetime2" id="edate" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" 
      data-link-field="dtp_input1">
      <input style="height: 30px" size="20" type="text"  value="" required onkeypress="return false;" >
      <span class="add-on" style="height: 30px"><i class="icon-th"></i></span>
    </div>
    <input type="text" id="e_date_time" name="e_date_time" value="" hidden /></div>

    <div class="form-group">
      <label for="pass">Description:</label>
      <input type="textarea" class="form-control" id="desc" placeholder="Enter Description" name="desc" required />
    </div>



    <div class="form-group">
      <label for="pass">Image:</label>
      <input type="file" style="height: 45px" class="form-control" id="image"  name="image" required />
    </div>



    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember" required />   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I agree on <a href="tc.htm"> terms and conditions</a>
      </label>
    </div>




    <input type="submit"  name="submit" id="submit" value="&nbsp;Submit&nbsp;" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="reset" class="btn btn-danger">&nbsp;&nbsp;Reset&nbsp;&nbsp;</button>


  </form>

</div>
</div>



<script type="text/javascript" src="./boot/boot2/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./boot/boot2/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./boot/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="./boot/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>



<script type="text/javascript">

  $(".form_datetime").datetimepicker({
    format: "dd MM yyyy - hh:ii",
    linkField: "s_date_time",
    linkFormat: "yyyy-mm-dd hh:ii",
    autoclose: true,
        //todayBtn: true,
        startDate: "<?php echo $result ?>",
        minuteStep: 5
      });
	//var x='2102-12-03 04:00';//document.getElementById("s_date_time").value;
	$(".form_datetime2").datetimepicker({
		
    format: "dd MM yyyy - hh:ii",
    linkField: "e_date_time",
    linkFormat: "yyyy-mm-dd hh:ii",
    autoclose: true,
        //todayBtn: true,
        startDate: "<?php echo $result ?>",
        minuteStep: 5
      });
    </script>     

    <script>

      function validate(){
        var start=document.getElementById("s_date_time").value;
        var end=document.getElementById("e_date_time").value;
        var date1 = new Date(parseInt(start.substr(0,4),10),parseInt(start.substr(5,2),10),parseInt(start.substr(8,2),10)
          ,parseInt(start.substr(11,2),10),parseInt(start.substr(14,2),10)); 
        var date2 = new Date(parseInt(end.substr(0,4),10),parseInt(end.substr(5,2),10),parseInt(end.substr(8,2),10)
          ,parseInt(end.substr(11,2),10),parseInt(end.substr(14,2),10));

        if (date2 < date1) {
         alert("Please Select a valid Date time range.");
         return false;
       }
       else{

       }
     }
   </script>


   <div id="footer"></div>



 </body>

 </html>
<?php

if(isset($_GET['vkey']) && isset($_GET['db']))
{

  $vkey = $_GET['vkey'];
  $table = $_GET['db'];
  $conn = mysqli_connect("localhost","root","","quizzer");

  $query = "select Status,Vkey 
  from $table
  where Status=0 and Vkey='$vkey' ";

  $res = mysqli_query($conn,$query);

  if(mysqli_num_rows($res) == 1)
  {
      $update = "update $table set Status=1 where Vkey='$vkey'";
      if(mysqli_query($conn,$update))
      {
 	      echo "Successfully Registered !!\n";
        $query = "select * from $table where Vkey='$vkey'";
        $res = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($res);
        
        if($table == 'Recruiters')
          $to = $row["RecruiterEmail"];
        else
          $to = $row["UserEmail"];

        $subject = "Registration confirmed for Quizzer";
        $message = "You have successfully registered on Quizzer..\n\n";
        $message .= "Regards Team Quizzer";
        $headers = "Team quizzer";
        if(mail($to, $subject, $message,$headers)) {
          echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("Successfully registered !! Please login !!");
            </script>
            </body>
            </html>';
        }  
        else
          echo "Confirmation mail not sent !!!";
      }
      else
 	        die("Something went wrong!!!");
  }
  else {
  	echo "Email address is  already registered !!";
    $rem = "delete from $table where Vkey='$vkey' and Status=0";
    mysqli_query($conn,$rem);
  }
}
else  {
	die("Something Went wrong !");
}

mysqli_close($conn);

 ?>
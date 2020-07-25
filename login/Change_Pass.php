<?php

session_start();

if(isset($_POST['submit']))
{
	$new = explode('.',$_SESSION['id']);
    $id = $new[0];
    $table=$new[1];

    $pass = $_POST['pass'];

    $pass = md5($pass);

    $conn = mysqli_connect("localhost","root","","quizzer");

     if($table == 'Recruiters')
     {
    
          $query = "update $table
               set Password = '$pass'
                where RecruiterId = '$id'";

      }  

      else
      {
           
           $query = "update $table
               set Password = '$pass'
                where UserId = '$id'";


      }        

         if(mysqli_query($conn,$query))
         {

            echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=Logout.php">
            </head>
            <body>
            <script type="text/javascript">
              alert("Password successfully Changed !!. Please login to continue !!!");
            </script>
            </body>
            </html>';

         }  
         else
         {
         	echo '<script type="text/javascript">
              alert("An error occurred !!");
              </script>' ;
         }     
          
          
}
mysqli_close($conn);


?>
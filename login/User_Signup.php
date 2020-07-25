<?php
  
  $username = $_POST["uname"];
  $email = $_POST["email"];
  $pass = $_POST["pass3"];
  
  $conn = mysqli_connect("localhost", "root", "", "quizzer");
  
  $vkey = md5($username.$email);
  $pass = md5($pass);

$sql = "create table if not exists Users(
          UserId int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          UserName varchar(255) NOT NULL,
          UserEmail varchar(255) NOT NULL UNIQUE,
          Password varchar(255) NOT NULL,
		      Vkey varchar(255) NOT NULL,
		      Status boolean default 0,
          ProfilePic varchar(255),
          FullName varchar(255),
          DOB date,
          CollegeName varchar(255),
          Mobile varchar(50)
      )";


 if(mysqli_query($conn,$sql))  {
 	    $sql = "insert into Users(UserName, UserEmail, Password, Vkey, ProfilePic) values('$username', '$email', '$pass', '$vkey', 'defaultprofile.jpg')";

      if(mysqli_query($conn,$sql)) {
          $table = "Users";

          $to = $email;
          $subject = "Account Verification for Quizzer";
          $message = "<a href='http://localhost:8080/quizzer/login/Verify.php?vkey=$vkey&db=$table'> Register Account </a>";
          $headers = "From: Team quizzer \r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          if(mail($to, $subject, $message, $headers)){
            echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("Verification link has been sent to your email !!!");
            </script>
            </body>
            </html>';
          }
              
          else {
              echo "Some error occurred !! Mail not Sent !!!";
            }
      }
      else {
			echo "SQL query failed!!!";
		}
 }
else
  echo "table creation !!!";    

mysqli_close($conn);

?>
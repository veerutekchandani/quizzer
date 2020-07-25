<?php


 $name = $_POST["uname"];
 $email = $_POST["email"];
 $pass = $_POST["pass1"];
 $org = $_POST["org"];

$conn = mysqli_connect("localhost", "root", "", "quizzer");

$vkey = md5($name.$email);
$pass = md5($pass);

      $sql = "CREATE table if not exists Recruiters(
              RecruiterId int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
              RecruiterName varchar(255) NOT NULL,
              RecruiterEmail varchar(255) NOT NULL UNIQUE,
              Password varchar(255) NOT NULL,
              Vkey varchar(255) NOT NULL,
               Status boolean default 0,
               ProfilePic varchar(255),
               Organization varchar(255),
               DOB date,
               Mobile varchar(50)
              )";

      if(mysqli_query($conn,$sql))        
       {
          $sql = "INSERT into Recruiters(RecruiterName, RecruiterEmail,Organization, Password, Vkey, ProfilePic)
                        values('$name', '$email','$org', '$pass', '$vkey', 'defaultprofile.jpg')";
          if(mysqli_query($conn,$sql))  {
              $table = "Recruiters";
              $to = $email;
              $subject = "Account Verification for Quizzer";
              $message = "<a href='http://localhost:8080/quizzer/login/Verify.php?vkey=$vkey&db=$table'> Register Account </a>";
            
              $headers = "From: Team quizzer \r\n";
              $headers .= "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

              if(mail($to, $subject, $message, $headers)) {
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
                echo "Something went wrong !! Mail not sent !!!";
              }
          }
          else { 
	             echo "Something went wrong!! Data not inserted !!";
          }
      }
      else {
        echo "Something went wrong !! Table not created !!";
      }
mysqli_close($conn);
?>
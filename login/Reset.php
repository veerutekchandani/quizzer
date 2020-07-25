<?php

$email = $_POST["mail"];
$pass = $_POST["pass"];
$table = $_POST["cate"];

$pass = md5($pass);

$conn = mysqli_connect("localhost","root","","quizzer");

if($table=='Recruiters')
 $query = "select * from $table where RecruiterEmail = '$email'";
else
 $query = "select * from $table where UserEmail = '$email'";   


$res = mysqli_query($conn,$query);

if(mysqli_num_rows($res)>0)
{

 $row = mysqli_fetch_assoc($res);

 if($row["Status"]==1)
 {
 	$vkey = $row["Vkey"];
    $to = $email;
    $subject = "Password Reset for Quizzer";
    $message = "<a href='http://localhost:8080/quizzer/login/Update.php?key=$vkey&val=$pass&db=$table'> Reset Password </a>";
        $headers = "From: Team quizzer \r\n";

         $headers .= "MIME-Version: 1.0" . "\r\n";

         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if(mail($to, $subject, $message,$headers))
    {
        echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("Click on the Password Reset link sent to your email to reset your Password !!!");
            </script>
            </body>
            </html>';
    }
    else
    {
    	echo "Something went wrong !! Mail not sent !!!";
    }

 }
 else
 {
 	echo "Your email is not verified yet!!";
 }

}
else
echo "sorry! You have not registered yet !!";

mysqli_close($conn);

 ?>
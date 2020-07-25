<?php

if(isset($_GET['key']) && isset($_GET['val']) && isset($_GET['db'])) {

    $vkey = $_GET['key'];
    $newpass = $_GET['val'];
    $table = $_GET['db'];
    $conn = mysqli_connect("localhost","root","","quizzer");
    if($conn)  {
            $query = "UPDATE $table set Password='$newpass' where Vkey='$vkey'";
            if(mysqli_query($conn,$query)) {
                echo '<html>
            <head>
            <meta http-equiv="refresh" content="0;url=./../Home.html">
            </head>
            <body>
            <script type="text/javascript">
              alert("Password Successfully changed !!!");
            </script>
            </body>
            </html>';
            }          
            else {
                echo "Something went wrong !!! \n Password not Changed !!";
            }
    }
    else {
        echo "couldn't connect to database !!!";
    }
}
else {
	die("Something went wrong !!");
}
mysqli_close($conn);


?>
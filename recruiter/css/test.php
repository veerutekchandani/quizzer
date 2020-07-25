<script>
	
    var z=1;

</script>

<?php
     $cars = array("Volvo", "BMW", "Toyota");
?>

<script>

var arrayName =   <?php echo json_encode($cars); ?>;
alert(arrayName[z]);

	
</script>



<html>
   
   <head>
      <title>Paging Using PHP</title>
   </head>
   
   <body>
      <?php
        $servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "db2018CA55";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
         $id=106;
         
         $rec_limit = 10;



         $sql = "SELECT count(id) FROM ".$id."_question";

  if(!$result = $conn->query($sql)){
  	$check=1;
   die('There was an error running the query [' . $conn->error . ']');
 }
 


           $row=$result->fetch_assoc();
            $rec_count = $row[0];
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         
         $left_rec = $rec_count - ($page * $rec_limit);
         $sql = "SELECT * ". 
            "FROM ".$id."_question".
            "LIMIT $offset, $rec_limit";
            
  if(!$result = $conn->query($sql)){
  	$check=1;
   die('There was an error running the query [' . $conn->error . ']');
 }
         while($row=$result->fetch_assoc()) {
            echo "EMP ID :{$row['id']}  <br> ".
               "EMP NAME : {$row['question']} <br> ".
               "EMP SALARY : {$row['type']} <br> ".
               "--------------------------------<br>";
         }
         
         if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a> |";
            echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
         }else if( $page == 0 ) {
            echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
         }else if( $left_rec < $rec_limit ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a>";
         }
         
         
      ?>
      
   </body>
</html>
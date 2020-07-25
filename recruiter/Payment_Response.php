<?php
session_start();
$_SESSION['page']='Payment_Response';
 ?>

<html>

<head>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"  type="text/css" href="css/global.css">
  <link rel="stylesheet" type="text/css" href="css/userhome.css">
  <link rel="stylesheet" type="text/css" href="css/payment_info.css"> 
</head>
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
    margin-bottom:15px;">Payment Details</label>
  </div>	

  <div id="parent" >

    <div id="inside">



      <?php
/**
* import checksum generation utility
*/
require_once("lib/encdec_paytm.php");

$paytmChecksum = "";

/* Create a Dictionary from the parameters received in POST */
$paytmParams = array();

/* Taking All key values in array paytmParams */
foreach($_POST as $key => $value){
	if($key == "CHECKSUMHASH"){
		$paytmChecksum = $value;
	} else {
		$paytmParams[$key] = $value;
	}
	

}

?>



<?php
/* If Transaction */
if($paytmParams['RESPMSG']=="Txn Success"){
  ?>
  <div style="text-align: left;">
    <i class="fa fa-check-square" style="font-size: 45px;color: green;font-weight: normal;margin-top: 10px"></i> &nbsp;&nbsp;&nbsp;&nbsp;
    <label style="font-size: 30px;color: green;">Transaction Successful</label>
  </div>
  <?php

}
else{
  ?>
  <div style="text-align: left;vertical-align: middle;">
    <i class="fa fa-times" style="font-size: 45px;color: red;font-weight: normal;margin-top: 10px"></i> &nbsp;&nbsp;&nbsp;&nbsp;
    <label style="font-size: 30px;color: red;">Transaction Failed</label>
  </div>
  <?php
}
?>
<label style="font-size: 20px"><?php echo $paytmParams['RESPMSG'] ?> Below are the payment details.</label>
<br/>
<br/>

<table>
  <tr>
    <th> Transaction Id </th>
    <td> <?php echo $paytmParams['TXNID'] ?> </td>
  </tr>
  <tr>
    <th> Transaction Amount </th>
    <td> <?php echo $paytmParams['TXNAMOUNT'] ?> </td>
  </tr>
  <tr>
    <th> Transaction DateTime </th>
    <td> <?php echo $paytmParams['TXNDATE'] ?> </td>
  </tr>
  <tr>
    <th> Gateway Name </th>
    <td> <?php echo $paytmParams['GATEWAYNAME'] ?> </td>
  </tr>
  <tr>
    <th> Bank Name </th>
    <td> <?php echo $paytmParams['BANKNAME'] ?> </td>
  </tr>
  <tr>
    <th> Bank Transaction Id </th>
    <td> <?php echo $paytmParams['BANKTXNID'] ?> </td>
  </tr>

</table>
<br><br>
<?php
if($paytmParams['RESPMSG']=="Txn Success"){
  ?>
  <form action="Recruiter_Home.php">
    <input type="submit" name="" class="btn btn-success" value="Go to Home Page">
  </form>
<?php } ?>
</div>
</div>
<?php
/**
* Verify checksum
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$isValidChecksum = verifychecksum_e($paytmParams, "%8@TQB7L!YdbkoI6", $paytmChecksum);
if($isValidChecksum == "TRUE") {
	//echo "Checksum Matched";
} else {
	echo "Checksum Mismatched";
}



require_once("Config.php");
$check=0;

$id=$paytmParams['ORDERID'];

$sql="update payment_info set MID='".$paytmParams['MID']."',
TXNID='".$paytmParams['TXNID']."',
TXNAMOUNT=".$paytmParams['TXNAMOUNT'].",
PAYMENTMODE='".$paytmParams['PAYMENTMODE']."',
TXNDATE='".$paytmParams['TXNDATE']."',
STATUS='".$paytmParams['STATUS']."',
RESPCODE='".$paytmParams['RESPCODE']."',
RESPMSG='".$paytmParams['RESPMSG']."',
GATEWAYNAME='".$paytmParams['GATEWAYNAME']."',
BANKNAME='".$paytmParams['BANKNAME']."',
BANKTXNID='".$paytmParams['BANKTXNID']."',
CHECKSUMHASH='".$paytmChecksum."'
where PAYMENTID=$id";

//echo $sql;

if(!$result = $conn->query($sql)){
 $check=1;
 die('There was an error running the query [' . $conn->error . ']');
}
else{
}










?>


<div id="footer"></div>

</body>

</html>
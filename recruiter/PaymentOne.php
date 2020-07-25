<?php
/**
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
require_once("config.php");
$check=0;
 
  $id=$_POST['recruiterid'];
  
  $sql="insert into payment_info (RECRUITERID,STATUS) values('".$id."','TRANSACTION_NOT_INITIATED')";

  if(!$result = $conn->query($sql)){
  	$check=1;
   die('There was an error running the query [' . $conn->error . ']');
 }
 else{
   $sql="select PAYMENTID from payment_info where RECRUITERID='".$id."' order by   PAYMENTID desc limit 1";
   if(!$result = $conn->query($sql)){
   	$check=1;
   	die('There was an error running the query [' . $conn->error . ']');
   }


   $row=$result->fetch_assoc();
   $PAYMENTID=$row['PAYMENTID'];
}

   




if($check==0){

require_once("lib/encdec_paytm.php");
/* initialize an array with request parameters */
$paytmParams = array(
    
	/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	"MID" => "AHqhTH80806012648874",
    
	/* Find your WEBSITE in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	"WEBSITE" => "WEBSTAGING",
    
	/* Find your INDUSTRY_TYPE_ID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	"INDUSTRY_TYPE_ID" => "Retail",
    
	/* WEB for website and WAP for Mobile-websites or App */
	"CHANNEL_ID" => "WEB",
    
	/* Enter your unique order id */
	"ORDER_ID" => $PAYMENTID,
    
	/* unique id that belongs to your customer */
	"CUST_ID" => $_POST['recruiterid'],
    
	/* customer's mobile number */
	"MOBILE_NO" => $_POST['mobno'],
    
	/* customer's email */
	"EMAIL" => $_POST['email'],
    
	/**
	* Amount in INR that is payble by customer
	* this should be numeric with optionally having two decimal points
	*/
	"TXN_AMOUNT" => $_POST['amount'],
    
	/* on completion of transaction, we will send you the response on this URL */
	"CALLBACK_URL" => "http://localhost/Quizzer/PaymentResponse.php",
);

/**
* Generate checksum for parameters we have
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = getChecksumFromArray($paytmParams, "%8@TQB7L!YdbkoI6");

/* for Staging */
$url = "https://securegw-stage.paytm.in/order/process";

/* for Production */
// $url = "https://securegw.paytm.in/order/process";

/* Prepare HTML Form and Submit to Paytm */
?>
<html>
	<head>
		<title>Merchant Checkout Page</title>
	</head>
	<body>
		<center><h1>Please do not refresh this page...</h1></center>
		<form method='post' action='<?php echo $url; ?>' name='paytm_form'>
				<?php
					foreach($paytmParams as $name => $value) {
						echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
					}
				?>
				<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checksum ?>">
		</form>
		<script type="text/javascript">
			document.paytm_form.submit();
		</script>
	</body>
</html>
<?php 
}
?>
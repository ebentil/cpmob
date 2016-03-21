<?php
session_start();
date_default_timezone_set("UTC");
include_once 'core/connection.php';
$con = mysqli_connect('136.243.72.73', 'nalo', 'AvH89oU1N', 'zoom');
$paymentClient = $_POST['paymentClient'];
$paymentClientN = $_POST['paymentClientN'];
$paymentType = $_POST['paymentType'];
$paymentAmount = $_POST['paymentAmount'];
$receivedBy = $_SESSION['agent'];


$result_verify = mysqli_query($con, "select mobile, ho_id, collector_id from clients where client_id = '$paymentClient'");
if (mysqli_num_rows($result_verify) > 0) {
	$fetchMsisdn = mysqli_fetch_assoc($result_verify);
	$clientMobile = $fetchMsisdn['mobile'];
	$ho_id = $fetchMsisdn['ho_id'];
	$collector_id = $fetchMsisdn['collector_id'];

	$clientPart = $paymentClientN[0] . $paymentClientN[1];
	$prefix = $clientPart;
	$transactionID = 'TR'.strtoupper(uniqid($prefix));
	$today = date('Y-m-d H:i:s');

	$msg = "Dear $paymentClientN, you have just made a $paymentType payment of $paymentAmount for Zoomlion service. 
Transaction ID: $transactionID
Date: $today";

	$message = urlencode($msg);
	$result_payment = mysqli_query($con, "insert into payments(ho_id,collector_id,transaction_id,client_id,name,type,amount,receivedby,receivedon)values('$ho_id','$collector_id','$transactionID','$paymentClient','$paymentClientN','$paymentType','$paymentAmount','$receivedBy','$today');");
	if ($result_payment) {
		// echo $filename = "http:api.nalosolutions.com/bulksms/?username=zoomlionmobile&password=zoomie&type=0&dlr=1&destination=$clientMobile&source=ZOOMLION&message=$message";
		// $filename = "http:api.nalosolutions.com/bulksms/?username=na1-debbie&password=nalosol&type=0&dlr=1&destination=$clientMobile&source=ZOOMLION&message=$message";
		$filename = "http://216.224.161.207/api/bulksms/?username=zoomlionmobile&password=zoomie&type=0&dlr=1&destination=$clientMobile&source=ZOOMLION&message=$message";
		file_get_contents($filename);
		echo "Operation Successful";
	} else {
		echo "Operation Unsucessful" . mysqli_error($con);
	}
} else {
	echo "Invalid ClientID";
}
?>
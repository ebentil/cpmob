<?php
header("Access-Control-Allow-Origin: *");

include_once 'core/connection.php';

$paystring = $_POST['paystring'];

$payArr = explode("***", $paystring);

$payArr = array_filter($payArr);

$success = 0;
$error = 0;

foreach ($payArr as $onepay) {
	// echo $onepay;
	$onepayArr = explode("|", $onepay);

	$paymentClient = $onepayArr[0];
	$paymentType = $onepayArr[1];
	$paymentAmount = $onepayArr[4];
	$receivedBy = $onepayArr[5];

	// echo $paymentClient.'--'.$paymentType.'--'.$paymentAmount.'--'.$receivedBy;

	/*$paymentClient = $_POST['paymentClient'];
	 $paymentClientN = $_POST['paymentClientN'];
	 $paymentType = $_POST['paymentType'];
	 $paymentAmount = $_POST['paymentAmount'];
	 $receivedBy = $_SESSION['agent'];*/

	$result_msisdn = mysqli_query($con, "select mobile, name from clients where clientid='$paymentClient' LIMIT 1;");
	if (mysqli_num_rows($result_msisdn) > 0) {
		
		$fetchMsisdn = mysqli_fetch_assoc($result_msisdn);
		$clientMobile = $fetchMsisdn['mobile'];
		$paymentClientN = $fetchMsisdn['name'];

		$clientPart = $paymentClientN[0] . $paymentClientN[1];
		$prefix = 'NAZL' . $clientPart;
		$transactionID = uniqid($prefix);

		$msg = "Dear $paymentClientN, you have just made a $paymentType payment of $paymentAmount for Zoomlion service. Your transaction ID is $transactionID";
		$message = urlencode($msg);


		$result_payment = mysqli_query($con, "insert into payments (client,name,type,amount,receivedby)values('$paymentClient','$paymentClientN','$paymentType','$paymentAmount','$receivedBy');");
		if ($result_payment) {
			$filename = "http://api.nalosolutions.com/bulksms/?username=zoomlionmobile&password=zoomie&type=0&dlr=1&destination=$clientMobile&source=ZOOMLION&message=$message";
			file_get_contents($filename);
			$success = $success + 1;
		} else {
			// echo "Operation Unsucessful" . mysqli_error($con);
			$error = $error + 1;
		}
	} else {
		echo "Invalid ClientID";
		$error = $error + 1;
	}
}
// echo "insert into payments (client,clientname,type,amount,receivedby)values('$paymentClient','$paymentClientN','$paymentType','$paymentAmount','$receivedBy');";
echo $success.'|'.$error;
?>
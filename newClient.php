<?php

header("Access-Control-Allow-Origin: *");
session_start();
include_once 'core/connection.php';

$clientName = $_POST['clientName'];
$clientGender = $_POST['clientGender'];
$clientMobile = $_POST['clientMobile'];
$clientHseNumber = $_POST['clientHseNumber'];
$clientService = $_POST['clientService'];
$clientBins = $_POST['clientBins'];
$clientAmount = $_POST['clientAmount'];
$clientLocation = $_POST['clientLocation'];
$clientCluster = $_POST['clientCluster'];
$clientId = $_POST['id'];
$createdBy = $_SESSION['agent'];

$msg = "Dear $clientName, You have been successfully registered for Zoomlion services. Your clientID is $clientId";
$message = urlencode($msg);

$result_verify = mysqli_query($con, "select * from clients where clientid='$clientId';");
if (mysqli_num_rows($result_verify) > 0) {

	$clientId = 'ZL' . rand(100, 100000);

	$result_newclient = mysqli_query($con, "insert into clients (name,gender,mobile,hsenumber,bins,amount,cluster,clientid,servicetype,location,createdby)values('$clientName','$clientGender','$clientMobile','$clientHseNumber','$clientBins','$clientAmount','$clientCluster','$clientId','$clientService','$clientLocation','$createdBy');");
	if ($result_newclient) {

		$filename = "http://api.nalosolutions.com/bulksms/?username=zoomlionmobile&password=zoomie&type=0&dlr=1&destination=$clientMobile&source=ZOOMLION&message=$message";
		echo file_get_contents($filename);

		echo TRUE;
	} else {
		echo FALSE;
	}

} else {

	$result_newclient = mysqli_query($con, "insert into clients (name,gender,mobile,hsenumber,bins,amount,cluster,clientid,servicetype,location,createdby)values('$clientName','$clientGender','$clientMobile','$clientHseNumber','$clientBins','$clientAmount','$clientCluster','$clientId','$clientService','$clientLocation','$createdBy');");
	if ($result_newclient) {

		$filename = "http://api.nalosolutions.com/bulksms/?username=zoomlionmobile&password=zoomie&type=0&dlr=1&destination=$clientMobile&source=ZOOMLION&message=$message";
		file_get_contents($filename);

		echo TRUE;
	} else {
		echo FALSE;
	}
}
mysqli_close($con);
?>
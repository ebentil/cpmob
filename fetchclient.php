<?php
header("Access-Control-Allow-Origin: *");
session_start();
require_once 'core/connection.php';
$clientid = $_POST['clientid'];

$execute = mysqli_query($con, "select * from clients where client_id like '$clientid%';");
if (mysqli_num_rows($execute) > 0) {
	$fetchUser=mysqli_fetch_assoc($execute);
	echo $fetchUser['name'];
} else {
	echo "Client not found";
}
?>

<?php
header("Access-Control-Allow-Origin: *");
session_start();
require_once 'core/connection.php';
$user = $_POST['username'];
$pass = $_POST['pass'];

$execute = mysqli_query($con, "select * from users where username='$user' and password='$pass' AND level = 'Collector'");
if ($userverify = mysqli_num_rows($execute) > 0) {
	$collector = mysqli_fetch_array($execute);
	$_SESSION['ho_id'] = $collector['ho_id'];
	$_SESSION['cid'] = $collector['level_id'];
	$_SESSION['did'] = $collector['district_id'];
	$_SESSION['agent'] = $user;
	echo "1";
} else {
	echo '0'; 
}
?>

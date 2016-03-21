<?php
require('core/connection.php');

$col = $_GET['col'];
$clientid = $_POST['pk'];
$value = $_POST['value'];

$update = mysqli_query($con,"UPDATE clients SET ".$col." = '$value' WHERE clientid='$clientid'");

if($update){
    echo 'true';
}
else{
    echo 'false';
}

mysqli_close($con);
?>
<?php

// require_once ('core/connection.php');
$con=mysqli_connect("78.46.254.50","nalo","nsd8dmd3bv0s","dlr");

$agent=$_POST['agent'];
// exit;

$query = "select * from readers ";
// $query = "select name from readers where readdate > DATE_SUB(CURDATE(),INTERVAL DAYOFWEEK(CURDATE())-2 DAY) ";
$result = mysqli_query($con, $query);

$data = "<ul data-role='listview' data-inset='true' data-filter='true' data-input='filterBasic-input'  id='reads'>";
if ($result) {
	while ($a = mysqli_fetch_assoc($result)) {
		$name = $a['name'];

		$data .= '<li>' . $name . '</li>';
	}
} else {
	echo "fail" . mysqli_error($con);
}

$data .= "</ul>";
echo $data;
?>
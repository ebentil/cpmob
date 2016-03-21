<?php
header("Access-Control-Allow-Origin: *");
include 'core/connection.php';

$agent = $_POST['agent'];

$result_fetch = mysqli_query($con, "SELECT * FROM clients where createdby='$agent' order by name ASC");
$data = "<ul data-role='listview' data-inset='true' data-filter='true' id='wrpPending' style='color:blue; cursor:pointer; width: 100%; height: 100%;' class='fetchedAllDetails'>";
while ($fetchClient = mysqli_fetch_array($result_fetch)) {
	 $client = $fetchClient['clientid'];
	
	 $data .= "<li value='" . $fetchClient['clientid'] . "' class='clientDetail'>
						<a> <font color='gray' size='3px'>Name:</font> " . $fetchClient['name'] . "<br/>
<font color='gray' size='3px'>ClientID: </font>" . $fetchClient['clientid'] . "<br/>
<font color='gray' size='3px'>Mobile Num: </font>" . $fetchClient['mobile'] . "</a>
</li>
<div class='fullClientDetail' id='" . $fetchClient['clientid'] . "'
 style='height:100%; overflow: auto;  display: none; color: black; background:skyblue; border: 1px solid gray; min-width: 100%;  position: fixed; top: 0%; left:0%; padding: 10px; z-index: 9999;'>
	<div class='closefulldetail' style='position: absolute; top: 0px; right: 20px; padding: 5px; background: pink; color: white; width: 15px; z-index: 99999;'>
		&cross;
	</div>
	<span color='gray' size='3px'><b>ClientID:</b> <span>" . $fetchClient['clientid'] . "</span></span>
		<br />
		<span color='gray' size='3px'><b>Name:</b> <span>" . $fetchClient['name'] . "</span></span>
			<br />
			<span color='gray' size='3px'><b>Mobile:</b> <span class='mobspan' data-type='text' data-emptytext='none' data-pk='" . $fetchClient['clientid'] . "'>" . $fetchClient['mobile'] . "</span></span>
<br />
<span color='gray' size='3px'><b>Address:</b> <span class='addspan' data-type='text' data-emptytext='none' data-pk='" . $fetchClient['clientid'] . "'>" . $fetchClient['hsenumber'] . "</span></span>
<br />
<span color='gray' size='3px'><b>Registered On:</b> <span>" . $fetchClient['createdon'] . "</span></span>
<br />
<span color='gray' size='3px'><b>Registered By:</b> <span>" . $fetchClient['createdby'] . "</span></span>
<br />
<div style='width: 100%; text-align: center;'>
<a href='#newPayment' style='text-decoration: none;'>
<button class='clientMakePayment' value='" . $fetchClient['clientid'] . "'>
Make Payment
</button> </a>
</div> <h3 style='width: 100%; text-align: center'>Last 5 Payments</h3> ";

	$result_payments = mysqli_query($con, "SELECT * FROM payments where client='$client' order by receivedon DESC LIMIT 5 ;");
	while ($fetchPayments = mysqli_fetch_array($result_payments)) {

		$data .= "<hr />
<font color='gray' size='3px'>Date:</font> " . $fetchPayments['receivedon'] . "
<br />
<font color='gray' size='3px'>Mode:</font> " . $fetchPayments['type'] . "
<br />
<font color='gray' size='3px'>Amount:</font> " . $fetchPayments['amount'] . "
<br />
<hr />";
	}
	$data .= "</div>";
}

$data .= "</ul>";

echo $data;
?>
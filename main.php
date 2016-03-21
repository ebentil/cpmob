<?php
session_start();
$agent = $_SESSION['agent'];
$cid = $_SESSION['cid'];
date_default_timezone_set('GMT');

include_once 'core/connection.php';

if (isset($_POST['payID'])) {
	$_SESSION['payID'] = $_POST['payID'];
}

// if (!isset($_SESSION['agentss'])) {
	// header("location:login.php");
// }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>RevenueCollector</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.4.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="_assets/css/jqm-demos.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
		<script src="js/jquery.js"></script>
		<script src="js/script.js"></script>
		<script src="_assets/js/index.js"></script>
		<script src="js/jquery.mobile-1.4.4.min.js"></script>

        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
        <script>
			$(document).ready(function() {
				//toggle `popup` / `inline` mode
				$.fn.editable.defaults.mode = 'inline';

				//make username editable
				$('.addspan').editable({
					url : 'editclient.php?col=hsenumber',
					success : function(response) {
						if (!response.success) {
							if (response == 'true') {
								alert('Address saved!');
							} else {
								alert('Error');
							}
						} else {
							alert('Error');
						}
					}
				});
				$('.mobspan').editable({
					url : 'editclient.php?col=mobile',
					success : function(response) {
						if (!response.success) {
							if (response == 'true') {
								alert('Mobile number saved!');
							} else {
								alert('Error');
							}
						} else {
							alert('Error');
						}
					}
				});
				//modify buttons style
				/*$.fn.editableform.buttons =
				'<button type="button" style="border-left: 1px solid skyblue; background: #3388cc; color:white; text-shadow: none;"><i class="fa fa-check" style="color:white"></i> OK</button>' +
				'<button type="button" style="border-left: 1px solid skyblue; background: #838383; color:white; text-shadow: none;"><i class="fa fa-close" style="color:white"></i> Cancel</button>';*/

				//                <button style="border-left: 1px solid background: #3388cc; color:white; text-shadow: none;"><i class="fa fa-user fa-3x"></i></button>

			});
        </script>
	</head>
	<body>

		<div data-role="page" id="pgWelcome">

			<div data-role="header" data-position='fixed' data-theme='a' >
				<!-- <a href="login.php" rel="external" data-transition='flow' class="ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a> -->
				<h1>C-PANEL</h1>
			</div><!-- /header -->

			<div data-role="content" class="ui-content">
				<div>
					<table border="0" cellspacing="30" cellpadding="5" width="100%" height="200px">
						<tr align="center">
							<td><a href="#newClient" data-transition='flip' style="font-weight: lighter;color: black; text-decoration: none;" ><i class="fa fa-user fa-3x"></i>
							<br/>
							new </a></td>
							<td><a href="#newPayment" data-transition='slidedown' style="font-weight: lighter;color: black; text-decoration: none;"><i class="fa fa-money fa-3x"></i>
							<br/>
							payment</a></td>
						</tr>
						<tr align="center">
							<td><a href="#searchClient" data-transition='turn' style="font-weight: lighter;color: black; text-decoration: none;"><i class="fa fa-search fa-3x"></i>
							<br/>
							search</a></td>
							<td><a href="login.php" rel="external" data-transition='flow' style="font-weight: lighter;color: black; text-decoration: none;"><i class="fa fa-sign-out fa-3x" style="color: pink"></i>
							<br/>
							signout</a></td>
						</tr>
						<!-- <tr align="center">
							<td><i class="fa fa-line-chart fa-4x"></i>
							<br/>
							Report</td>
							<td><i class="fa fa-wrench fa-4x"></i>
							<br/>
							Setting</td>
						</tr> -->
					</table>

				</div>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed" data-theme=''>
				<h1>ZoomLion</h1>
			</div>
			<!-- /footer -->
		</div><!-- /page -->

		<!-- Start of NEW CLIENT page I -->
		<div data-role="page" id="newClient">
			<!-- Header -->
			<div data-role="header" data-position='fixed' data-add-back-btn="true">
				<h1>NEW CIENT</h1>

			</div>
			<!-- /header -->
			<!-- Content    -->
			<div data-role="content">
				<div>
					<div id="display" class="display" style="padding: 10px;background:skyblue;color:white;text-align: center;text-shadow: none;
					font-weight:bolder;width:83%;position: fixed;bottom: 30%; left:0px;margin: 5%;z-index: 80px;display:none;border:1px solid gray;"></div>
					
					<label for="username" style="text-align: center">Client Name</label>
					<input type="text" name="clientName" value="" id="clientName" data-mini='true'  placeholder="Abraham Odoi Nii Laryea"/>
					
					<label for="password" style="text-align: center">Gender</label>
					<select name="clientGender" id="clientGender" data-mini='true' >
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>

					<label for="mobile" style="text-align: center">Mobile</label>
					<input type="text" name="mobile" value="" id="clientMobile" data-mini='true'  placeholder="233200000000"/>

					<label for="hseNumber" style="text-align: center">House Number</label>
					<input type="text" name="hseNumber" value="" id="clienthseNumber" data-mini='true'  placeholder="G234/6"/>

					<label for="serviceType" style="text-align: center">Service Type</label>
					<select name="clientServiceType" id="clientServiceType" data-mini='true' >
						<option value="HH">HH</option>
						<option value="Co">Co</option>
					</select>

					<label for="bins" style="text-align: center">Bins</label>
					<input type="number" name="bins" value="" id="clientBins" data-mini='true'  placeholder=""/>
					
					<label for="amount" style="text-align: center">Amount</label>
					<input type="number" name="amount" value="" id="clientAmount" data-mini='true'  placeholder=""/>
					
					<label for="mobile" style="text-align: center">Location</label>
					<input type="text" name="location" value="" id="clientLocation" data-mini='true'  placeholder="C11" maxlength="3"/>

					<label for="cluster" style="text-align: center">Cluster</label>
					<input type="number" name="cluster" value="" id="clientCluster" data-mini='true'  placeholder="01" maxlength="2"/>

					<label for="clientID" style="text-align: center">Client ID</label>
					<input type="text" name="clientID" style="text-align: center; color: red"  value="<?php echo 'ZL' . rand(100, 100000); ?>" id="clientID" disabled='disabled' />

					<button name="btnnewClient"  data-mini='true' onclick="newClient()" style="border-left: 1px solid skyblue; background: #3388cc; color:white; text-shadow: none;">
						PROCEED
					</button>
					<!-- </form> -->
				</div>
			</div>
			<!-- /content -->
			<!-- footer -->
			<div data-role="footer" data-position='fixed'>
				<h4>&copy; <?php echo date('Y'); ?> NALO</h4>
			</div>
			<!-- /footer -->
		</div>
		<!-- /page -->

		<!-- Start of PAYMENT page I -->
		<div data-role="page" id="newPayment">
			<!-- Header -->
			<div data-role="header" data-position='fixed' data-add-back-btn="true">
				<h1>PAYMENT</h1>
			</div>
			<!-- /header -->
			<!-- Content    -->
			<div data-role="content">
				<div>
					<div id="paydisplay" class="display" style="padding: 10px;background:skyblue;color:white;text-align: center;text-shadow: none;
					font-weight:bolder;width:83%;position: absolute;top: 45%; left:0px;margin: 5%;z-index: 80px;display:none;border:1px solid gray;"></div>
					<!-- <form action="" method="post"> -->
					<label for="paymentClient" style="text-align: center">Client ID</label>
					<input type="text" name="paymentClient" onkeyup="fetchuser()" value="" id="paymentClient"  placeholder="ZL0000000"/>
 
					<label for="mobile" style="text-align: center">Client Name</label>
					<input type="text" name="paymentClientN" value="" disabled='disabled'  id="paymentClientN" data-mini='true'  />

					<label for="paymentType" style="text-align: center">Type</label>
					<select name="paymentType" id="paymentType" data-mini='true' >
						<option value="Cash">Cash</option>
						<option value="Cheque">Cheque</option>
						<option value="Mobilemoney">Mobilemoney</option>
					</select>

					<input type="text" name="chequeNumber" value="" class="extrafield" placeholder="Cheque Number" id="chequeNumber" data-mini='true'  style="display: none;" />

					<input type="text" name="MobilemoneyNumber" class="extrafield" value="" placeholder="Mobilemoney Number" id="MobilemoneyNumber" data-mini='true'  style="display: none;" />

					<label for="paymentAmount" style="text-align: center">Amount GHs</label>
					<input type="text" name="paymentAmount" value="" id="paymentAmount" data-mini='true'  placeholder="100000"/>

					<label for="receivedOn" style="text-align: center">Received On</label>
					<input type="text" name="receivedOn" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled='disabled' id="receivedOn" data-mini='true'  />

					<label for="receivedBy" style="text-align: center">Received by</label>
					<input type="text" name="receivedBy" value="<?php echo $agent; ?>" disabled='disabled' id="receivedBy" data-mini='true'  />

					<button name="btnnewPayment" id="btnnewPayment"  data-mini='true' onclick="newPayment()" style="border-left: 1px solid skyblue; background: #3388cc; color:white; text-shadow: none;">
						PAY
					</button>
					<!-- </form> -->
				</div>
			</div>
			<!-- /content -->
			<!-- footer -->
			<div data-role="footer" data-position='fixed'>
				<h4>&copy; <?php echo date('Y'); ?> NALO</h4>
			</div>
			<!-- /footer -->
		</div>
		<!-- /page -->

		<!-- Start of SEARCH page I -->
		<div data-role="page" id="searchClient">
			<!-- Header -->
			<div data-role="header" data-position='fixed' data-add-back-btn="true">
				<h1>CLIENTS</h1>
			</div>
			<!-- /header -->
			<!-- Content    -->
			<div data-role="content">
				<div>
					<div id="searchdisplay" class="display" style="padding: 10px;background:skyblue;color:white;text-align: center;text-shadow: none;
					font-weight:bolder;width:83%;position: absolute;top: 45%; left:0px;margin: 5%;z-index: 80px;display:none;border:1px solid gray;"></div>

				</div>

				<div id="set" data-role="collapsible-set" data-content-theme="b">

					<div id="set1">
						<!-- <h3>ALL CLIENTS</h3> -->
						<p>
							<ul data-role='listview' data-inset='true' data-filter='true' id='wrpPending' style='color:blue; cursor:pointer; width: 100%; height: 100%;' class='fetchedAllDetails'>
								<?php
								$result_fetch = mysqli_query($con, "SELECT * FROM clients where collector_id='$cid' order by name ASC");
								while ($fetchClient = mysqli_fetch_array($result_fetch)) {
									$client=$fetchClient['client_id'];
								?>

								<li value="<?php echo $fetchClient['client_id']; ?>" class='clientDetail'>
									<a> <font color='gray' size='3px'>Name:</font> <?php echo $fetchClient['name']; ?>
									<br/>
									<font color='gray' size='3px'>ClientID: </font><?php echo $fetchClient['client_id']; ?>
									<br/>
									<font color='gray' size='3px'>Mobile Num: </font><?php echo $fetchClient['mobile']; ?></a>
								</li>
							<div class='fullClientDetail' id='<?php echo $fetchClient['client_id']; ?>' style='height:100%; overflow: auto;  display: none; color: black; background:skyblue; border: 1px solid gray; min-width: 100%;  position: fixed; top: 0%; left:0%; padding: 10px; z-index: 9999;'>
							<div class='closefulldetail' style="position: absolute; top: 0px; right: 20px; padding: 5px; background: pink; color: white; width: 15px; z-index: 99999;">&cross;</div>
                            <span color='gray' size='3px'><b>ClientID:</b>	<span><?php echo $fetchClient['client_id']; ?></span></span><br />
							<span color='gray' size='3px'><b>Name:</b>	<span><?php echo $fetchClient['name']; ?></span></span><br />
                            <span color='gray' size='3px'><b>Mobile:</b>	<span class="mobspan" data-type="text" data-emptytext="none" data-pk="<?php echo $fetchClient['clientid']; ?>"><?php echo $fetchClient['mobile']; ?></span></span><br />
                            <span color='gray' size='3px'><b>Address:</b>	<span class="addspan" data-type="text" data-emptytext="none" data-pk="<?php echo $fetchClient['clientid']; ?>"><?php echo $fetchClient['hsenumber']; ?> </span></span><br />
							<span color='gray' size='3px'><b>Registered On:</b> 	<span><?php echo $fetchClient['createdon']; ?></span></span><br />
							<span color='gray' size='3px'><b>Registered By:</b>	<span><?php echo $fetchClient['createdby']; ?></span></span><br />
							<div style="width: 100%; text-align: center;">
								<a href="#newPayment" style="text-decoration: none;">
							<button class='clientMakePayment' value="<?php echo $fetchClient['client_id']; ?>">Make Payment</button>
							</a>
							</div>
							<h3 style="width: 100%; text-align: center">Last 5 Payments</h3> 
							<?php
							$result_payments = mysqli_query($con, "SELECT * FROM payments where client='$client' order by receivedon DESC LIMIT 5 ;");
								while ($fetchPayments = mysqli_fetch_array($result_payments)) {
							?>
							<hr />
							<font color='gray' size='3px'>Date:</font>	<?php echo $fetchPayments['receivedon']; ?><br />
							<font color='gray' size='3px'>Mode:</font>	<?php echo $fetchPayments['type']; ?><br />
							<font color='gray' size='3px'>Amount:</font>	<?php echo $fetchPayments['amount']; ?><br />
							<hr />
							<?php } ?>
							</div>
							<?php } ?>
							
							</ul>
						</p>
					</div>
				</div>

			</div>
			<!-- /content -->
			<!-- footer -->
			<div data-role="footer" data-position='fixed'>
				<h4>&copy; <?php echo date('Y'); ?> NALO</h4>
			</div>
			<!-- /footer -->
		</div>
		<!-- /page -->

	</body>
	<script>
		//Login Attempt
		function newClient() {
			$("#display").html('Processing...');
			$("#display").show();
			var name = $('#clientName').val();
			var gender = $('#clientGender').val();
			var mobile = $('#clientMobile').val();
			var hseNumber = $('#clienthseNumber').val();
			var service = $('#clientServiceType').val();
			var bins = $('#clientBins').val();
			var amount = $('#clientAmount').val();
			var location = $('#clientLocation').val();
			var cluster = $('#clientCluster').val();
			var id = $('#clientID').val();

			if (name == '' || gender == '' || mobile == '' || hseNumber == '' || service == '' || bins == '' || amount == '' || location == '' || cluster == '') {
				$("#display").html('All fields required');
				$("#display").css('color', 'red');
				$("#display").fadeOut(8000);
			} else {
				$.post("newClient.php", {
					clientName : name,
					clientGender : gender,
					clientMobile : mobile,
					clientHseNumber : hseNumber,
					clientService : service,
					clientBins : bins,
					clientAmount : amount,
					clientLocation : location,
					clientCluster : cluster,
					id : id
				}, function(data) {

					// if (data == '1') {
					$("#display").html('Client Added Successfully');

					$('#clientName').val('');
					$('#clientGender').val('');
					$('#clientMobile').val('');
					$('#clientLocation').val('');
					$('#clienthseNumber').val('');
					$('#clientBins').val('');
					$('#clientAmount').val('');
					$('#clientCluster').val('');

					$("#display").fadeIn();
					$("#display").fadeOut(4000, function() {
						window.location = 'main.php';
					});

					//
					// $.get("allClient.php", function(data) {
					// $('.fetchedAllDetails').html(data);
					//
					// });
					// } else {
					// $("#display").html('Operation Unsuccessful. Try again' + data);
					// $("#display").css('color', 'red');
					// $("#display").fadeIn();
					// $("#display").fadeOut(9000);
					//
					// };
				});
			}
		}

	</script>
	<script>
		function fetchuser() {
			var clientid = $('#paymentClient').val();
			$.post("fetchclient.php", {
				clientid : clientid,
			}, function(data) {
				$('#paymentClientN').val(data);
			});
		}

	</script>
	<script>
		function newPayment() {
			$("#paydisplay").html('Processing...');
			$("#paydisplay").show();
			var paymentClient = $('#paymentClient').val();
			var paymentClientN = $('#paymentClientN').val();
			var paymentType = $('#paymentType').val();
			var paymentAmount = $('#paymentAmount').val();

			if (paymentClient == '' || paymentType == '' || paymentAmount == '') {
				$("#paydisplay").html('All fields required');
				$("#paydisplay").css('color', 'red');
				$("#paydisplay").fadeOut(8000);
			} else {

				$.post("newPayment.php", {
					paymentClient : paymentClient,
					paymentClientN : paymentClientN,
					paymentType : paymentType,
					paymentAmount : paymentAmount
				}, function(data) {
					$("#paydisplay").html(data);

					// $('#paymentClient').val('');
					// $('#paymentClientN').val('');
					$('#paymentAmount').val('');

					$("#paydisplay").fadeOut(9000);

					// if (data == '1') {
					// $("#paydisplay").html('Payment Recorded Successfully');
					//
					// $('#paymentClient').val('');
					// $('#paymentClientN').val('');
					// $('#paymentAmount').val('');
					//
					// $("#paydisplay").fadeOut(9000);
					//
					// } else {
					// alert(data);
					// $("#paydisplay").html('Operation Unsuccessful. Try again' + data);
					// $("#paydisplay").css('color', 'red');
					// $("#paydisplay").fadeIn();
					// $("#paydisplay").fadeOut(9000);
					//
					// };
				});
			}
		}

	</script>
	<script>
		$(".clientDetail").click(function() {
			var clientid = $(this).attr('value');
			$("#" + clientid).show();
			// alert(clientid);
		})
	</script>
	<script>
		$(".closefulldetail").click(function() {
			// alert('yes');
			$(".fullClientDetail").hide();

		});
	</script>
		<script>
			$("#paymentType").change(function() {
				$(".extrafield").hide();

				if ($("#paymentType").val() == 'Cheque') {
					$("#chequeNumber").show();
				} else if ($("#paymentType").val() == 'MobileMoney') {
					$("#MobilemoneyNumber").show();
				}
				;
			});
		</script>
		
		<script>
			$(".clientMakePayment").click(function() {
				paID = $(this).val();
				$("#paymentClient").val(paID);
				$.post("fetchclient.php", {
					clientid : paID,
				}, function(data) {
					$('#paymentClientN').val(data);
				});
			});
		</script>

    <script>
		function editval(mob, add) {
			alert(mob);
			alert(add);
		}
    </script>

    <script>
		$(".editClientDetails").click(function() {
			var mobvals = $('#mobspan').html();
			var addvals = $('#addspan').html();

			/*alert(mobvals);
			alert(addvals);*/
			/* $("#mobspan").html("<input id='mobinp' style='margin-left:5px;' value='"+mobvals+"'>");
			$("#addspan").html("<input id='addinp' value='"+mobvals+"'>");*/

			//            $(this).html('Save');

			/*paID = $(this).val();
			 $("#paymentClient").val(paID);
			 $.post("fetchclient.php", {
			 clientid : paID,
			 }, function(data) {
			 $('#paymentClientN').val(data);
			 });*/
		});
    </script>
	
</html>

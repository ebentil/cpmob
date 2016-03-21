<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/cordova.js"></script>
	</head>
	<body style="font-family:Arial; background: blue;">

		<div data-role="page" id="pgWelcome">

			<div data-role="header" data-position='fixed' data-theme='b' data-add-back-btn="true" style="background: blue; border: none;">
				<h1>LOGIN</h1>
			</div><!-- /header -->

			<div role="main" class="ui-content">
				<div>
					<form action="" method="post">
						<label for="username" style="text-align: center">Username</label>
						<input type="text" name="username" value="" id="txtusername"/>
						<label for="password" style="text-align: center">Password</label>
						<input type="password" name="password" value="" id="txtpassword"/>
						<input type="submit" name="btnlogin" style="border-left: 1px solid skyblue; background: #3388cc; text-shadow: none;" value="Login"/>
					</form>
				</div>
				<div style="text-align: center;" id="alertDisplay"></div>

			</div><!-- /content -->

			<div data-role="footer" data-position="fixed" data-theme='' style="background: blue; border: none; color: white;">
				<h1>ZoomLion</h1>
			</div>
			<!-- /footer -->
		</div><!-- /page -->

	</body>
</html>
<script>
	document.addEventListener("deviceready", onDeviceReady, false);

	function onDeviceReady() {
		document.addEventListener("pause", onPause, false);
		document.addEventListener("resume", onResume, false);
		alert("Device is Ready");

	}

	//What to do when paused
	function onPause() {

		alert("paused!");
	}

	//What to do when resumed
	function onResume() {

		alert("resume");
	}
</script>
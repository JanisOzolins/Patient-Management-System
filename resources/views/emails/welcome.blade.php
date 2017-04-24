<!DOCTYPE html>
<html>
<head>
	<title>Patient Management System - Your Registration Confirmation</title>
	
</head>
<body>
	<div style="background: #ededf1; padding: 35px;">
		<div style="background: white;  padding: 0px 35px 15px; max-width: 600px; width: calc(100% - 70px); margin: 0 auto;">
			<center>
				<h1 style="padding-top: 25px; padding-bottom: 0; margin: 0; font-style: normal; font-weight: bold; color: #000000; font-size: 22px; line-height: 31px; font-family: sans-serif; text-align: center;">Registration Confirmation</h1>
				<p style="padding: 0 5px; margin: 15px 0 20px; text-align: center; font-weight: bold; color: #3f51b5; font-size: 25px; line-height: 100%; text-transform: uppercase; font-family: sans-serif;">{{ $user->first_name }} {{ $user->last_name }}</p>
				<div class="divider" style="display: block; font-size: 2px; line-height: 2px; margin-left: auto; margin-right: auto; width: 80%; background-color: #b4b4c4; margin: 30px auto;">&nbsp;</div>
			</center>

				<p style="padding: 0 5px; margin-top: 16px; margin-bottom: 25px; text-align: center; color: #7c7e7f; font-size: 14px; line-height: 21px; font-family: sans-serif;">Your profile was successfully created. Please use the credentials listed below to login to the system.</p>

				<center>
				<h2 style="padding: 0 5px; margin-top: 0; margin-bottom: 0; font-style: normal; font-weight: bold; color: #000000; font-size: 15px; line-height: 23px; font-family: sans-serif;">User ID: </h2>

					<p style="padding: 0; color: #7c7e7f; font-size: 14px; line-height: 21px; font-family: sans-serif;">{{ $user->id }}</p>

					<h2 style="padding: 0 5px; margin-top: 0; margin-bottom: 0; font-style: normal; font-weight: bold; color: #000000; font-size: 15px; line-height: 23px; font-family: sans-serif;">Password:</h2>

					<p style="padding: 0; color: #7c7e7f; font-size: 14px; line-height: 21px; font-family: sans-serif;">{{ $temp_password }}</p>

					<a href="{{ URL::to('/login/') }}" style="display: inline-block; padding: 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; background-image: none; border-radius: 20px; color: #fff; background-color: #3F51B5; border: none; display: block; width: 80%; margin: 30px !important; text-decoration: none;">CLICK HERE TO LOGIN</a>

					<p style="padding: 0; margin-top: 16px; margin-bottom: 16px; font-weight: bold; color: #000000; font-size: 12px; line-height: 150%; font-family: sans-serif;">After logging in to the system, please change the aforementioned password immediately. You can do that by clicking "Edit Profile" link on the left hand side of the screen.</p>
				</center>

				</div>
			</div>
</body>
</html>
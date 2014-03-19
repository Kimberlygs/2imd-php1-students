<?php 
	if (isset($_POST['register']) && !empty($_POST['register'])) 
	{
		include_once('classes/User.class.php');
		$user = new User();
		$user->Firstname = $_POST['firstname'];
		$user->Lastname = $_POST['lastname'];
		$user->Email = $_POST['email'];
		$user->Password = $_POST['password'];

		if(isset($user->errors) && !empty($user->errors))
		{
			if (isset($user->errors['errorFirstname'])) 
			{ $er_Firstname = $user->errors['errorFirstname']; }

			if (isset($user->errors['errorLastname'])) 
			{ $er_Lastname = $user->errors['errorLastname']; }

			if (isset($user->errors['errorPassword'])) 
			{ $er_Password = $user->errors['errorPassword']; }

			if (isset($user->errors['errorEmail'])) 
			{ $er_Email = $user->errors['errorEmail']; }

		}
		else
		{
			$user->Save();
			if (isset($user->errors['errorAvailability'])) 
			{ 
				$er_Availability = $user->errors['errorAvailability'];
			}
			else
			{
				session_start();
				$_SESSION['email'] = $user->Email;
				header("location: index.php");
			}
		}
	}

 ?><!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>

		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/style.css">

		<link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
	</head>

	
	<body>
		<section id="logInCon" class="register">
			<section id="formCon">
				<a id="cancelHandler" href="index.php">x</a>
					<form id="register" action="" method="post">
							<?php if (isset($er_Firstname)) { echo "<span>" . $er_Firstname . "</span>";} ?>
						<input type="text" name="firstname" placeholder="First name">
							<?php if (isset($er_Lastname)) { echo "<span>" . $er_Lastname . "</span>";} ?>
						<input type="text" name="lastname" placeholder="Last name">
							<?php if (isset($er_Email)) { echo "<span>" . $er_Email . "</span>";} 
							 	  if (isset($er_Availability)) { echo "<span>" . $er_Availability . "</span>";} ?>
						<input type="text" name="email" placeholder="Email">
							<?php if (isset($er_Password)) { echo "<span>" . $er_Password . "</span>";} ?>
						<input type="text" name="password" placeholder="Password">

						<input type="submit" name="register" value="Register">
					</form>
					
			</section>
		</section>
	</body>
</html>
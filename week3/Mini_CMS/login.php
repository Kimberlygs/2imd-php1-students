<?php 
	if (isset($_POST['logIn']) && !empty($_POST['logIn'])) 
	{
		include_once('classes/User.class.php');

		$user = new User();
		$user->Email = $_POST['email'];
		$user->Password = $_POST['password'];
		$canLogIn = $user->Login();
		

		if($canLogIn == true)
		{
			session_start();
			$_SESSION['email'] = $user->Email;
			header("location: index.php");
		}
		else
		{
			$invalidLogin =  "<span>Email and/or password are incorrect</span>";
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
		<section id="logInCon">
			<section id="formCon">
				<a id="cancelHandler" href="index.php">x</a>
				<form action="" method="post">
					<h1>Log in to tell your story!</h1>
					<?php if(isset($invalidLogin)){echo $invalidLogin;} ?>
					<input type="text" name="email" placeholder="Email">
					<input type="text" name="password" placeholder="Password">

					<a href="register.php">Don't have an account?</a>
					<input type="submit" name="logIn" value="Log in">
				</form>
			</section>
		</section>
	</body>
</html>
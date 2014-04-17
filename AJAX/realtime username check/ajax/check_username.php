<?php
	include('../classes/User.class.php');

	$u = new User();
	if(!empty($_POST['user']))
	{
			
		$u->Username = $_POST['user'];
		$available = $u->UsernameAvailable();

		if($available === false)
		{
			echo 'false';
		}
		else
		{
			echo 'true';
		}
		
	}
?>
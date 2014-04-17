<?php 
	include('classes/User.class.php');

	if(isset($_POST['submit']) && empty($_POST['username']))
	{
		$feedback = 'Je moet een username invullen!';
	}

	if(!empty($_POST['username']))
	{
	
		$user = new User();
		$user->Username = $_POST['username'];

		$available = $user->usernameAvailable();
		if($available == true)
		{

			$user->Create(); //INSERT USER INTO TABLE
			
			if(isset($user->errors) && !empty($user->errors))
			{
				if(isset($user->errors['errorCreate']))
				{
					$error = $user->errors['errorCreate'];
				}
			}
			else
			{
				$feedback = $user->feedbacks['Signedup'];
			}
		}
		else
		{
			if(isset($user->errors) && !empty($user->errors))
			{
				if(isset($user->errors['errorAvailable']))
				{
					$error = $user->errors['errorAvailable'];
				}
			}
		}
		
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/reset.css" media="screen" />
<title>Signup checks</title>
<style type="text/css">
body
{
	font-family: Georgia;
}

label
{
	font-size: 1.4em;
}

input.text
{
	font-size: 1.4em;
}

#signupZone
{
	height: 40px;	
}

div.usernameFeedback
{
	display: none;
	position: relative;
	top: -38px;
	left: 260px;
	width: 250px;
	height: 20px;
	line-height: 20px;
	padding: 5px;
}

#available
{
	background-color: #9ef3e3;
	font-size: 0.8em;
	color: #16af93;
	padding: 5px;
}

#notavailable
{
	color: #96330b;
	background-color: #facab7;
	font-size: 0.8em;
	padding: 5px;
}
}

img.loadingImage
{
	display:none;
}

input.submit
{
	font-size: 1em;
	margin: 15px 0;
	text-transform: uppercase;
	color: #dafaf5;
	background-color: #16af93;
	border:solid 1.5px #0e7360;
	border-radius: 2px;
}

div.signupForm
{
	width: 460px;
	padding: 20px;
	margin: 25px auto;
}

div.feedback
{
	width: 440px;
	margin: 25px auto;
	background-color: #cee2ff;
	padding: 10px;
	text-align: center;
	-moz-border-radius: 4px;
	border: 1px solid #638ac4;
	color: #638ac4;
	text-shadow: 1px 1px 1px #fff;
}

div.error
{
	width: 440px;
	margin: 25px auto;
	background-color: #facab7;
	padding: 10px;
	text-align: center;
	-moz-border-radius: 4px;
	border: 1px solid #a7380c;
	color: #96330b;
	text-shadow: 1px 1px 1px #fff;
}
</style>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	console.log('ready');
	$("#username").on("blur", function(e){
				//var clickedLink = $(this);
				console.log('BLURED');
				var user = $("#username").val();
				console.log(user);
				$(".usernameFeedback").css("display","block");
				$.ajax({
				  type: "POST",
				  url: "ajax/check_username.php",
				  data: { user: user }
				})
				  .done(function(result) {
				    console.log(result);
				    if(result == 'true')
				    {
				    	$(".usernameFeedback").html("<p id='available'>Yup :), username is available!</p>");
				    }
				    else
				    {
				    	$(".usernameFeedback").html("<p id='notavailable'>:( sorry, username is already taken!</p>");
				    }
				  });

				e.preventDefault();
			});

	$("#username").on("focus", function(e){
		$(".feedback").css("display","none");
		$(".error").css("display","none");
	});
});
</script>
</head>
<body>
<?php if (isset($feedback)): ?>
<div class="feedback">
	<?php echo $feedback; ?>
</div>
<?php endif;?>

<?php if (isset($error)): ?>
<div class = 'error'>
	<?php echo $error; ?>
</div>
<?php endif; ?>	

<div>

	<div class="signupForm">
		<form action="" method="post">
		<div>
			<label for="username">Username</label>
			
			<div id="signupZone">
				<input class="text" type="text" id="username" name="username" />
				<div class="usernameFeedback"><img id="loadingImage" src="images/loading.gif" /><span>checking</span></div>
			</div>
			
			<br />
			
			<input class="submit" type="submit" value="Create my account" name="submit"/>
		</div>
		</form>
	</div>

</div>
</body>
</html>
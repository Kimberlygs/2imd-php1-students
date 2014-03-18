<?php 
	session_start();

	if (!isset($_SESSION['email']) && empty($_SESSION['email']))
	{
		header("location: login.php");
	}

	$date=time();
	$convertedDayWord = gmdate('l', $date);
	$convertedDayNumb = gmdate('d', $date);
	$convertedMonth = gmdate('F', $date);

	if(isset($_POST['submitPost']) && !empty($_POST['submitPost']))
	{
		include_once("classes/Story.class.php");
		$story = new Story();

		$story->Title = $_POST['title'];
		$story->Body = $_POST['body'];
		$story->DayWord = $_POST['dayWord'];
		$story->DayNumb = $_POST['dayNumb'];
		$story->Month = $_POST['dayMonth'];
		if(isset($story->errors) && !empty($story->errors))
		{
			if (isset($story->errors['errorTitleEmpty'])) 
			{ $er_TitleEmpty = $story->errors['errorTitleEmpty']; }

			if (isset($story->errors['errorTitleLength'])) 
			{ $er_TitleLength = $story->errors['errorTitleLength']; }

			if (isset($story->errors['errorBody'])) 
			{ $er_Body = $story->errors['errorBody']; }
		}
		else
		{
			$story->Save();
			header("location: index.php");
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
		<section id="createCon">
			<section id="formCon">
				<a id="cancelHandler" href="index.php">x</a>
				 <form action="" method="post">
				 		<?php if(isset($er_TitleEmpty)){ echo "<span>" . $er_TitleEmpty . "</span>";} 
				 			  if(isset($er_TitleLength)){ echo "<span>" . $er_TitleLength . "</span>";} 
				 		?>
				 	<input type="text" placeholder="Title" name="title">
						<?php if(isset($er_Body)){ echo "<span>" . $er_Body . "</span>";} ?>
				 	<textarea placeholder="What's your story?" name="body"></textarea>
				 	<input type="hidden" name="dayWord" value="<?php echo $convertedDayWord; ?>">
				 	<input type="hidden" name="dayNumb" value="<?php echo $convertedDayNumb; ?>">
				 	<input type="hidden" name="dayMonth" value="<?php echo $convertedMonth; ?>">
				 	<input type="submit" name="submitPost" value="Create Story">
				 </form>
			</section>
		</section>
	</body>
</html>
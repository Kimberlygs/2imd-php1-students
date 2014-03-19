<?php 
	session_start();

	if (isset($_SESSION['email']) && !empty($_SESSION['email']))
	{
		$loggedIn =  $_SESSION['email'];
	}
	include_once("classes/Story.class.php");
	
	$story = new Story();
	$stories = $story->ShowStories();

	$storyId = $_GET['id'];
	$arrayNumb = intval($storyId);
	
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
		<nav>
			<a id="logo" href="index.php">Tell your story</a>
				<div id="actionHandlers">
					<?php if(!isset($loggedIn) && empty($loggedIn)){echo "<a class='callAction' href='login.php'>Log In</a>";} else{ echo "<a class='callAction' href='logout.php'>Log Out</a>";}?>
					 <a class="callActionCreate" href="createstory.php">Create a story</a>
				</div>
		</nav>
		
		<main>
			<article id="storySec">
				<div class="titleSec">
				 	<h2> <?php echo htmlspecialchars($stories[$arrayNumb]['title']); ?> </h2>
					<h1> <?php echo htmlspecialchars($stories[$arrayNumb]['dayNumb']) . " " . htmlspecialchars($stories[$arrayNumb]['dayWord']) . " " . htmlspecialchars($stories[$arrayNumb]['month']); ?></h1>
				</div>

				<p> <?php echo htmlspecialchars($stories[$arrayNumb]['body']); ?></p>
			</article>

			<a id="backToStories" href="index.php">Read More Stories</a>
		</main>

	</body>
</html>
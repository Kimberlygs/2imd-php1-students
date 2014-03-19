<?php 
	session_start();

	if (isset($_SESSION['email']) && !empty($_SESSION['email']))
	{
		$loggedIn =  $_SESSION['email'];
	}
	include_once("classes/Story.class.php");
	
	$story = new Story();
	$stories = $story->getStories();
	$storyList = array(); 

	//var_dump($story->getStories());

	if ($numb_stories = $stories)
	{
		while($row = $numb_stories->fetch_array(MYSQLI_ASSOC))
		{
			$story_item = array();
			$story_item["id"] = htmlspecialchars($row["story_id"]);
			$story_item["title"] = htmlspecialchars($row["story_title"]);
			$story_item["body"] = htmlspecialchars($row["story_post"]);
			$story_item["dayNumb"] = htmlspecialchars($row["story_dayNumb"]);
			$story_item["dayWord"] = htmlspecialchars($row["story_dayWord"]);
			$story_item["month"] = htmlspecialchars($row["story_month"]);

			array_push($storyList,$story_item);
		}
	}

	usort($storyList, function($a, $b) 
	{
	   	return $b['id'] - $a['id'];
	});

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
			<ul>
			<?php
			if(isset($stories) && !empty($stories)){
				foreach ($storyList as $key => $story) { ?>
				<li class="storySec">	
					<div class="titleSec">
			 			<a href='story.php?id= <?php echo $key;?>'><?php echo $story['title'];?> </a>
			 			<h1> <?php echo htmlspecialchars($story['dayNumb']) . " " . htmlspecialchars($story['dayWord']) . " " . htmlspecialchars($story['month']);?></h1>
			 		</div>

			 		<?php if(strlen($story['body']) > 100) { 
			 			$story['body'] = substr($story['body'],0,500) . "...";?>

			 			<p> <?php echo htmlspecialchars($story['body']); ?> </p> 

					<?php	}

				 		else { ?>

				 			<p> <?php echo htmlspecialchars($story['body']);?> </p>
			
					   <?php	} ?>
				</li>
			 <?php	}
			}
			else{ ?>
				<span>No stories yet :(</span>
			<?php	}	?>
			</ul>
		</main>
</html>
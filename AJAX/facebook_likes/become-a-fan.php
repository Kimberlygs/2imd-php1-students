<?php
	
	include_once("classes/Activity.class.php");
	$a = new Activity();
	$allActivities = $a->GetRecentActivities();

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Become a fan</title>
	<style>
	body{background-color: #e9eaed;font-family: Helvetica, Arial, 'lucida grande',tahoma,verdana,arial,sans-serif;}
	container{height:auto; width:300px; margin-left:auto; margin-right:auto;}
	article{background-color: #fff;font-size: 15px; padding: 0.5em;width: 300px; margin-bottom: 1em; margin-left:auto; margin-right:auto;}
	img {width:300px; height:200px;}
	article div{color: #3b5998;}
	</style>
</head>
<body>

	<?php foreach($allActivities as $activity){ ?>
	<article>
	<h1>We are IMD</h1>
		<p>
	The Coding Olympics are back, with a vengeance! Wie is er klaar om te heersen op deze zomereditie? 

	Donderdag 15 mei in The Creativity Gym - meer info binnenkort!</p>
		<img src="images/picture.jpg" alt="">
		<div><a href="#" data-id="<?php echo $activity['pk_activity_id'] ?>" class="like">Like</a> <span class='likes'><?php echo $activity['likes'] ?></span> people like this </div>
	</article>
	<?php } ?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".like").on("click", function(e){
				//alert('clicked!');
				var currentlink = $(this);
				var postid =  currentlink.data("id");

				//AJAX CALL
				$.ajax({
 					 type: "POST",
 					 url: "ajax/facebook-fan.php",
 					 data: { id: postid}, 
 					 dataType:"json"
 					
					  })
  					.done(function( msg ) {
   					 if(msg.status =="success")
   					 {

   					 	currentlink.next("span.likes").first().text(msg.likes);
   					 }
  					});
  					e.preventDefault();
			});
		});

</script>
</body>
</html>
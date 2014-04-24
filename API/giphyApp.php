<?php
	if (!empty($_POST)) {
		$yourFeeling = $_POST['feeling'];
	
	
	$url = "http://api.giphy.com/v1/gifs/search?q=" .$yourFeeling. "&api_key=dc6zaTOxFJmzC";
	
	// CURL => bezorgt de json
	$request = curl_init(); // start de curl op
	// opties meegeven aan curl vs. get/post
	curl_setopt($request,CURLOPT_RETURNTRANSFER,1); // return json in plaats van printen
	curl_setopt($request,CURLOPT_URL, $url);
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER,false); // skip https auth

	// curl uitvoeren

	$Giphy = json_decode(curl_exec($request));



	}

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>How do you feel ? </title>
</head>
<style type="text/css">
	body{
		background-color: #F3F0E9;
	}
	
	h1,input {

		text-align: center;
		color: #9599F0;
	}
	input{
		margin-left: auto;
		margin-right: auto;
		width: 600px;
		height:50px;
		background-color: white;
		margin-bottom: 20px;
		color: #9599F0;
		font-size: 20px;
		font-weight: bold;
	}
	#wrapper{

		height: 500px;
		width: 600px;
		margin-left: auto;
		margin-right: auto;

	}
	img{
	text-align: center;
		border: 2px solid black;
	}




</style>
<body>
	<div id="wrapper">
	<h1>i'm feeling ...</h1>

	<form method="post" action="">
		<input type="text" id="feeling" name="feeling">	

	</form>
	
	
	<?php
	

	if(!empty($_POST))
	{
		foreach ($Giphy->data as $gip)
		{
		
			echo "<img src='" . $gip->images->original->url . "' alt='" .$yourFeeling ."' >";
			die();
			/*echo "<pre>";
			print_r($gip);
			echo "</pre>";*/
			
		}
		
	}
	?>
	</div>

</body>
</html>
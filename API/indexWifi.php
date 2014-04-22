<?php
	if(!empty($_POST)){
		$postalcode = $_POST['postcode'];
		$url = "http://datasets.antwerpen.be/v1/geografie/wifiopenbaar.json";

	   	//initialiseer curl
	   	$curl = curl_init();

	   	//curl options
	   	curl_setopt($curl, CURLOPT_URL, $url);
	   	curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
	   	curl_setopt($curl,  CURLOPT_SSL_VERIFYPEER, false);

	   	//execute
	   	$wifis = json_decode(curl_exec($curl)); //van json naar iets omzetten dat we in php kunnen gebruiken

	   	// //een klein truckske om uit te lijnen
	   	// echo "<pre>";
	   	// print_r($wifis);
	   	// echo "</pre>";
	}
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>OPENBAAR WIFI</title>
	<link rel="stylesheet" href="css/reset.css">
	<style type="text/css">

		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-size: 1.6rem;
			border-top: 15px solid #201E1C;
			background-color: #48A3A6;
			color: #fff;
		}

		h1 {
			font-size: 2.5rem;
		}

		p {
			font-size: 1.4rem;
		}

		form {
			margin-top: 25px;
			margin-bottom: 25px;
			width: 100%;
			text-align: center;
		}

		.wrapper {
			padding: 0 15px;
		}

		input{
			display: block;
			width: 100%;
			margin: 0 auto;
			margin-top: 10px;
			padding: 15px;
			border-radius: 10px;
			border: none;
			text-align: center;
		}

		input[type="submit"]{
			border: 2px solid #201E1C;
			color: #201E1C;
			background-color: #48A3A6;
			font-weight: bold;
			width: 50%;
		}

		input[type="submit"]:hover{
			color: #48A3A6;
			background-color: #201E1C;
			font-weight: bold;
			cursor: pointer;
		}

		.object{
			margin-bottom: 15px;
			border-radius: 5px;
			border: 1px solid #201E1C;
			padding: 15px;
			width: 100%;
			text-align: center;
		}

		@media(min-width: 960px){
			.wrapper{
				width: 960px;
				margin: 0 auto;
			}

			.object {
				width: 768px;
				margin: 0 auto;
				margin-bottom: 15px;
			}
		}
	</style>
</head>
<body>
	<header>
		<div class="wrapper">
			<form action="" method="post">
				<label for="postcode"><h1>POSTCODE</h1></label>
				<input type="text" name="postcode">
				<input type="submit" value="ZOEK WIFI">
			</form>
		</div>
	</header>

	<section id="content">
		<div class="wrapper">
		<?php
			if(!empty($_POST)){
				foreach ($wifis->wifiopenbaar as $wifi) {

					if ($wifi->postcode == $postalcode) {
						echo "<div class='object'>";
						echo "<p>Locatie: " . $wifi->locatie . "</p>";
						echo "<p>Gratis wifi: " . $wifi->stad_gratis_wifi . "</p>";
						echo "</div>";
					}
				}
			}
			?>
		</div>
	</section>
</body>
</html>
<?php
	$clientID = "0b55c6ce80f248c6a51f63fc4029efc0";

   $url = "https://api.instagram.com/v1/tags/weareimd/media/recent?client_id=" . $clientID;

   //initialiseer curl
   $curl = curl_init();

   //curl options url
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl,  CURLOPT_SSL_VERIFYPEER, false);

  	//execute
  	$instagram = json_decode(curl_exec($curl)); //van json naar iets omzetten dat we in php kunnen gebruiken

  	//een klein truckske om uit te lijnen
  	// echo "<pre>";
  	// print_r($instagram);
  	// echo "</pre>";

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>IMD API</title>
   <link rel="stylesheet" href="css/reset.css">
   <style>
      body {
         font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
         font-size: 1.4rem;
         color: #fff;
      }

      * {
         -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
         box-sizing: border-box;
      }

      h1 {
         font-size: 2.5rem;
      }

      header{
         background-color: #E74C3C;
         text-align: center;
         padding: 100px 0;
      }

      .wrapper {
         padding: 0 15px;
      }

      .img img {
         width: 100%;
      }

      .img{
         margin: 0 auto;
         position: relative;
      }

      .username{
         position: absolute;
         width: 100%;
         left: 0px;
         bottom: 20px;
         font-size: 1.2rem;
      }

      .img p span {
         color: #fff;
         font-weight: bold;
         background: rgba(0,0,0,0.7);
         padding: 10px;
      }

      .profilePic img {
         position: absolute;
         width: 100px;
         height: 100px;
         border-radius: 50%;
         border: 2px solid #000;
         top:10px;
         left: 10px;
         z-index: 5;
      }

      @media(min-width: 768px){
         .wrapper{
            width: 768px;
            margin: 0 auto;
         }
      }
   </style>
</head>
<body>
   <header>
      <div class="wrapper">
         <h1>#WeAreIMD on Instagram!</h1>
      </div>
   </header>

   <div class="wrapper">
      <section id="content">
      	<?php
         	foreach ($instagram->data as $image) {
               echo "<div class='img'>";
               echo "<p class='profilePic'><img src='" . $image->user->profile_picture . "' alt='profilepic' /></p>";
         		echo "<img src='" . $image->images->standard_resolution->url . "' alt='foto' />";
         	   echo "<p class='username'><span>" . $image->user->username . "</span></p>";
               echo "</div>";
            }
      	?>
      </section>
   </div>
</body>
</html>
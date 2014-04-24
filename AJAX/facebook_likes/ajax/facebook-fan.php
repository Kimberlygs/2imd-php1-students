<?php

if(!empty($_POST))
{

	try{

		include_once("../classes/Activity.class.php");

		$a = new Activity();
		$a ->id = $_POST['id'];
		$likes = $a->like();

		$response['likes'] = $likes;
		$response['status'] = "success";

	}catch (Exception $e){
		$response['status' == "error"];
		$response['message'] = $e->getMessage();
	}

	echo json_encode($response);
	/*if(!empty($_POST))
	{
		include_once("../classes/Activity.class.php");
		$a = new Activity();
		$a->id = $_POST['id'];	
		$likes = $a->like();
		echo $likes;
	}


}*/

}
// 1 - Las er gepost is
// 2 - Liken -> Methode aanroepen in classe
// 3 - 
?>
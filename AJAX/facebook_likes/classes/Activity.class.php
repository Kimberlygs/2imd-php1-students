<?php
/*
Deze klasse dient om subscribers te laten inschrijven 
op onze nieuwsbrief.
*/
class Activity
{
	private $m_sText;
	public $id; // this variable is public, just 
	
	//DB settings, kunnen ook in include geplaatst worden
	private $m_sHost = "localhost";
	private $m_sUser = "root";
	private $m_sPassword = "";
	private $m_sDatabase = "php";
	
	/* we don't use the getters and setters in this app, but they are here for reference and in case we need them afterwards */
	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				if(strlen($p_vValue) < 3)
				{
					throw new Exception("Message is too short!");
				}
				else
				{
					$this->m_sText = $p_vValue;
				}
				break;
		}	   
	}
	
	public function __get($p_sProperty)
	{
		$vResult = null;
		switch($p_sProperty)
		{
		case "Text": 
			$vResult = $this->m_sText;
			break;
		}
		return $vResult;
	}
	
	public function like()
	{
		// AN EXAMPLE WITH PDO so that you can compare with mysqli syntax
		$conn = new PDO('mysql:host=localhost;dbname=php', $this->m_sUser, $this->m_sPassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		// here we get the current number of likes, so that we can add one to it
		$stmt = $conn->prepare('select likes from tblactivities where pk_activity_id = :id');
		$stmt->execute(array('id' => $this->id));

		$row = $stmt->fetch();
		$likes = $row['likes'];

		$likes++;
		// let's update the number of likes with the new number
		$stmt = $conn->prepare('update tblactivities set likes = :likes where pk_activity_id = :id');
		$stmt->execute(array('id' => $this->id, 'likes' => $likes));

		return $likes;		
	}
	
	public function GetRecentActivities()
	{
		// this method is used to return all timeline posts
		$conn = new PDO('mysql:host=localhost;dbname=php', $this->m_sUser, $this->m_sPassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		$stmt = $conn->prepare("select * from tblactivities ORDER BY pk_activity_id DESC LIMIT 5");
		$stmt->execute();		

		return $stmt->fetchAll();
	}
}
?>
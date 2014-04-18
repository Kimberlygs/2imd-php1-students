<?php
class User
{
	private $m_sUserName;

	public $errors = array();
	public $feedbacks = array();
	

	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Username":
				$this->m_sUserName = $p_vValue;
				break;
		}	   
	}
	
	public function __get($p_sProperty)
	{
		$vResult = null;
		switch($p_sProperty)
		{
		case "Username": 
			$vResult = $this->m_sUserName;
			break;
		}
		return $vResult;
	}
	
	public function UsernameAvailable()
	{
		include_once("Connection.php"); //open connection to Dbase
		//checken of username al in de db zit
		$db = new Conn();
		$sql = "select * from tblusers where user_login = '".$db->conn->real_escape_string($this->m_sUserName)."';";
		$result = $db->conn->query($sql);
		if($result)
		{
			if(mysqli_num_rows($result) === 0)
			{
				$available = true;
			}
			else
			{
				$available = false;
				$this->errors['errorAvailable'] = 'We kunnen deze username niet opslagen!';
			}
		}
		else
		{
			$available = false;
			$this->errors['errorDB'] = "Connection to Database has failed!";
		}
		return $available;

		
	}
	
	public function Create()
	{
			include_once("Connection.php");
			$db = new Conn();
			$sSql = "insert into tblusers (user_login) values ('".$db->conn->real_escape_string($this->m_sUserName)."');";	
			$rResult = $db->conn->query($sSql);
			if ($rResult)
			{	
				$this->feedbacks['Signedup'] = "Thanks for signing up!";
			}
			else
			{		
				echo $sSql;			
				// er zijn geen query resultaten, dus query is gefaald
				$this->errors['errorCreate'] = "Caramba couldn't create your account!";
			}					
			
	}
	
}
?>
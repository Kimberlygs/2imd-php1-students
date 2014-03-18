<?php 
	include_once('Db.class.php');
	class User
	{
		private $m_sFirstname;
		private $m_sLastname;
		private $m_sEmail;
		private $m_sPassword;
		private $salt = "2RRRTENF4URT2QBX24ZTQ";

		public $errors = array();

		public function __set($p_sProperty, $p_vValue)
		{
			switch($p_sProperty)
			{
				case "Firstname":
				if(!preg_match("#^[-A-Za-z\&\#0-9\;' .]*$#", $p_vValue) || empty($p_vValue))
				{
					$this->errors['errorFirstname'] = "Please don't use special characters!";
				}
				else
				{
					$this->m_sFirstname = $p_vValue;
				}
				break;

				case "Lastname":
				if(!preg_match("#^[-A-Za-z\&\#0-9\;' .]*$#", $p_vValue) || empty($p_vValue))
				{
					$this->errors['errorLastname'] = "Please don't use special characters!";
				}
				else
				{
					$this->m_sLastname = $p_vValue;
				}
				break;

				case "Email":
				if(!filter_var($p_vValue, FILTER_VALIDATE_EMAIL))
				{
					$this->errors['errorEmail'] = "This is not a valid email!";
				}
				else
				{
					$this->m_sEmail = $p_vValue;
				}
				break;

				case "Password":
				if(strlen($p_vValue) < 8 || empty($p_vValue))
				{
					$this->errors['errorPassword'] = "Password must contain at least 8 characters!";
				}
				else
				{
					$this->m_sPassword = md5($p_vValue . $this->salt);
				}				
				break;

				default:
				echo "Property " . $p_sProperty . " does not exist.</br>";
			}
		}

		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
				case "Firstname":
				return $this->m_sFirstname;
				break;

				case "Lastname":
				return $this->m_sLastname;
				break;

				case "Email":
				return $this->m_sEmail;
				break;

				case "Password":
				return $this->m_sPassword;
				break;

				default:
				echo "Property " . $p_sProperty . " does not exist.</br>";
			}
		}

		public function Save()
		{

			$db = new Db();
			$isAvailable = $this->CheckAvailability($db);
			if($isAvailable)
			{
				$sql = "insert into user (user_firstname, user_lastname, user_email, user_password)
						values (
									'". $db->conn->real_escape_string($this->Firstname)."',
									'". $db->conn->real_escape_string($this->Lastname)."',
									'". $db->conn->real_escape_string($this->Email)."',
									'". $db->conn->real_escape_string($this->Password)."'

							   )";
				$db->conn->query($sql);
			}
			else
			{
				//echo "Email already exists";
				$this->errors['errorAvailability'] = "This email already exists!";
			}
			mysqli_close($db->conn);
		}

		private function CheckAvailability($db)
		{
			$sql = 	'select *
					from user
					where user_email = "'. $db->conn->real_escape_string($this->Email) .'"';
			$result = $db->conn->query($sql);

			if($result)
			{
				$rows = mysqli_num_rows($result);
				if($rows >= 1)
				{
					$available = false;
				}
				else
				{
					$available = true;
				}
			}
			else
			{
				$available = false;
			}
			return $available;
		}

		public function Login()
		{
			$db = new Db();
			$sql =	'select * 
					from user
					where user_email = "'. $db->conn->real_escape_string($this->Email) .'"
					AND user_password = "'. $db->conn->real_escape_string($this->Password) .'"';

			$result = $db->conn->query($sql);
			if($result)
			{
				$rows = mysqli_num_rows($result);
				if($rows === 1)
				{
					$canLogIn =  true;

				}
				else
				{
					$canLogIn = false;
				}

			}
			else
			{
				$canLogIn = false;
			}

			mysqli_close($db->conn);
			return $canLogIn;

		} 
	
	}
 ?>
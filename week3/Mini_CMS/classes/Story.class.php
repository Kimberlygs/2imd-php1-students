<?php 

	include_once("Db.class.php");
	class Story
	{
		private $m_sTitle;
		private $m_sStory;
		private $m_sDayNumb;
		private $m_sDayWord;
		private $m_sMonth;

		public $errors = array();

		public function __set($p_sProperty, $p_vValue)
		{
			switch($p_sProperty)
			{
				case "Title":
				if(empty($p_vValue))
				{
					$this->errors['errorTitleEmpty'] = "Please fill in a title!";
				}
				elseif(strlen($p_vValue) > 70)
				{
					$this->errors['errorTitleLength'] = "Title can't be longer than 70 characters!";
				}
				else
				{
					$this->m_sTitle = $p_vValue;
				}
				break;

				case "Body":
				if(empty($p_vValue))
				{
					$this->errors['errorBody'] = "You forgot to tell your story!";
				}
				else
				{
					$this->m_sStory = $p_vValue;
				}	
				break;

				case "DayNumb":
				$this->m_sDayNumb = $p_vValue;
				break;

				case "DayWord":
				$this->m_sDayWord = $p_vValue;
				break;

				case "Month":
				$this->m_sMonth = $p_vValue;
				break;

				default:
				echo "The property " . $p_sProperty . "is missing!";
			}
		}

		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
				case "Title":
				return $this->m_sTitle;
				break;

				case "Body":
				return $this->m_sStory;
				break;

				case "DayNumb":
				return $this->m_sDayNumb;
				break;

				case "DayWord":
				return $this->m_sDayWord;
				break;

				case "Month":
				return $this->m_sMonth;
				break;

				default:
				echo "The property " . $p_sProperty . "is missing!";
			}
		}

		public function Save()
		{
			$db = new Db();

			$sql = "insert into post (story_title, story_post, story_dayNumb, story_dayWord, story_month)
					values (
								'". $db->conn->real_escape_string($this->Title)."',
								'". $db->conn->real_escape_string($this->Body)."',
								'". $db->conn->real_escape_string($this->DayNumb)."',
								'". $db->conn->real_escape_string($this->DayWord)."',
								'". $db->conn->real_escape_string($this->Month)."'
						   )";
			$db->conn->query($sql);

			mysqli_close($db->conn);
		}

		public function getStories()
		{ 
			$db = new Db();

			$sql = "select * from post";
			
			$result = $db->conn->query($sql);

			return $result;
		}
	}
 ?>
<?php 
	class Conn
	{
		private $m_sHost = "localhost";
		private $m_sUser = "root";
		private $m_sPassword = "";
		private $m_sDatabase = "php4wa";
		public $conn;

		public function __construct()
		{
			$this->conn = new mysqli($this->m_sHost, $this->m_sUser, $this->m_sPassword, $this->m_sDatabase) or die ("Oop, dbase is gone!");
		}
	}	
	
?>
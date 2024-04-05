<?php
class Model
{
	protected $_connection;

	function __construct()
	{
		$host = 'localhost';
		$dbname = 'codebusters';
		$user = 'root';
		$pass = '';
		try
		{
			$this->_connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOEXCEPTION $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
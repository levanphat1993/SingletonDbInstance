<?php


require_once 'config.php';

class SC_Query
{

	private static $instance = null;

	private function __construct($dsn)
	{
		if ($dsn === '') {
			$dsn = DB_TYPE . ':' . implode(array('dbname=' . DB_NAME, 'host=' . DB_SERVER, 'port=' . DB_PORT, 'charset=utf8',), ';');
			$user = DB_USER;
			$password = DB_PASSWORD;
		} else {
			$user = $dsn['DB_USER'];
			$password = $dsn['DB_PASSWORD'];
			$dsn = DB_TYPE . ':dbname=' . $dsn['DB_NAME'] . ';port=' . $dsn['DB_PORT'] . ';host=' . $dsn['DB_SERVER'] . ';charset=utf8';
		}

		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		try {
			self::$instance = new PDO($dsn, $user, $password, $options);
		} catch (PDOException $e) {
			echo 'Connection failed:' . $e->getMessage();
			die();
		}

		$this->conn->query("SET time_zone = '+9:00'");
		$this->conn->query('SET NAMES utf8');

	}


	public static function getSingletonInstance($dsn = '')
	{
		if (self::$instance == null)
		{
			self::$instance = new SC_Query($dsn);
		}
		return self::$instance;
	}

}
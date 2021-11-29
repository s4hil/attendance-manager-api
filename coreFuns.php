<?php
	// The database
	class MyDb extends SQLITE3
	{
		
		function __construct()
		{
			$this->open("./db/_db.sqlite");
		}
	}
	$db = new MyDb();

	// sanitize input
	function clean($str)
	{
		return preg_replace('/[^\.\@\,\-\_A-Za-z0-9 ]/', '', $str);
	}

	// fetch name by email
	function getUsernameByEmail($email)
	{
		global $db;
		$sql = "SELECT * FROM `_users` WHERE `email` = '$email' LIMIT 1";
		$res = $db->query($sql);
		if ($res) {
			return $res->fetchArray(SQLITE3_ASSOC)['name'];
		}
		else {
			return false;
		}
	}

	function userExists($email)
	{
		global $db;
		$res = $db->query("SELECT * FROM `_users` WHERE `email` = '$email'");
		if ($res) {
			if ($res->fetchArray()) {
				return true;
			}
			else {
				return false;
			}
		}
	}
?>
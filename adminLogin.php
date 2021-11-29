<?php
	header("Content-Type: application/json");
	header('Access-Control-Allow-Origin: *');
	include_once 'coreFuns.php';
	$response = array();

	$data = json_decode(file_get_contents("php://input"), true);

	if (!empty($data)) {
		$username = clean($data['username']);
		$password = clean($data['password']);

		$sql = "SELECT * FROM `_admins` WHERE `username` = '$username' AND `password` = '$password'";
		$res = $db->query($sql);
		if ($sql) {
			if ($res->fetchArray() == true) {
				$response['status'] = true;
				$response['msg'] = "Logged In!";
			}
			else {
				$response['status'] = false;
				$response['msg'] = "Invalid Credentials!";
			}
		}
		else {
			$response['status'] = false;
			$response['msg'] = "Not Logged In!";
		}
	}
	else {
		$response['status'] = false;
		$response['msg'] = "Provide Parameters!";
	}
	
	echo json_encode($response, JSON_PRETTY_PRINT);
?>
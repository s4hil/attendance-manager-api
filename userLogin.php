<?php
	header("Content-Type: application/json");
	header('Access-Control-Allow-Origin: *');
	include 'coreFuns.php';
	$response = array();

	$data = json_decode(file_get_contents("php://input"), true);
	
	if (!empty($data)) {
		$email = clean($data['email']);
		$password = clean($data['password']);

		$sql = "SELECT * FROM `_users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
		$res = $db->query($sql);
		if ($res) {
			if ($res->fetchArray() == true) {
				$user = array('name' => getUsernameByEmail($email), 'email' => $email);
				$response['status'] = true;
				$response['msg'] = "Logged In!";
				$response['userInfo'] = $user;
			}
			else {
				$response['status'] = false;
				$response['msg'] = "Invalid Credentials!";
			}
		}
		else {
			$response['status'] = false;
			$response['msg'] = "Failed To Login!";
		}
	}
	else {
		$response['status'] = false;
		$response['msg'] = "Provide Parameters!";
	}
	
	echo json_encode($response, JSON_PRETTY_PRINT);
?>
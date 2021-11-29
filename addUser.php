<?php
	header("Content-Type: application/json");
	header('Access-Control-Allow-Origin: *');
	include 'coreFuns.php';
	$response = array();

	$data = json_decode(file_get_contents("php://input"), true);
	
	if (!empty($data)) {
		$name = ucwords(strtolower(clean($data['name'])));
		$email = strtolower(clean($data['email']));
		$password = clean($data['password']);

		if (userExists($email) == false) {
			$sql = "INSERT INTO `_users` (`name`, `email`, `password`) VALUES(
				'$name',
				'$email',
				'$password'
				)";
			$res = $db->exec($sql);
			if ($res) {
				$response['status'] = true;
				$response['msg'] = "Account Created!";
			}
			else {
				$response['status'] = false;
				$response['msg'] = "Failed To Create Account!";
			}
		}
		else {
			$response['status'] = false;	
			$response['msg'] = "Email Already In Use!";	
		}
	}
	else {
		$response['status'] = false;
		$response['msg'] = "Provide Parameters!";
	}
	
	echo json_encode($response, JSON_PRETTY_PRINT);
?>
<?php
	header("Content-Type: application/json");
	header('Access-Control-Allow-Origin: *');
	include 'coreFuns.php';
	$response = array();

	$data = json_decode(file_get_contents("php://input"), true);
	
	if (!empty($data) || 1==1) {

		$date = clean($data['date']);

		$sql = "SELECT * FROM `_submissions` WHERE `date` = '$date'";
		$res = $db->query($sql);
		if ($res) {
			while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
				$rows[] = $row;
			}
			if (count($rows) != 0) {
				$response['status'] = true;
				$response['data'] = $rows;
			}
			else {
				$response['status'] = false;
				$response['msg'] = "No Entries Found!";
			}
		}
		else {
			$response['status'] = false;
			$response['msg'] = "Query Failed!";
		}
	}
	else {
		$response['status'] = false;
		$response['msg'] = "Provide Parameters!";
	}
	
	echo json_encode($response, JSON_PRETTY_PRINT);
?>
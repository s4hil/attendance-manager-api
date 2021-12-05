<?php
	header("Content-Type: application/json");
	header('Access-Control-Allow-Origin: *');
	include 'coreFuns.php';
	$response = array();

	$data = json_decode(file_get_contents("php://input"), true);
	
	if (!empty($data) || 1==1) {

		$date = date('d-m-Y');
		$class = clean($data['class']);
		$section = clean($data['section']);
		$teacher = clean($data['teacher']);
		$roll = clean($data['roll']);
		$absent = clean($data['absent']);
		$present = intval($roll) - intval($absent);

		if ($class == "" || $section == "" || $roll == "" || $absent == "" || $teacher == "") {
			$response['status'] = false;
			$response['msg'] = "Incomplete Parameters";
		}
		else {
			$sql = "INSERT INTO `_submissions` (
				`date`,
				`class`,
				`section`,
				`teacher`, 
				`roll`, 
				`present`, 
				'absent') VALUES (
					'$date',
					'$class',
					'$section',
					'$teacher',
					'$roll',
					'$present',
					'$absent'
				)";

			$res = $db->exec($sql);
			if ($res) {
				$response['status'] = true;
				$response['msg'] = "Submission was successfull!";
			}
			else{
				$response['status'] = false;
				$response['msg'] = "Failed to save submission!";
			}
		}
	}
	else {
		$response['status'] = false;
		$response['msg'] = "Provide Parameters!";
	}
	
	echo json_encode($response, JSON_PRETTY_PRINT);
?>
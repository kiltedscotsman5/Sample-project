<?php
if(isset($_POST)) {
	$response = '';
	$response_array['code'] = 0;
	if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['message'])) {
		$response_array['message'] = 'Please complete all fields';
	} else {
		$response_array['code'] = 1;
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$message = trim($_POST['message']);
		require_once('includes/connection.inc.php');
		$conn = dbConnect('write');
		$insert = 'INSERT INTO forms (first_name, last_name, message) VALUES (?,?,?)';
		if($stmt = $conn->stmt_init()) {
			$stmt->prepare($insert);
			$stmt->bind_param('sss',$fname,$lname,$message);
			if($stmt->execute()) {
				$response_array['message'] = "Thanks for your message, $fname $lname";
			} else {
				$response_array['message'] = 'Sorry, we were unable to process your message.';
			}
		} else {
			$response_array['message'] = 'Sorry, we were unable to process your message';
		}
	}
	$response = json_encode($response_array);
	echo $response;
}
?>
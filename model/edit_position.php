<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$pos 	= $conn->real_escape_string($_POST['position']);
$order 	= $conn->real_escape_string($_POST['order']);
$id 	= $conn->real_escape_string($_POST['id']);

$query_check_duplicate_position = "SELECT * FROM tblposition WHERE `position` = '$pos'";
$result_check_duplicate_position = $conn->query($query_check_duplicate_position)->num_rows;

if (!empty($id)) {

	if ($result_check_duplicate_position === 0) {
		$query 		= "UPDATE tblposition SET `position` = '$pos', `order`=$order WHERE id_position=$id;";
		$result 	= $conn->query($query);

		if ($result === true) {
			$_SESSION['message'] = 'Position has been updated!';
			$_SESSION['success'] = 'success';
		} else {
			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}
	} else {
		$_SESSION['message'] = 'Position is already existing!';
		$_SESSION['success'] = 'danger';
	}
} else {
	$_SESSION['message'] = 'No position ID found!';
	$_SESSION['success'] = 'danger';
}

header("Location: ../position.php");

$conn->close();

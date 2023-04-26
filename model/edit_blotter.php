<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$id 	       			= $conn->real_escape_string($_POST['id']);
$blotter_status 	    = $conn->real_escape_string($_POST['blotter_status']);
$blotter_date			= $conn->real_escape_string($_POST['blotter_date']);
$blotter_time			= $conn->real_escape_string($_POST['blotter_time']);

$user 					= $_SESSION['id'];

$queryCheckDuplicateSched = "SELECT * FROM tblblotter_schedule JOIN tblblotter ON tblblotter.id_blotter=tblblotter_schedule.id_blotter WHERE `blotter_date` = '$blotter_date' AND `blotter_time` = '$blotter_time' AND tblblotter.blotter_status='Active'";
$resultCheckDuplicatedSched = $conn->query($queryCheckDuplicateSched)->num_rows;
// $checkSched = $resultCheckDuplicatedSched->fetch_assoc();

// $querycheckActiveStatus = "SELECT * FROM tblblotter WHERE blotter_status = 'Active' ";
// $resultcheckActiveStatus = $conn->query($querycheckActiveStatus);

if ($resultCheckDuplicatedSched > 0 == FALSE) {
	if (!empty($id)) {
		$query 		= "UPDATE tblblotter SET `blotter_status`='$blotter_status', `id_user`='$user' WHERE id_blotter=$id;";
		$result 	= $conn->query($query);
		if ($result === true) {
			$_SESSION['message'] = $resultCheckDuplicatedSched;
			$_SESSION['success'] = 'success';
		} else {
			$_SESSION['message'] = 'Something went wrong!';
			$_SESSION['success'] = 'danger';
		}
	} else {
		$_SESSION['message'] = 'No Blotter ID found!';
		$_SESSION['success'] = 'danger';
	}
} else {
	$_SESSION['message'] = 'The schedule has been taken.';
	$_SESSION['success'] = 'danger';
}



header("Location: ../blotter.php");

$conn->close();

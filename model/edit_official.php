<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$id 	        = $conn->real_escape_string($_POST['id']);
$honorifics     = $conn->real_escape_string($_POST['honorifics']);
$name 	        = $conn->real_escape_string($_POST['name']);
$chairmanship   = $_POST['chairmanship'];
$pos 			= $conn->real_escape_string($_POST['position']);
$start 			= $conn->real_escape_string($_POST['start']);
$end 			= $conn->real_escape_string($_POST['end']);
$status 		= $conn->real_escape_string($_POST['status']);

if (!empty($id)) {

	$query 		= "UPDATE tblofficials SET `honorifics`='$honorifics', `name`='$name', `id_position`='$pos', termstart='$start', termend='$end', `status`='$status' WHERE id_officials=$id";
	$result 	= $conn->query($query);

	//REMOVE ALL THE RECORDS AND INSERT ANOTHER ONE for Chairmanship
	$query_delete_chair     = "DELETE FROM tblofficials_chairmanships WHERE id_officials = '$id'";
	$result_delete_chair 	= $conn->query($query_delete_chair);

	foreach ($chairmanship as $chair) {
		$insert_query_chairmanship = "INSERT INTO tblofficials_chairmanships (`id_officials`, `id_chairmanship`) VALUES ('$id', '$chair')";
		$result_query_chairmanship = $conn->query($insert_query_chairmanship);
	}

	if ($result === true) {

		$_SESSION['message'] = 'Brgy Official has been updated!';
		$_SESSION['success'] = 'success';
	} else {

		$_SESSION['message'] = 'Somethin went wrong!';
		$_SESSION['success'] = 'danger';
	}
} else {
	$_SESSION['message'] = 'No Brgy Official ID found!';
	$_SESSION['success'] = 'danger';
}

header("Location: ../officials.php");

$conn->close();

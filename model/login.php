<?php
include '../server/server.php';

$username 	= $conn->real_escape_string($_POST['username']);
$password	= sha1($conn->real_escape_string($_POST['password']));


if ($username != '' and $password != '') {
	$query 		= "SELECT * FROM tbl_users WHERE user_username = '$username' AND password = '$password' AND status = 'Active'";

	$result 	= $conn->query($query);

	if ($result->num_rows) {
		while ($row = $result->fetch_assoc()) {
			$_SESSION['id'] = $row['id_user'];
			$_SESSION['username'] = $row['user_username'];
			$_SESSION['role'] = $row['user_type'];
			$_SESSION['avatar'] = $row['avatar'];
		}

		$date           = date('Y-m-d');
		// $time           = date("H:i:s");
		$details        = $_SESSION['username'] . ', has logged in.';
		$user           = $_SESSION['id'];

		$query2 = "INSERT INTO tbl_user_logs (`details`,`id_user`) VALUES ('$details','$user')";
		$result2 = $conn->query($query2);

		if ($result2 === true) {
			$_SESSION['message'] = 'You have successfull logged in to Adept Barangay Information System!';
			$_SESSION['success'] = 'success';

			header('location: ../dashboard.php');
		}
	} else {
		$_SESSION['message'] = 'Unknown account!';
		$_SESSION['success'] = 'danger';
		header('location: ../login.php');
	}
} else {
	$_SESSION['message'] = 'Username or password is empty!';
	$_SESSION['success'] = 'danger';
	header('location: ../login.php');
}



$conn->close();

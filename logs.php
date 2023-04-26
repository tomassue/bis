<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	

    $date           = date('Y-m-d');
    $time           = date("H:i:s");
    $details        = 'Printed: Certificate of Indigency for ' . ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']. ' ' .$resident['ext']);
    $user           = $_SESSION['username'];

    $query2 = "INSERT INTO tbl_user_logs (`date`,`time`,`details`,`username`) VALUES ('$date','$time','$details','$user')";
    $result2 = $conn->query($query2);

    if($result2 === true)
    {
        $_SESSION['message'] = 'Printed successfuly!';
        $_SESSION['success'] = 'success';
    }


	header("Location: resident_indigency.php");
	$conn->close();


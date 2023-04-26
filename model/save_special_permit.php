<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$grantee 	        = $conn->real_escape_string($_POST['grantee']);
	$representative 	= $conn->real_escape_string($_POST['representative']);
    $action             = $conn->real_escape_string($_POST['action']);
    $start_date         = $conn->real_escape_string($_POST['start_date']);
    $end_date           = $conn->real_escape_string($_POST['end_date']);
    $issued_date 	    = date('Y-m-d');

    $user_id            = $_SESSION['id'];

    if(!empty($grantee) && !empty($representative) && !empty($action) && !empty($start_date) && !empty($end_date) && !empty($user_id)){

        $insert  = "INSERT INTO tbl_special_permit (`grantee`, `representative`, action, start_date, end_date, issued_date, id_user) VALUES ('$grantee', '$representative','$action', '$start_date', '$end_date', '$issued_date', '$user_id')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Special Permit added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../special_permit.php");

	$conn->close();
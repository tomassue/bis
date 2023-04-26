<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$name 	            = $conn->real_escape_string($_POST['name']);
	$venue 	            = $conn->real_escape_string($_POST['venue']);
    $date               = $conn->real_escape_string($_POST['date']);
    $purpose            = $conn->real_escape_string($_POST['purpose']);

    $user_id            = $_SESSION['id'];

    if(!empty($name) && !empty($venue) && !empty($date) && !empty($purpose) && !empty($user_id)){

        $insert  = "INSERT INTO tbl_cert_appearance (`name`, `venue`, `date`, purpose, id_user ) VALUES ('$name', '$venue','$date', '$purpose', '$user_id')";
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

    header("Location: ../certificate_appearance.php");

	$conn->close();
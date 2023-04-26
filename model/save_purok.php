<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$purok_name 	= $conn->real_escape_string($_POST['purok']);
	$details 	= $conn->real_escape_string($_POST['details']);

    if(!empty($purok_name)){

        $insert  = "INSERT INTO tblpurok (`purok_name`, `purok_details`) VALUES ('$purok_name', '$details')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Purok added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../purok.php");

	$conn->close();
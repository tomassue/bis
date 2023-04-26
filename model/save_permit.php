<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$name 	    = $conn->real_escape_string($_POST['name']);
	$location 	= $conn->real_escape_string($_POST['location']);
    $applied 	= $conn->real_escape_string($_POST['applied']);
    $user_username = $_SESSION['id'];

    if(!empty($name) && !empty($location) && !empty($applied)){

        $insert  = "INSERT INTO tblpermit (`name`, `location`, applied, id_user) VALUES ('$name', '$location','$applied', '$user_username')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Construction Clearance added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../business_permit.php");

	$conn->close();
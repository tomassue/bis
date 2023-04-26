<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $user_status        = $conn->real_escape_string($_POST['user_status']);
    $id 	            = $conn->real_escape_string($_POST['id']);

    if(!empty($user_status)){

        $query 		= "UPDATE tbl_users SET `status` = '$user_status' WHERE id_user=$id;";	
		$result 	= $conn->query($query);

        if($result === true){

            $_SESSION['message'] = 'User has been set to '.$user_status.'!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No user ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../users.php");

	$conn->close();
<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$noc_name      = $conn->real_escape_string($_POST['noc_name']);
    $noc_details   = $conn->real_escape_string($_POST['noc_details']);

    $noc_id 	   = $conn->real_escape_string($_POST['noc_id']);

    $user_id       = $_SESSION['id'];

    if(!empty($noc_name)){

        $query 		= "UPDATE tbl_nature_of_case SET `noc_name` = '$noc_name', `noc_details`='$noc_details', `id_user`='$user_id' WHERE noc_id=$noc_id;";
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Nature of Case has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No NOC ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../nature_of_case.php");

	$conn->close();
<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$purok_name 	    = $conn->real_escape_string($_POST['purok']);
	$details 	        = $conn->real_escape_string($_POST['details']);
    $id 	            = $conn->real_escape_string($_POST['id']);

    if(!empty($purok_name)){

        $query 		= "UPDATE tblpurok SET `purok_name` = '$purok_name', `purok_details`='$details' WHERE id_purok=$id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Purok has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No purok ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../purok.php");

	$conn->close();
<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$org 	        = $conn->real_escape_string($_POST['org']);
	$details 	    = $conn->real_escape_string($_POST['details']);
    $org_id 	    = $conn->real_escape_string($_POST['org_id']);

    if(!empty($org)){

        $query 		= "UPDATE tbl_org SET `org_name` = '$org', `details`='$details' WHERE id_org=$org_id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Organization/Association has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No purok ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../organization_or_association.php");

	$conn->close();
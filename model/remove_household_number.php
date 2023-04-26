<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id_household 	= $conn->real_escape_string($_GET['id']);

	if($id_household != ''){
		$query 		= "DELETE FROM tbl_household WHERE id_household = '$id_household'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Household Number has been removed!';
            $_SESSION['success'] = 'danger';
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing Household Number ID!';
		$_SESSION['success'] = 'danger';
	}

	header("Location: ../household_number.php");
	$conn->close();


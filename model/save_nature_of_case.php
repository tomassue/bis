<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$noc_name      = $conn->real_escape_string($_POST['noc_name']);
    $noc_details   = $conn->real_escape_string($_POST['noc_details']);

    $user_id       = $_SESSION['id'];

    if(!empty($noc_name)){

        $insert  = "INSERT INTO tbl_nature_of_case (`noc_name`,`noc_details`,`id_user`) VALUES ('$noc_name','$noc_details','$user_id')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Nature of Case added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../nature_of_case.php");

	$conn->close();
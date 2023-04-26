<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$org 	    = $conn->real_escape_string($_POST['org']);
	$details 	= $conn->real_escape_string($_POST['details']);

    $queryOrg = "SELECT * FROM tbl_org WHERE org_name = '$org'";
    $resultOrg = $conn->query($queryOrg)->num_rows;

    if ($resultOrg > 0 == FALSE)
    {
        if(!empty($org))
        {
            $insert  = "INSERT INTO tbl_org (`org_name`, `details`) VALUES ('$org', '$details')";
            $result  = $conn->query($insert);

            if($result === true){
                $_SESSION['message'] = 'Organization/Association added!';
                $_SESSION['success'] = 'success';

            }else{
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }

        }else{

            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
        }
    }
    else
    {
        $_SESSION['message'] = 'Organization already exist!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../organization_or_association.php");

	$conn->close();
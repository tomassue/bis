<?php
	include '../server/server.php';
   
    session_start();

    // $date           = date('Y-m-d');
    // $time           = date("H:i:s");
    $details        = $_SESSION['username'].', has logged out.';
    $user           = $_SESSION['id'];

    $query2 = "INSERT INTO tbl_user_logs (`details`,`id_user`) VALUES ('$details','$user')";
    $result2 = $conn->query($query2);

    if($result2 === true)
    {
        $_SESSION['message'] = "You have been logged out!";
        $_SESSION['success'] = 'danger';

        // session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['role']);


        header('location: ../login.php');
    }

$_SESSION['message'] = "You have been logged out!";
$_SESSION['success'] = 'danger';

header('location: ../login.php');


<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $id = $_GET['id']
    
    //FOR THE TRANSACTION NUMBER
    $counter = 0;
    $transact_no = date('Ymd') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) . str_pad(++$counter, 6, '0', STR_PAD_LEFT);

    

	$conn->close();
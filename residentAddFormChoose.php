<?php

include 'server/server.php';

if(!isset($_SESSION['username'])){
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$typeofresidency = $_POST['Q1'];

if (isset($_POST['submit'])) {
	if ($typeofresidency === 'New') 
	{
		header("Location: residentAddForm1.1.php");
	}

	if ($typeofresidency === 'Co-occupant') 
	{
		header("Location: residentAddForm1.2.php");
	}

	if ($typeofresidency === 'Tenant') 
	{
		header("Location: residentAddForm1.3.php");
	}
}



?>
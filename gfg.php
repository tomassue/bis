<?php
include 'server/server.php';
include 'model/fetch_brgy_info.php';

// Get the user id
$user_id = $_REQUEST['user_id'];

// Database connection

if ($user_id !== "") {

	// Get corresponding first name and
	// last name for that user id
	$query = "SELECT * FROM tbl_household WHERE household_number='$user_id'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();

	$p_name = $row['id_purok'];
	$query1 = "SELECT * FROM tblpurok WHERE id_purok='$p_name'";
	$result1 = $conn->query($query1);
	$pName = $result1->fetch_assoc();

	// Get the first name
	$detailAdd = $row["household_street_name"] . ', ' . $row["household_address"] . ', ' . $pName["purok_name"] . ', ' . $brgy . ', ' . $town . ', ' . $province;
}

// Store it in a array
$result = array("$detailAdd");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;

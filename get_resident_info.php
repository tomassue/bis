<?php

include('server/server.php');

// Get the selected value from the select option
$id_resident = $_POST['id'];

// Retrieve data from the database based on the selected value
$sql = "SELECT * FROM tblresident2 WHERE id_resident = '$id_resident'";
$result = $conn->query($sql);

// Return the result as JSON
$row3 = $result->fetch_assoc();
echo json_encode($row3);

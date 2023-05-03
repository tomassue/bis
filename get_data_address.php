<?php

include('server/server.php');

// Get the selected value from the select option
$id_household = $_POST['id'];

// Retrieve data from the database based on the selected value
$sql = "SELECT * FROM tbl_household WHERE id_household = '$id_household'";
$result = $conn->query($sql);

// Return the result as JSON
$row3 = $result->fetch_assoc();
echo json_encode($row3);

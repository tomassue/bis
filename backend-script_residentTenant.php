<?php

include('server/server.php');

$searchTerm = $_GET['term'];
// $sql = "SELECT * FROM tbl_household WHERE household_number LIKE '%".$searchTerm."%'"; 
// $result = $conn->query($sql); 

$sql = "SELECT * FROM tblresident2 
				WHERE firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR id_household LIKE '%$searchTerm%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$householdnumberData = array();

	while ($row = $result->fetch_assoc()) {

		// $data['id']    = $row['id_household']; 
		// $data['value'] = $row['id_household'].' '.'['.'Household #: '.$row['household_number'].']';

		$data['id']    = $row['id_household'];
		$data['value'] = $row['id_household'] . ' ' . 'Household No: ' . $row['id_household'] . ' ' . '[' . 'Name: ' . $row['firstname'] . ' ' . $row['lastname'] . ']';

		array_push($householdnumberData, $data);
	}
}

echo json_encode($householdnumberData);

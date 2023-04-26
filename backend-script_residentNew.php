<?php

include('server/server.php');

$searchTerm = $_GET['term'];

$sql = "SELECT * FROM tbl_household WHERE id_household LIKE '%" . $searchTerm . "%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$householdnumberData = array();

	while ($row = $result->fetch_assoc()) {

		$data['id']    = $row['household_number'];
		$data['value'] = $row['id_household'] . ' ' . '[' . 'Household #: ' . $row['household_number'] . ']';

		array_push($householdnumberData, $data);
	}
}

echo json_encode($householdnumberData);

<?php

include('server/server.php');

$searchTerm = $_GET['term'];
$sql = "SELECT * FROM tblresident2 WHERE firstname LIKE '%".$searchTerm."%'"; 
$result = $conn->query($sql); 

if ($result->num_rows > 0) {

  $comp_nameData = array(); 

	  while($row = $result->fetch_assoc()) {

	   $data['id']    = $row['id_resident']; 
	   $data['value'] = $row['id_resident'] .' ' .$row['firstname'].' '.$row['lastname'];

	   // $comp_name = $data['id'];

	   array_push($comp_nameData, $data);
	} 
}

echo json_encode($comp_nameData);

// $_SESSION['comp_name'] = $data['value'];


?>
<?php

require("../server/server.php");

// get Users
$query = "SELECT national_id, region, city, province, barangay, firstname, middlename, lastname, ext, alias, birthdate, birthplace, age, sex, civilstatus, citizenship, occupation, housenum, streetname, address, purok, residence_type, residence_remarks, email, `phone`, voterstatus, identified_as, organization, pwd, indigent FROM tblresident";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Residents.csv'); 
$output = fopen('php://output', 'w');
fputcsv($output, array('National ID', 'Region', 'City', 'Province', 'Barangay', 'First Name','Middle Name', 'Last Name','Extension Name', 'Alias', 'Birthdate', 'Birthplace',  'Age', 'Sex', 'Civil Status', 'Citizenship','Profession/Occupation', 'House No.','Street Name', 'Subdivision Name/Apartment/','Purok','Residence Type','Residence (Remarks)','Email Address','Contact Number','Voter Status', 'Identified As', 'Organization', 'PWD', 'Indigent'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}


?>
<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
$id_resident        = $conn->real_escape_string($_POST['id_resident']);
$mother_family_role = $conn->real_escape_string($_POST['mother_family_role']);
$family_blood_type  = $conn->real_escape_string($_POST['family_blood_type']);

//FOR THE FAMILY NUMBER
$counter = 0;
$family_num = date('Ymd') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) . str_pad(++$counter, 6, '0', STR_PAD_LEFT);

$id_household = $conn->real_escape_string($_POST['id_household']);

// $emergency_name = $_POST['emergency_name'];
// $emergency_relationship = $_POST['emergency_relationship'];
// $emergency_date = $_POST['emergency_date'];
// $emergency_cp = $_POST['emergency_cp'];
// $emergency_landline = $_POST['emergency_landline'];

if (!empty($id_resident) && !empty($id_household)) {
    // Loop through the input arrays
    $query_insert = "INSERT INTO tbl_p_fam_members (`id_resident`, `family_role`, `family_blood_type`, `family_num`) 
                    VALUES ('$id_resident', '$mother_family_role', '$family_blood_type', '$family_num')";
    $result_insert = $conn->query($query_insert);

    $query_insert2 = "INSERT INTO tbl_p_family (`family_num`, `id_household`) VALUES ('$family_num', '$id_household')";
    $result_insert2 = $conn->query($query_insert2);

    if ($result_insert && $result_insert2) {
        $_SESSION['message'] = 'Added successfully!';
        $_SESSION['success'] = 'success';
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../pregnant_women.php");

$conn->close();

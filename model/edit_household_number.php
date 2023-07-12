<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$household_number       = $conn->real_escape_string($_POST['household_number']);
$house_no               = $conn->real_escape_string($_POST['house_no']);
$household_purok        = $conn->real_escape_string($_POST['household_purok']);
$household_street_name  = $conn->real_escape_string($_POST['household_street_name']);
$household_address      = $conn->real_escape_string($_POST['household_address']);
$household_type         = $conn->real_escape_string($_POST['household_type']);

$id_household           = $conn->real_escape_string($_POST['id_household']);

$check_household_number = "SELECT * FROM tbl_household WHERE household_number='$household_number' AND NOT id_household = '$id_household'";
$checkhouseholdnum = $conn->query($check_household_number)->num_rows;

// $check_household_number = "SELECT COUNT(*) FROM tbl_household WHERE household_number='$household_number'";
// $result_check_household_number = $conn->query($check_household_number);
// $checkhouseholdnum = $result_check_household_number->fetch_row()[0];

$check_house_number = "SELECT * FROM tbl_household WHERE house_no='$house_no' AND NOT id_household = '$id_household'";
$checkhousenumber = $conn->query($check_house_number)->num_rows;

// $check_house_number = "SELECT * FROM tbl_household WHERE house_no='$house_no'";
// $result_check_house_number = $conn->query($check_house_number);
// $checkhousenumber = $result_check_house_number->fetch_row()[0];

if (!empty($household_number) && !empty($household_type)) {

    if ($checkhouseholdnum === 1) {
        $_SESSION['message'] = 'Household Number already exist!';
        $_SESSION['success'] = 'danger';
    } else {
        if ($checkhousenumber === 1) {
            $_SESSION['message'] = 'House Number already exist!';
            $_SESSION['success'] = 'danger';
        } else {
            $query      = "UPDATE tbl_household SET `household_number` = '$household_number', `house_no` = '$house_no', `id_purok` = '$household_purok', `household_street_name` = '$household_street_name', `household_address` = '$household_address', `household_type` = '$household_type' WHERE id_household = $id_household";
            $result     = $conn->query($query);

            if ($result === true) {
                $_SESSION['message'] = 'Household Number has been updated!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }
        }
    }

    // if ($checkhouseholdnum > 1 && $checkhousenumber > 1) {
    //     $_SESSION['message'] = 'Household Number or House Number already exist!';
    //     $_SESSION['success'] = 'danger';
    // } else {
    //     $query      = "UPDATE tbl_household SET `household_number` = '$household_number', `house_no` = '$house_no', `id_purok` = '$household_purok', `household_street_name` = '$household_street_name', `household_address` = '$household_address', `household_type` = '$household_type' WHERE id_household = $id_household";
    //     $result     = $conn->query($query);

    //     if ($result === true) {
    //         $_SESSION['message'] = 'Household Number has been updated!';
    //         $_SESSION['success'] = 'success';
    //     } else {
    //         $_SESSION['message'] = 'Something went wrong!';
    //         $_SESSION['success'] = 'danger';
    //     }
    // }

    // $query_check_existing_data = "SELECT * FROM tbl_household WHERE id_household = $id_household";
    // $result_check_existing_data = $conn->query($query_check_existing_data);
    // $existing_data = $result_check_existing_data->fetch_assoc();

    // $isHouseholdNumber_exist = $existing_data['household_number'];
    // $isHouseNumber_exist = $existing_data['house_no'];

    // if () {

    // }


} else {

    $_SESSION['message'] = 'No Household Number ID found!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../household_number.php");

$conn->close();

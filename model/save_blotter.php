<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

/////////////////////////////////////////////////////////////////////////////////////////

//USER
$user_id                = $_SESSION['id'];

//NATURE OF CASE
$noc                    = $conn->real_escape_string($_POST['noc']);
$noc_others             = $conn->real_escape_string($_POST['noc_others']);


//COMPLAINANT'S INFORMATION
//RESIDENT
$complain_name          = $conn->real_escape_string($_POST['comp_name']);
//IF NOT A RESIDENT
$comp_nameNotResident   = $conn->real_escape_string($_POST['comp_nameNotResident']);
$comp_addNotResident    = $conn->real_escape_string($_POST['comp_addNotResident']);
$comp_cnumNotResident   = $conn->real_escape_string($_POST['comp_cnumNotResident']);

$comp_what              = $conn->real_escape_string($_POST['comp_what']);
$comp_what2             = $conn->real_escape_string($_POST['comp_what2']);

//RESPONDENT'S INFORMATION
$respname              = $conn->real_escape_string($_POST['resp_name']);

//SCHEDULE
$blotter_date           = $conn->real_escape_string($_POST['blotter_date']);
$blotter_time           = $conn->real_escape_string($_POST['blotter_time']);

/////////////////////////////////////////////////////////////////////////////////////////////

if (empty($noc_others)) {
    $nocOthers = 'N/A';
} else {
    $nocOthers = $noc_others;
}

if (empty($complain_name)) {
    $compName = 'N/A';
} else {
    //$compName = $complain_name;

    $mystring = $complain_name;
    $first = strtok($mystring, ' '); //SO MAO NI ANG PAG CUT SA STRING BEFORE MAG SPACE.
    $compName = $first;
}

if (empty($comp_nameNotResident)) {
    $compnameNotResident = 'N/A';
} else {
    $compnameNotResident = $comp_nameNotResident;
}

if (empty($comp_addNotResident)) {
    $compaddNotResident = 'N/A';
} else {
    $compaddNotResident = $comp_addNotResident;
}

if (empty($comp_cnumNotResident)) {
    $compcnumNotResident = 'N/A';
} else {
    $compcnumNotResident = $comp_cnumNotResident;
}

/*$mystring = $complain_name;
    $first = strtok($mystring, ' '); //SO MAO NI ANG PAG CUT SA STRING BEFORE MAG SPACE.
    $comp_name = $first;*/

$mystring2 = $respname;
$second    = strtok($mystring2, ' ');
$resp_name = $second;

$queryCheckComp = "SELECT * FROM tblresident2 WHERE id_resident='$compName'";
$checkComp = $conn->query($queryCheckComp)->num_rows;

$queryCheckResp = "SELECT * FROM tblresident2 WHERE id_resident='$resp_name'";
$checkResp = $conn->query($queryCheckResp)->num_rows;

$queryCheckSched = "SELECT * FROM tblblotter_schedule JOIN tblblotter ON tblblotter.id_blotter=tblblotter_schedule.id_blotter WHERE blotter_date='$blotter_date' AND blotter_time='$blotter_time' AND tblblotter.blotter_status='Active'";
$CheckSched = $conn->query($queryCheckSched)->num_rows;

if (($compName == $resp_name && $resp_name == $compName) == FALSE) {

    if ($CheckSched > 0 == FALSE) {

        if ($checkComp > 0 || $checkResp > 0) {

            if (!empty($user_id) && !empty($blotter_date) && !empty($blotter_time)) {

                $insert = "INSERT INTO tblblotter (`noc_id`, `noc_others`, `comp_id`, `comp_nameNotResident`, `comp_addNotResident`, `comp_cnumNotResident`, `comp_what`, `comp_what2`, `resp_id`, `id_user`) VALUES ('$noc', '$nocOthers', '$compName', '$compnameNotResident', '$compaddNotResident', '$compcnumNotResident', '$comp_what', '$comp_what2', '$resp_name', '$user_id')";
                $result = $conn->query($insert);
                $last_id_blotter_inserted = mysqli_insert_id($conn);

                $insert2 = "INSERT INTO tblblotter_schedule (`id_blotter`, `blotter_date`, `blotter_time`) VALUES ('$last_id_blotter_inserted', '$blotter_date', '$blotter_time')";
                $result2 = $conn->query($insert2);

                if ($result === true) {
                    $_SESSION['message'] = 'Blotter added!';
                    $_SESSION['success'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            } else {
                $_SESSION['message'] = 'Please fill up the form completely!';
                $_SESSION['success'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Complainant or Respondent MUST BE A RESIDENT!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'The schedule is not available!';
        $_SESSION['success'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'Invalid input!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../blotter.php");

$conn->close();

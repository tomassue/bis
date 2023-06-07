<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id             = $_POST['mother_id']; //the purpose of this is that when the page goes back to the previous page, the id will retain.
$hcpc_id        = $conn->real_escape_string($_POST['hcpc_id']); //the id of the current pregnancy record.

$month                      = $conn->real_escape_string($_POST['month']); //determines which month of the trimester data are being inserted.
$date_check_up_trimester    = $conn->real_escape_string($_POST['date_check_up_trimester']);
$weight_trimester           = $conn->real_escape_string($_POST['weight_trimester']);
$height_trimester           = $conn->real_escape_string($_POST['height_trimester']);
$age_of_gestation           = $conn->real_escape_string($_POST['age_of_gestation']);
$blood_pressure             = $conn->real_escape_string($_POST['blood_pressure']);
$nutritional_status         = $conn->real_escape_string($_POST['nutritional_status']);
$examination_condition_pregnant_woman       = $conn->real_escape_string($_POST['examination_condition_pregnant_woman']);
$advices_given              = $conn->real_escape_string($_POST['advices_given']);
$birth_plan_changes         = $conn->real_escape_string($_POST['birth_plan_changes']);
$teeth_examination          = $conn->real_escape_string($_POST['teeth_examination']);
$laboratory_tests_done      = $conn->real_escape_string($_POST['laboratory_tests_done']);
$urinalysis                 = $conn->real_escape_string($_POST['urinalysis']);
$complete_blood_count       = $conn->real_escape_string($_POST['complete_blood_count']);
$etiologic_tests            = $conn->real_escape_string($_POST['etiologic_tests']);
$pap_smear                  = $conn->real_escape_string($_POST['pap_smear']);
$gestational_diabetes       = $conn->real_escape_string($_POST['gestational_diabetes']);
$bacteriuria                = $conn->real_escape_string($_POST['bacteriuria']);
$treatments                 = $conn->real_escape_string($_POST['treatments']);
$discussions_or_service_given   = $conn->real_escape_string($_POST['discussions_or_service_given']);
$date_of_return             = $conn->real_escape_string($_POST['date_of_return']);
$name_health_service_provider   = $conn->real_escape_string($_POST['name_health_service_provider']);
$hospital_referral          = $conn->real_escape_string($_POST['hospital_referral']);
$notes                      = $conn->real_escape_string($_POST['notes']);

if (!empty($id) && !empty($hcpc_id) && !empty($month)) {
    // Loop through the input arrays
    $query_insert = "INSERT INTO tbl_p_trimester (`id_mother_h_c_pregnancy_condition`, `month`, `date_check_up_trimester`, `weight_trimester`, `height_trimester`, `age_of_gestation`, `blood_pressure`, `nutritional_status`, `examination_condition_pregnant_woman`, `advices_given`, `birth_plan_changes`, `teeth_examination`, `laboratory_tests_done`, `urinalysis`, `complete_blood_count`, `etiologic_tests`, `pap_smear`, `gestational_diabetes`, `bacteriuria`, `treatments`, `discussions_or_service_given`, `date_of_return`, `name_health_service_provider`, `hospital_referral`, `notes`) 
                    VALUES ('$hcpc_id', '$month', '$date_check_up_trimester', '$weight_trimester', '$height_trimester', '$age_of_gestation', '$blood_pressure', '$nutritional_status', '$examination_condition_pregnant_woman', '$advices_given', '$birth_plan_changes', '$teeth_examination', '$laboratory_tests_done', '$urinalysis', '$complete_blood_count', '$etiologic_tests', '$pap_smear', '$gestational_diabetes', '$bacteriuria', '$treatments', '$discussions_or_service_given', '$date_of_return', '$name_health_service_provider', '$hospital_referral', '$notes')";
    $result_insert = $conn->query($query_insert);

    if ($result_insert) {
        $_SESSION['message'] = 'Added successfully!';
        $_SESSION['success'] = 'success';
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../pregnant_women_profile_view.php?id=" . urlencode($id));

$conn->close();

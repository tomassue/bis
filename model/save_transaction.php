<?php
include('../server/server.php');

session_start();

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$user           = $_SESSION['id']; //ID of the user
$name           = $_SESSION['recipients_name'];
$details        = $_SESSION['details'];

//FOR THE TRANSACTION NUMBER
$counter = 0;
$transact_no = date('Ymd') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) . str_pad(++$counter, 6, '0', STR_PAD_LEFT);

if (!empty($user) && !empty($name)) {

    $insert2 = "INSERT INTO tbl_transactions (`id_payments`, `id_user`, `transact_no`, `details_transact`, `recipient_name`) 
                        VALUES ('$insert_last_id', '$user', '$transact_no', '$details', '$name')";
    $result2 = $conn->query($insert2);

    if ($result2 === true) {

        $_SESSION['message'] = "Transaction's successful!";
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"] . '&closeModal');
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

// unset($_SESSION['id']);
// unset($_SESSION['id_resident']);
// unset($_SESSION['amount']);
// unset($_SESSION['purpose']);

if ($_SESSION['page'] == 'indigency') {
    header("Location: ../resident_indigency.php");
} else if ($_SESSION['page'] == 'oneness') {
    header("Location: ../resident_cert_of_oneness.php");
} else if ($_SESSION['page'] == 'appearance') {
    header("Location: ../certificate_appearance.php");
} else if ($_SESSION['page'] == 'construction') {
    header("Location: ../business_permit.php");
}

$conn->close();

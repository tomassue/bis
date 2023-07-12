<?php
include('../server/server.php');

session_start();

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
/*    
    $user           = $_SESSION['username'];
    $name           = $conn->real_escape_string($_POST['name']);
	$amount 	    = $conn->real_escape_string($_POST['amount']);
    $date           = $conn->real_escape_string($_POST['date']);
	$details 	    = $conn->real_escape_string($_POST['details']);
*/

$user           = $_SESSION['id']; //ID of the user
$name           = $_SESSION['recipients_name'];
$amount         = $_SESSION['amount'];
$details        = $_SESSION['details'];

//FOR THE TRANSACTION NUMBER
$counter = 0;
$transact_no = date('Ymd') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) . str_pad(++$counter, 6, '0', STR_PAD_LEFT);

if (!empty($user) && !empty($name)) {

    $insert  = "INSERT INTO tblpayments (`amounts`) 
                    VALUES ('$amount')";
    $result  = $conn->query($insert);
    $insert_last_id = $conn->insert_id; //This will get the ID of the recent inserted data from $insert.

    if ($result === true) {

        $insert2 = "INSERT INTO tbl_transactions (`id_payments`, `id_user`, `transact_no`, `details_transact`, `recipient_name`) 
                        VALUES ('$insert_last_id', '$user', '$transact_no', '$details', '$name')";
        $result2 = $conn->query($insert2);

        if ($result2 === true) {

            $_SESSION['message'] = 'Payment has been saved!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"] . '&closeModal');
        }
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
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

if ($_SESSION['page'] === 'brgy_cert') {
    header("Location: ../resident_certification.php");
} else if ($_SESSION['page'] === 'special_permit') {
    header("Location: ../special_permit.php");
}

$conn->close();

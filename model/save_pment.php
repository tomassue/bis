<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

/*    $user           = $_SESSION['username'];
    $name           = $conn->real_escape_string($_POST['name']);
	$amount 	    = $conn->real_escape_string($_POST['amount']);
    $date           = $conn->real_escape_string($_POST['date']);
	$details 	    = $conn->real_escape_string($_POST['details']);*/
    
    session_start();

    $user           = $_SESSION['id']; //ID of the user
    $name           = $_SESSION['name'];
    $amount         = $_SESSION['amount'];
    // $date           = date('Y-m-d');
    $details        = $_SESSION['details'];

    //FOR THE TRANSACTION NUMBER
    $counter = 0;
    $transact_no = date('Ymd') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) . str_pad(++$counter, 6, '0', STR_PAD_LEFT);

    // $time           = date("H:i:s");
    // $transaction_id = mt_rand();

    if(!empty($user) && !empty($name)){

        $insert  = "INSERT INTO tblpayments (`amounts`, `name`) 
                    VALUES ('$amount', '$name')";
        $result  = $conn->query($insert);
        $insert_last_id = $conn->insert_id; //This will get the ID of the recent inserted data from $insert.

        if($result === true){

            $insert2 = "INSERT INTO tbl_transactions (`id_payments`, `id_user`, `transact_no`, `details_transact`) 
                        VALUES ('$insert_last_id', '$user', '$transact_no', '$details')";
            $result2 = $conn->query($insert2);


            if($result2 === true){

                $_SESSION['message'] = 'Payment has been saved!';
                $_SESSION['success'] = 'success';

            } else {
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }

            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"].'&closeModal');
            }

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
            
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    // unset($_SESSION["user"]);
    unset($_SESSION["name"]);
    unset($_SESSION["date"]);
    unset($_SESSION["details"]);

	$conn->close();
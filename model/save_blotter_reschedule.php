<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

/////////////////////////////////////////////////////////////////////////////////////////

$id_blotter          = $conn->real_escape_string($_POST['id_blotter']); //the ID of the blotter. This will serve as reference for reschedules histories.
$blotter_date        = $conn->real_escape_string($_POST['reschedule_blotter_date']);
$blotter_time        = $conn->real_escape_string($_POST['reschedule_blotter_time']);

$user_id             = $_SESSION['id'];

/////////////////////////////////////////////////////////////////////////////////////////

//Check if there are duplicates of rescheduled date of the same id_blotter.
$query_checkschedule = "SELECT * FROM tblblotter_schedule WHERE id_blotter = '$id_blotter'";
$checkschedule = $conn->query($query_checkschedule)->fetch_assoc();

//Check if there are schedules that are booked and avoid booking them at the same time.
$query_checkDuplicateschedule = "SELECT * FROM tblblotter_schedule JOIN tblblotter ON tblblotter.id_blotter=tblblotter_schedule.id_blotter WHERE blotter_date = '$blotter_date' AND blotter_time = '$blotter_time' AND tblblotter.blotter_status='Active'";
$checkDuplicateschedule = $conn->query($query_checkDuplicateschedule)->num_rows;

if ($checkDuplicateschedule > 0 == FALSE) {
    if ($checkReschedule['blotter_date'] !== $blotter_date && $checkReschedule['blotter_time'] !== $blotter_time) {

        //MOVING THE OLD SCHEDULE TO THE BLOTTER ARCHIVE SCHEDULE.
        $move_schedule_to_archive = "INSERT INTO tblblotter_schedule_archive (`id_blotter`, `archive_blotter_date`, `archive_blotter_time`, `created_at_blotter_schedule_archive`, `updated_at_blotter_schedule_archive`)
        SELECT id_blotter, blotter_date, blotter_time, created_at_blotter_schedule, updated_at_blotter_schedule
        FROM tblblotter_schedule
        WHERE id_blotter='$id_blotter'";
        $result_move_schedule_to_archive = $conn->query($move_schedule_to_archive);

        //DELETE the old schedule from source table.
        $delete_schedule_from_source_table = "DELETE FROM tblblotter_schedule
        WHERE id_blotter='$id_blotter'";
        $result_delete_schedule_from_source_table = $conn->query($delete_schedule_from_source_table);

        //Then insert new schedue of the blotter.
        $insert_schedule = "INSERT INTO tblblotter_schedule(`id_blotter`,`blotter_date`, `blotter_time`) VALUES ('$id_blotter','$blotter_date', '$blotter_time')";
        $result = $conn->query($insert_schedule);

        if ($result === true) {
            $_SESSION['message'] = 'The blotter has been rescheduled!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Duplicate record!';
        $_SESSION['success'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'The schedule is not available!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../blotter.php");

$conn->close();

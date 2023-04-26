<?php
$querySupport = "SELECT * FROM tbl_support WHERE `status_support` = 'pending'";
$resultSupport = $conn->query($querySupport)->num_rows;

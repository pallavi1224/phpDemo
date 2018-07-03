<?php
include 'config.php';
global $conn;
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$sql = "INSERT INTO `tbl_info`(`f_name`, `l_name`, `email_id`) VALUES ('".$f_name."','".$l_name."','".$email."')";

$arr = array('success' => 1, 'error' => 0);
if ($conn->query($sql) === TRUE) {
    echo json_encode($arr);
} else {
	array('success' => 0, 'error' => 1);
    echo json_encode($arr);
}

$conn->close();
?>
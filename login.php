<?php
session_start();
include 'config.php';
global $conn; 
$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM `tbl_login` WHERE `username`= '".$user."' AND `password`='".$pass."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $_SESSION['username']=$row['username'];
        $arr_empty = array('success' => 1, 'error' => 0);
        echo json_encode($arr_empty);
    }
}else{
        $arr_empty = array('success' => 0, 'error' => 1);
        echo json_encode($arr_empty);
    }
mysqli_close($conn);


?>

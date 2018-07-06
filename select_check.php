<?php
include 'config.php';
global $conn;
$i = 0;
$sql = "SELECT * FROM `my_data` LIMIT 10";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $arr[$i] = array("id"=>$row["info_id"],"f_name"=>$row["f_name"]);
		$i++;
    }
	echo json_encode($arr);
}else{
    $arr_empty = array('success' => 0, 'error' => 1);
    echo json_encode($arr_empty);
}
mysqli_close($conn);
?>

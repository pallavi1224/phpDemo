<?php
include 'config.php';
global $conn;
$i = 0;
$sql = "SELECT * FROM `tbl_info`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $arr[$i] = array("id"=>$row["info_id"],"f_name"=>$row["f_name"],"l_name"=>$row["l_name"],"email"=>$row["email_id"]);
		$i++;
    }
	echo json_encode($arr);
}
mysqli_close($conn);

?>

<?php
include 'config.php';
global $conn;
$i = 0;
$sql = "SELECT * FROM `my_data`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $arr['iTotalRecords'] = mysqli_num_rows($result);
        $arr['iTotalDisplayRecords'] = 10;
        $arr['sEcho'] = 10;
        $arr['aaData'][$i] = array("id"=>$row["info_id"],"f_name"=>$row["f_name"],"l_name"=>$row["l_name"],"email"=>$row["email_id"],"profile"=>$row["profile"]);
		$i++;
    }
	echo json_encode($arr);
}else{
    $arr_empty = array('success' => 0, 'error' => 1);
    echo json_encode($arr_empty);
}
mysqli_close($conn);
?>

<?php
    session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $data = stripcslashes(file_get_contents("php://input"));
    // $mydata = json_decode($data, true);
    $ma_thu_muc = $_GET['ma_thu_muc'];
    $response = array();

    $sql_recycle = mysqli_query($conn , "SELECT * FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE tti.Ma_Thu_Muc = $ma_thu_muc AND tti.Trang_Thai = '0' AND tti.Nguoi_Xoa = $ma_user");
    if($sql_recycle->num_rows > 0){
        while($row = $sql_recycle->fetch_object()){
            $response[] = $row;
        }
    }
    echo json_encode($response);
?>
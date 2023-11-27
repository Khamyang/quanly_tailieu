<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_Phong= $mydata['ma_phong'];
    $response = array();
    $update = mysqli_query($conn, "DELETE FROM tb_phong WHERE Ma_Phong = $Ma_Phong");
    if($update){
        $response['status'] = 1;
        $response['msg'] = 'Xóa phòng thành công';

    } else {
        $response['status'] = 0;
        $response['title'] = 'Xóa phòng không thành công';
        $response['msg'] = 'Chưa có phòng này trong hệ thống';
    }
   
    echo json_encode($response);
?>
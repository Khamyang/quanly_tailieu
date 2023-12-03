<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_User= $mydata['ma_user'];
    $response = array();
    $update = mysqli_query($conn, "DELETE FROM tb_user WHERE Ma_User = $Ma_User");
    if($update){
        $response['status'] = 1;
        $response['msg'] = 'Xóa nhân viên thành công';

    } else {
        $response['status'] = 0;
        $response['title'] = 'Xóa nhân viên không thành công';
        $response['msg'] = 'Chưa có nhân viên này trong hệ thống';
    }
   
    echo json_encode($response);
?>
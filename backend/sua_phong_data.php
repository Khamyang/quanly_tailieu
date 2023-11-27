<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_Phong= $mydata['ma_phong'];
    $Ten_Phong = $mydata['input_sua'];
    $response = array();
    $sql = "SELECT*FROM tb_phong WHERE Ma_Phong = '$Ma_Phong'";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0){
        $update = mysqli_query($conn, "UPDATE tb_phong SET Ten_Phong = '$Ten_Phong' WHERE Ma_Phong = $Ma_Phong");
        if($update){
            $response['status'] = 1;
            $response['msg'] = 'Sửa phòng thành công';
        } else {
            $response['status'] = 0;
            $response['title'] = 'Sửa phòng không thành công';
            $response['msg'] = 'Chưa có phòng này trong hệ thống';
        }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Sửa phòng không thành công';
        $response['msg'] = 'Chưa có phòng này trong hệ thống';
    }
   
    echo json_encode($response);
?>
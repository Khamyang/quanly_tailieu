<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ten_Phong = $mydata['ten_phong'];
    $response = array();
    $sql = "SELECT*FROM tb_phong WHERE Ten_Phong = '".$Ten_Phong."'";
    $query = mysqli_query($conn, $sql); 
    if($query->num_rows == 0){
        $insert= mysqli_query($conn, "INSERT INTO tb_phong SET Ten_Phong = '$Ten_Phong'");
        if($insert){
            $response['status'] = 1;
            $response['msg'] = 'Thêm phòng thành công';
        } else {
            $response['status'] = 0;
            $response['title'] = 'Thêm phòng không thành công';
            $response['msg'] = 'Đã có phòng này trong hệ thống1';
        }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Thêm phòng không thành công';
        $response['msg'] = 'Đã có phòng này trong hệ thống';
    }
   
    echo json_encode($response);
?>
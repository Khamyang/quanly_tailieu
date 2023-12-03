<?php
    session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ten_Thu_Muc = $mydata['ten_thu_muc'];
    $Ma_Phong = $mydata['ma_phong'];
    $response = array();
    $sql = "SELECT*FROM tb_thu_muc WHERE Ten_Thu_Muc = '$Ten_Thu_Muc'AND Ma_Phong = $Ma_Phong";
    $query = mysqli_query($conn, $sql); 
    if($query->num_rows == 0){
        $insert= mysqli_query($conn, "INSERT INTO tb_thu_muc SET Ten_Thu_Muc= '$Ten_Thu_Muc', Ma_User = $ma_user, Ma_Phong = $Ma_Phong");
        if($insert){
            $response['status'] = 1;
            $response['msg'] = 'Thêm thư mục thành công';
        } else {
            $response['status'] = 0;
            $response['title'] = 'Thêm thư mục không thành công';
            $response['msg'] = 'Đã có thư mục này trong hệ thống1';
        }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Thêm thư mục không thành công';
        $response['msg'] = 'Đã có thư mục này trong hệ thống rồi';
    }
   
    echo json_encode($response);
?>
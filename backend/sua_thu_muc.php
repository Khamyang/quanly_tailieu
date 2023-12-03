<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_Phong= $mydata['ma_phong'];
    $Ma_Thu_Muc= $mydata['ma_thu_muc'];
    $Ten_Thu_Muc = $mydata['ten_thu_muc'];
    $response = array();
    $sql = "SELECT*FROM tb_thu_muc WHERE Ma_Thu_Muc = $Ma_Thu_Muc";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0){
        $sql_chk_ten = mysqli_query($conn, "SELECT * FROM tb_thu_muc WHERE Ten_Thu_Muc ='$Ten_Thu_Muc' AND Ma_Phong = $Ma_Phong");
        if($sql_chk_ten -> num_rows > 0){
            $response['status'] = 0;
            $response['title'] = 'Sửa tên thư múc không thành công';
            $response['msg'] = 'Đã có tên thư múc này trong hệ thống rồi';
        } else {
            $update = mysqli_query($conn, "UPDATE tb_thu_muc SET Ten_Thu_Muc = '$Ten_Thu_Muc' WHERE Ma_Thu_Muc = $Ma_Thu_Muc");
            if($update){
                $response['status'] = 1;
                $response['msg'] = 'Sửa tên thư múc thành công';
            } else {
                $response['status'] = 0;
                $response['title'] = 'Sửa tên thư múc không thành công';
                $response['msg'] = 'Chưa có thư múc này trong hệ thống';
            }
        }
        
    } else {
        $response['status'] = 0;
        $response['title'] = 'Sửa tên thư múc không thành công';
        $response['msg'] = 'Chưa có thư múc này trong hệ thống';
    }
   
    echo json_encode($response);
?>
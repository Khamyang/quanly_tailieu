<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_User= $mydata['ma_user'];
    // $Ten_Dang_Nhap=$mydata['ten_dang_nhap'];
    $Mat_Khau=password_hash(trim($mydata['mat_khau']), PASSWORD_DEFAULT);

    $response = array();
    $sql = "SELECT*FROM tb_user WHERE Ma_User = '$Ma_User'";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0){
        $update = mysqli_query($conn, "UPDATE tb_user SET Mat_Khau = '$Mat_Khau' WHERE Ma_User = '$Ma_User'");
        if($update){
            $response['status'] = 1;
            $response['msg'] = 'Thay đổi mật khẩu thành công';
        } else {
            $response['status'] = 0;
            $response['title'] = 'Thay đổi mật khẩu không thành công';
            $response['msg'] = 'Mật khẩu không chính xác';
        }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Thay đổi mật khẩu không thành công';
        $response['msg'] = 'Mật khẩu không chính xác';
    }
   
    echo json_encode($response);
?>
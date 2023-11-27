<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ten_Dang_Nhap = $mydata['ten_dang_nhap'];
    $Mat_Khau = $mydata['mat_khau'];
    $response = array();
    $sql = "SELECT*FROM tb_user WHERE Ten_Dang_Nhap = '$Ten_Dang_Nhap'";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0){
        $result = mysqli_fetch_object($query);
        $pass_hash = $result->Mat_Khau;
        if(password_verify($Mat_Khau, $pass_hash)){
            $_SESSION['ten_dang_nhap'] = $result->Ten_Dang_Nhap;
            $_SESSION['quyen'] = $result->Quyen;
            $_SESSION['ma_user'] = $result->Ma_User;
            $response['status'] = 1;
            $response['msg'] = 'Đăng nhập thành công';
        } else {
            $response['status'] = 0;
            $response['mat_khau'] = $Mat_Khau;
            $response['title'] = 'Đăng nhập không thành công';
            $response['msg'] = 'Say mật khẩu';
        }
    } else {
        $response['status'] = 0;
        $response['mat_khau'] = $Mat_Khau;
        $response['title'] = 'Đăng nhập không thành công';
        $response['msg'] = 'Say tên đăng nhập';
    }
   
    echo json_encode($response);
?>
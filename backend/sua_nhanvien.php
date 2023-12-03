<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_User= $mydata['ma_user'];
    $Ho_Ten=$mydata['ho_ten'];
    $So_Dien_Thoai=$mydata['so_dien_thoai'];
    $Gioi_Tinh=$mydata['gioi_tinh'];
    $Email=$mydata['email'];
    $Ma_Phong=$mydata['ma_phong'];

    $response = array();
    $sql = "SELECT*FROM tb_user WHERE Ma_User = '$Ma_User'";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0){
        $update = mysqli_query($conn, "UPDATE tb_user SET Ho_Ten = '$Ho_Ten', So_Dien_Thoai = '$So_Dien_Thoai', Gioi_Tinh = '$Gioi_Tinh', Email = '$Email', Ma_Phong = '$Ma_Phong' WHERE Ma_User = '$Ma_User'");
        if($update){
            $response['status'] = 1;
            $response['msg'] = 'Sửa nhân viên thành công';
        } else {
            $response['status'] = 0;
            $response['title'] = 'Sửa nhân viên không thành công';
            $response['msg'] = 'Chưa có nhân viên này trong hệ thống';
        }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Sửa nhân viên không thành công';
        $response['msg'] = 'Chưa có nhân viên này trong hệ thống';
    }
   
    echo json_encode($response);
?>
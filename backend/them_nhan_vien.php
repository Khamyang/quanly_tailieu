<?php
    session_start();
    include "../connect/connect.php";
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ho_Ten = $mydata['ho_ten'];
    $So_Dien_Thoai = $mydata['so_dien_thoai'];
    $Gioi_Tinh = $mydata['gioi_tinh'];
    $Email = $mydata['email'];
    $Ma_Phong = $mydata['ma_phong'];
    $Ten_Dang_Nhap = $mydata['ten_dang_nhap'];
    $Mat_Khau = password_hash(trim($mydata['mat_khau']), PASSWORD_DEFAULT);
    $Xac_Nhan_Mat_Khau = $mydata['xac_nhan_mat_khau'];

    $response = array();
    $sql = "SELECT*FROM tb_user WHERE Ten_Dang_Nhap = '$Ten_Dang_Nhap'";
    $query = mysqli_query($conn, $sql); 
    if($query->num_rows == 0){
        $insert= mysqli_query($conn, "INSERT INTO tb_user SET Ho_Ten = '$Ho_Ten', So_Dien_Thoai = '$So_Dien_Thoai', Gioi_Tinh = '$Gioi_Tinh', Email = '$Email', Ma_Phong = '$Ma_Phong', Ten_Dang_Nhap = '$Ten_Dang_Nhap', Mat_Khau = '$Mat_Khau'");
        if($insert){
            $response['status'] = 1;
            $response['msg'] = 'Thêm nhân viên thành công';
        } else {
            $response['status'] = 0;
            $response['title'] = 'Thêm nhân viên không thành công';
            $response['msg'] = 'Đã có nhân viên này trong hệ thống1';
        }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Thêm nhân viên không thành công';
        $response['msg'] = 'Đã có nhân viên này trong hệ thống';
    }
   
    echo json_encode($response);
?>
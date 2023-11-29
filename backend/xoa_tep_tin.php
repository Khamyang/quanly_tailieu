<?php
    session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_Tep_Tin= $mydata['ma_tep_tin'];
    $response = array();
    // $path = '../files/';
    $sql_check = mysqli_query($conn, "SELECT Ten_Tep_Tin FROM tb_tep_tin WHERE Ma_Tep_Tin= $Ma_Tep_Tin");
    if($sql_check->num_rows > 0){
        // $res = $sql_check->fetch_object();
        // $tep_tin =  trim($res->Ten_Tep_Tin);
        // if(unlink($path.$tep_tin)){
            $update = mysqli_query($conn, "UPDATE tb_tep_tin SET Nguoi_Xoa = $ma_user, Trang_Thai = '0' WHERE Ma_Tep_Tin= $Ma_Tep_Tin");
            if($update){
                $response['status'] = 1;
                $response['msg'] = 'Xóa têp tin thành công';
        
            } else {
                $response['status'] = 0;
                $response['title'] = 'Xóa têp tin không thành công';
                $response['msg'] = 'Chưa có têp tin này trong hệ thống';
            }
        // }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Xóa têp tin không thành công';
        $response['msg'] = 'Chưa có têp tin này trong hệ thống';
    }
    
   
    echo json_encode($response);
?>
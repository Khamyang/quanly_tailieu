<?php
    session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $action = trim($_GET['action']);
    $ma_thu_muc = $_GET['ma_thu_muc'];

    $path = '../files/';
    $response = array();
    if($action == "xoa"){
        for($i = 0;$i < count($mydata); $i++){
            $sql_check = mysqli_query($conn, "SELECT Ten_Tep_Tin FROM tb_tep_tin WHERE Ma_Tep_Tin = $mydata[$i]");
            if($sql_check->num_rows > 0){
                $res = $sql_check->fetch_object();
                $tep_tin =  trim($res->Ten_Tep_Tin);
                if(unlink($path.$tep_tin)){
                    $del = mysqli_query($conn ,"DELETE FROM tb_tep_tin where Ma_Tep_Tin = $mydata[$i]");
                }
            }
            
        } 
        if($del){
            $sql_recycle = mysqli_query($conn , "SELECT COUNT(tti.Ma_Tep_Tin) as tong_xoa FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE tti.Ma_Thu_Muc = $ma_thu_muc AND tti.Trang_Thai = '0' AND tti.Nguoi_Xoa = $ma_user");
            $result = $sql_recycle->fetch_object();
            $tong_xoa = $result->tong_xoa;
            if($tong_xoa > 0){
                $alert_ = "<span class='alert-primary circle'>".$tong_xoa."</span>";
            } else {
                $alert_ = "";
            }
            $response['status'] = 1;
            $response['msg'] = 'Xóa tệp tin thành công';
            $response['action'] = $action;
            $response['tong_xoa'] = $alert_ ;
        } else {
            $response['status'] = 0;
            $response['action'] = $action;
            $response['msg'] = 'Xóa tệp tin không thành công';
            $response['tong_xoa'] = '';
        }
    }else if($action == "khoi_phuc"){
        for($i = 0;$i < count($mydata); $i++){
            $sql_check = mysqli_query($conn, "SELECT Ten_Tep_Tin FROM tb_tep_tin WHERE Ma_Tep_Tin = $mydata[$i]");
            if($sql_check->num_rows > 0){
                $up = mysqli_query($conn ,"UPDATE tb_tep_tin SET Nguoi_Xoa = NULL, Trang_Thai = '1' WHERE Ma_Tep_Tin = $mydata[$i]");

            }
        } 
        if($up ==true){
            $sql_recycle = mysqli_query($conn , "SELECT COUNT(tti.Ma_Tep_Tin) as tong_xoa FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE tti.Ma_Thu_Muc = $ma_thu_muc AND tti.Trang_Thai = '0' AND tti.Nguoi_Xoa = $ma_user");
                $result = $sql_recycle->fetch_object();
                $tong_xoa = $result->tong_xoa;
                if($tong_xoa > 0){
                    $alert_ = "<span class='alert-primary circle'>".$tong_xoa."</span>";
                } else {
                    $alert_ = "";
                }
                $response['status'] = 1;
                $response['msg'] = 'Khôi phục tệp tin thành công';
                $response['action'] = $action;
                $response['tong_xoa'] = $alert_;
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Khôi phục tệp tin không thành công';
            $response['action'] = $action;
            $response['tong_xoa'] = '' ;
        }
    }
    
    echo json_encode($response);
?>
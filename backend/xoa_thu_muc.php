<?php
    session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $Ma_Thu_Muc= $mydata['ma_thu_muc'];
    $response = array();
    $trang_thai_xoa = array();
    $path = '../files/';
    $sql_check = mysqli_query($conn, "SELECT * FROM tb_thu_muc WHERE Ma_Thu_Muc = $Ma_Thu_Muc");
    if($sql_check->num_rows > 0){
        $res = $sql_check->fetch_object();
        $sql_tep_tin = mysqli_query($conn, "SELECT Ten_Tep_Tin FROM tb_tep_tin WHERE Ma_Thu_Muc = $Ma_Thu_Muc");
         if($sql_tep_tin -> num_rows > 0){
            while($row = $sql_tep_tin->fetch_object()){
            $tep_tin =  trim($row->Ten_Tep_Tin);
            if(file_exists($path.$tep_tin)){
                if(unlink($path.$tep_tin)){
                    $del_tt = mysqli_query($conn ,"DELETE FROM tb_tep_tin WHERE Ma_Thu_Muc = $Ma_Thu_Muc");
                    if($del_tt == false){
                        $trang_thai_xoa[] = "error";
                    }
                }
            } else {
                $trang_thai_xoa[] = "error";
            }
         }
        }
        if(count($trang_thai_xoa) == '0'){
            $del= mysqli_query($conn, "DELETE FROM tb_thu_muc WHERE Ma_Thu_Muc = $Ma_Thu_Muc");
            if($del){
                $response['status'] = 1;
                $response['msg'] = 'Xóa thư múc thành công';
        
            } else {
                $response['status'] = 0;
                $response['title'] = 'Xóa thư múc không thành công';
                $response['msg'] = 'Không có thư múc này trong hệ thống';
            }
         }
    } else {
        $response['status'] = 0;
        $response['title'] = 'Xóa thư múc không thành công';
        $response['msg'] = 'Không có thư múc này trong hệ thống';
    }
    echo json_encode($response);
?>
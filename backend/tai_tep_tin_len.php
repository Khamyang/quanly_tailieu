<?php
session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $Ma_Thu_Muc = $_GET['ma_thu_muc'];
    $file_name =  $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $file_up_name = $file_name;
    $mov = move_uploaded_file($tmp_name, "../files/".$file_up_name);
    if($mov){
        $upload = mysqli_query($conn, "INSERT INTO tb_tep_tin (Ten_Tep_Tin, Ma_Thu_Muc, Ma_User) VALUES(' $file_up_name',$Ma_Thu_Muc,$ma_user)");
        if($upload){
            $response['status'] = 1;
            $response['msg'] = 'Thêm tệp tin thành công';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Thêm tệp tin khong thành công';
        }
    }
    echo json_encode($response)
    
?>
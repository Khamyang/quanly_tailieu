<?php
session_start();
    include "../connect/connect.php";
    $ma_user = $_SESSION['ma_user'];
    $Ma_Thu_Muc = $_GET['ma_thu_muc'];
    $file_name = trim($_FILES['file']['name']);
    $tmp_name = $_FILES['file']['tmp_name'];
    $file_up_name = $Ma_Thu_Muc."_".$file_name;
    // $path = "../files/";
    $sql = mysqli_query($conn, "SELECT * FROM tb_tep_tin WHERE Ten_Tep_Tin = '$file_up_name' AND Ma_Thu_Muc = $Ma_Thu_Muc");
    if($sql -> num_rows > 0){
        $response['status'] = 0;
        $response['title'] = 'Thêm tệp tin không thành công';
        $response['msg'] = 'Đã có tên tệp tin này trong hệ thống, hãy đổi tên khác và tải lên lại';
    } else {
        $mov = move_uploaded_file($tmp_name, "../files/".$file_up_name);
        if($mov){
            $upload = mysqli_query($conn, "INSERT INTO tb_tep_tin (Ten_Tep_Tin, Ma_Thu_Muc, Ma_User) VALUES('$file_up_name',$Ma_Thu_Muc,$ma_user)");
            if($upload){
                $response['status'] = 1;
                $response['msg'] = 'Thêm tệp tin thành công';
            } else {
                $response['status'] = 0;
                $response['msg'] = 'Thêm tệp tin không thành công';
            }
        }
    }
    echo json_encode($response)
    
?>
<?php
$title = "";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'quan_ly_phong':
            include "./frontend/quan_ly_phong.php";
            break;
        case 'quan_ly_nhan_vien':
            include "./frontend/quan_ly_nhan_vien.php";
            break;
        case 'chi_tiet_phong':
            include "./frontend/chi_tiet_phong.php";
            break;
        case 'chi_tiet_thu_muc':
            include "./frontend/chi_tiet_thu_muc.php";
            break;
        case 'dang_xuat':
            include "./backend/dang_xuat.php";
            break;
        default:
            include "./frontend/quan_ly_phong.php";
            break;
    }
} else {
    include "./frontend/quan_ly_phong.php";
}
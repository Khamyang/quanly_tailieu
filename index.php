<?php
session_start();
include "connect/connect.php";
 if(isset($_SESSION['ten_dang_nhap']) ==''){
        header("Location: dang_nhap.php");
        $log_ten_dang_nhap ='';
        $log_quyen = '';
        $log_ma_user = '';
 } else {
    $log_ten_dang_nhap =$_SESSION['ten_dang_nhap'];
    $log_quyen =  $_SESSION['quyen'];
    $log_ma_user =  $_SESSION['ma_user'];
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" type="text/css" href="styles.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <!-- select 2 -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <style>
    body {
        font-family: 'Times New Roman', Times, serif;
    }

    .wrapper {
        width: 100%;
        display: flex;
        min-height: 100vh;
        overflow: hidden;
    }

    .wrapper .sidebar {
        width: 20%;
        background-color: rgb(241, 241, 241);
        box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
    }

    .sidebar_menu li {
        list-style: none;
        font-size: large;
        padding-top: 5px;
        padding-bottom: 5px;

    }

    .sidebar_menu li a {
        color: black;
        text-decoration: none;
        padding: 10px;
        ;
    }

    .sidebar_menu i {
        color: green;

    }

    .wrapper .content {
        width: 80%;
        overflow-y: scroll;
        overflow-x: hidden
    }
    .content {
        height: 100vh;
        position: relative;
    }
    .footer {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        color: white;
        text-align: center;
    }

    .content_header {
        background-color: rgb(241, 241, 241);
        box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" style="position: relative;">
            <div class="text-center p-2">
                <img src="assets/image/folder_login.png" alt="" width="30%"> <span>
                    <h4>Hệ thống quản lí tài liệu</h4>
                </span>
            </div>
            <hr>
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }
            ?>
            <div class="sidebar_menu">
                <!-- <ul> -->
                <li
                    class=" p-2 <?= ($page == "" || $page == "quan_ly_phong" || $page == "chi_tiet_phong" || $page == "chi_tiet_thu_muc") ? "bg-warning" : ""; ?>">
                    <a href="?page=quan_ly_phong"><i class="fa fa-list"></i> Quản lý Phòng ban</a>
                </li>
                <li class="p-2 <?= ($page == "quan_ly_nhan_vien") ? "bg-warning" : ""; ?>"><a
                        href="?page=quan_ly_nhan_vien"><i class="fa fa-user"></i> Quản lý Nhân viên</a></li>
                <!-- </ul> -->
                <li class="p-2 "><a class="alert-secondary rounded-start text-danger" href="?page=dang_xuat"
                        style="position: absolute;right: 0;bottom:0"><i class="fa fa-sign-out text-danger"
                            aria-hidden="true"></i> Đăng xuất</a></li>
                <!-- </ul> -->
            </div>
        </div>
        <div class="content">
            <div class="container ps-3">
                <article>
                    <div class="content_header p-2">
                        <div class="rounded border p-2 d-flex justify-content-between bg-white">
                            <div>
                                <h3><i class="fa fa-menu" aria-hidden="true"></i>Quản lý Phòng</h3>
                            </div>
                            <div class="d-flex align-items-end">Chào: <span
                                    class="text-danger"><?=$log_ten_dang_nhap?></span></div>
                        </div>
                    </div>
                    <div class="content_item" style="width: 100%;">
                        <?php include "component/page.php"; ?>
                    </div>
                </article>
            </div>
            <!-- <div class="footer">
                <div class="alert-secondary">
                    <div class="container">
                        <div class="d-flex align-items-center justify-content-between" style="height: 46px;">
                            <div>
                                <span>Copyright © Quản lý tài lệu 2024</span>
                            </div>
                            <div>
                                <span>Phát triển bởi: <a class="sponsored-link" rel="sponsored" href="#">En Na Chay Nha Hặc</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
<!-- select2 -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/swal.js"></script>

</html>
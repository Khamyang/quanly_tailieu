<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <style>
        body {
        font-family: 'Times New Roman', Times, serif;
    }
    .login {
        width: 800px;
        margin: auto;
    }

    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container h-100 login">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="rounded d-flex align-items-center justify-content-center p-5"
                    style="background-color: rgb(231, 232, 232);;">
                    <div class="col-md-6 bg-white p-5 card text-center" style="height: 100%;">
                        <img src="assets/image/folder_login.png" width="100%">
                        <h5>Hệ thống quản lý tài liệu</h5>
                    </div>
                    <div class="col-md-6 offset-xl-1">
                        <form action="" method="post" id="form_login">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="ten_dang_nhap">Tên đăng nhập</label>
                                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap"
                                    class="form-control form-control-lg" required />
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="mat_khau">Mật khẩu</label>
                                <input type="password" id="mat_khau" name="mat_khau"
                                    class="form-control form-control-lg" required />

                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block w-100" name="btn_dang_nhap"
                                id="btn_dang_nhap" onclick="event.preventDefault();fun_login()">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
function fun_login() {
    var ten_dang_nhap = document.getElementById('ten_dang_nhap').value;
    var mat_khau = document.getElementById('mat_khau').value;
    if (ten_dang_nhap != '' && mat_khau != '') {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/dang_nhap_data.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.responseType = "json";
        xhr.onload = () => {
            if (xhr.status === 200) {
                if (xhr.response) {
                    x = xhr.response
                } else {
                    x = "";
                }
                console.log(x);
                if(x.status == 1){
                    swal_succ(x.msg)

                    window.setTimeout(function(){
                        location.href = 'index.php?page=quan_ly_phong'
                    }, 1500)
                } else {
                    swal_err(x.title,x.msg)
                }
            } else {
                swal_succ('Đăng nhập không thành công');
            }
        }
        const mydata = {
            ten_dang_nhap: ten_dang_nhap,
            mat_khau: mat_khau
        };
        console.log(mydata);
        const data = JSON.stringify(mydata);
        console.log(data);
        xhr.send(data);
    }
}
</script>
<script src="assets/js/swal.js"></script>
</html>
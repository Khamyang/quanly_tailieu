<style>
    pre {
     width: 150px;
     font-family: 'Times New Roman', Times, serif;
     font-size: 16px;
     z-index: 1;
} 
</style>

<section class="p-2">
    <div class="card">
        <div>
            <div class="p-3">
                <div class="row">
                    <div class="data_table">
                        <table id="tb_quan_ly_nhan_vien" class="table table-striped table-bordered" style="width: 100%;">
                            <thead class="bg-warning">
                                <tr>
                                <th width="1%" class="text-center bg-warning" style="position: sticky;left:0px;z-index:100;"><pre style="width: 30px;">STT</pre></th>
                                <?php if($log_quyen == 1){?>
                                    <th width="10%" class="text-center bg-warning" style="position: sticky;left:69.4px;z-index:100">
                                        <button class="btn btn-primary" id="btn_them_nhan_vien"><i
                                                class="fa fa-add"></i>
                                        </button>
                                    </th>
                                <?php }?>
                                    <th  class="col_tong_quan bg-warning"><pre>Họ tên</pre></th>
                                    <th  class="col_tong_quan"><pre>Số điện thoại</pre></th>
                                    <th  class="col_tong_quan"><pre>Email</pre></th>
                                    <th  class="col_tong_quan"><pre>Giới tính</pre></th>
                                    <th  class="col_tong_quan"><pre>Phòng</pre></th>
                                    <?php if($log_quyen == 1){?>
                                    <th  class="col_tao_mat_khao"><pre>Tên đăng nhập</pre></th>
                                    <th  class="col_tao_mat_khao"><pre id="th_mat_khau">Mật khẩu</pre></th>
                                    <th  class="col_tao_mat_khao"><pre>Xác nhận mật khẩu</pre></th>
                                    <?php }?>
                                    
                                </tr>
                                <?php if($log_quyen == 1){?>
                                <tr id="tr_them_nhan_vien" hidden>
                                    <form action="" id="form_them_nhan_vien" method="post">
                                        <td style="position: sticky;left:0px;z-index:100" class="bg-warning"></td>
                                        <td class="bg-warning text-center" style="position: sticky;left:69.7px;z-index:100">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success" onclick="func_them_nhan_vien()"
                                                    id="btn_luu_them_nhan_vien"><i class="fa fa-save"></i></button>
                                                <button type="button" class="btn btn-danger"
                                                    id="btn_huy_them_nhan_vien"><i class="fa fa-close"></i></button>
                                            </div>
                                        </td>
                                        <td class="bg-warning" ><input type="text" class="form-control" id="ho_ten" required></td>
                                        <td><input type="text" class="form-control" id="so_dien_thoai"></td>
                                        <td><input type="email" class="form-control" id="email"></td>
                                        <td>
                                            <select class="form-control sua_input" id="gioi_tinh">
                                                style="width: 100%;display:none" required>
                                                <option selected value="">-- Chọn giới tính --</option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="phong" style="width: 100%;" required>
                                                    <option value="">-- Chọn phòng --</option>
                                                    <?php
                                                $sql_them_phong = mysqli_query($conn, "SELECT*FROM tb_phong");
                                                while($row_them_phong = $sql_them_phong ->fetch_object()){
                                                ?>
                                                    <option value="<?=$row_them_phong->Ma_Phong?>">
                                                        <?=$row_them_phong->Ten_Phong?></option>
                                                    <?php }?>
                                            </select>
                                        </td>
                                        <td class="col_tao_mat_khao">
                                            <input type="text" name="ten_dang_nhap" id="ten_dang_nhap"
                                                class="form-control">
                                        </td>
                                        <td class="col_tao_mat_khao">
                                            <input type="password" name="mat_khau" id="mat_khau"
                                                class="form-control">
                                        </td>
                                        <td class="col_tao_mat_khao">
                                            <input type="password" name="xac_nhan_mat_khau" id="xac_nhan_mat_khau"
                                                class="form-control">
                                        </td>
                                        
                                    </form>
                                </tr>
                                <?php }?>
                            </thead>
                            <tbody>
                                <?php 
                                    $stt = 0;
                                        $sql ="SELECT us.*,ph.* FROM tb_user as us LEFT JOIN tb_phong as ph ON us.Ma_Phong = ph.Ma_Phong ORDER BY Ma_User DESC";
                                        $query = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_object($query)){
                                            $stt++;
                                ?>
                                <tr id="1">
                                    <td style="position: sticky;left:0px;z-index:100" class="text-center bg-white"><?=$stt?></td>
                                    <?php if($log_quyen == 1){?>
                                    <td class="text-center bg-white" style="position: sticky;left:69.7px;z-index:100">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-info btn_tao_mat_khau"><i
                                                    class="fa fa-key"></i></button>
                                            <button type="button" class="btn btn-success btn_sua_nhan_vien"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn_xoa_nhan_vien" onclick="confirm_delete('<?=$row->Ma_User?>','<?=$row->Ten_Dang_Nhap?>')"><i
                                                    class="fa fa-trash"></i></button>

                                            <button type="button" class="btn btn-success btn_cap_nhap_nhan_vien" onclick="func_cap_nhap('<?=$row->Ma_User?>')"
                                                style="display: none;"><i class="fa fa-save"></i></button>
                                            <button type="button" class="btn btn-danger btn_huy_nhan_vien"
                                                style="display: none;"><i class="fa fa-close"></i></button>
                                            <button type="button" class="btn btn-success btn_cap_nhap_mat_khau"
                                                onclick="func_tao_mat_khau('<?=$row->Ma_User?>')"
                                                style="display: none;"><i class="fa fa-save"></i></button>
                                            <button type="button" class="btn btn-danger btn_huy_mat_khau"
                                                style="display: none;"><i class="fa fa-close"></i></button>
                                        </div>
                                    </td>
                                    <?php }?>
                                    <td class="bg-white">
                                        <span class="sua_nhan_vien_span ho_ten"><?=$row->Ho_Ten?></span>
                                        <input type="text" class="form-control sua_input" id="sua_ho_ten<?=$row->Ma_User?>" name="sua_ho_ten<?=$row->Ho_Ten?>"
                                            style="display: none;" value="<?=$row->Ho_Ten?>" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span so_dien_thoai"><?=$row->So_Dien_Thoai?></span>
                                        <input type="text" class="form-control sua_input" id="sua_so_dien_thoai<?=$row->Ma_User?>" name="sua_so_dien_thoai<?=$row->Ma_User?>"
                                            style="display: none;" value="<?=$row->So_Dien_Thoai?>" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span email"><?=$row->Email?></span>
                                        <input type="email" class="form-control sua_input" id="sua_email<?=$row->Ma_User?>" name="sua_email<?=$row->Ma_User?>"
                                            style="display: none;" value="<?=$row->Email?>" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span gioi_tinh"><?=$row->Gioi_Tinh?></span>
                                        <select class="form-control sua_input" id="sua_gioi_tinh<?=$row->Ma_User?>"
                                            style="width: 100%;display:none" required>
                                            <option selected value="">-- Chọn giới tính --</option>
                                            <option <?=($row->Gioi_Tinh=='Nam')? "selected": ''?> value="Nam">Nam
                                            </option>
                                            <option <?=($row->Gioi_Tinh=='Nữ')? "selected": ''?> value="Nữ">Nữ</option>
                                            <option <?=($row->Gioi_Tinh=='Khác')? "selected": ''?> value="Khác">Khác
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span phong"><?=$row->Ten_Phong?></span>
                                        <select class="form-control sua_input" id="sua_phong<?=$row->Ma_User?>"
                                            style="width: 100%;display:none" required>
                                            <option value="">-- Chọn phòng --</option>
                                            <?php
                                            $sql_sua_phong = mysqli_query($conn, "SELECT*FROM tb_phong");
                                            while($row_sua_phong = $sql_sua_phong ->fetch_object()){
                                            ?>
                                            <option <?=($row->Ma_Phong == $row_sua_phong->Ma_Phong)? "selected": ''?>
                                                value="<?=$row_sua_phong->Ma_Phong?>"><?=$row_sua_phong->Ten_Phong?>
                                            </option>
                                            <?php }?>
                                        </select>
                                    </td>
                                    <?php if($log_quyen == 1){?>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_ten_dang_nhap" id="sua_ten_dang_nhap<?=$row->Ma_User?>"
                                            class="form-control" value="<?=$row->Ten_Dang_Nhap?>" disabled>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="password" name="sua_mat_khau" id="sua_mat_khau<?=$row->Ma_User?>"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="password" name="sua_xac_nhan_mat_khau" id="sua_xac_nhan_mat_khau<?=$row->Ma_User?>"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <?php }?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =======  Data-Table  = End  ===================== -->
<script>
$(document).ready(function() {

    var table = $('#tb_quan_ly_nhan_vien').DataTable({
        orderCellsTop: true,
        lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "ALL"]
            ],
        scrollX: true,
        "language": {
            "search": "Tìm kiếm_INPUT_"
        },
        "oLanguage": {
                "sLengthMenu": "Hiện thị _MENU_",
                "sZeroRecords": "Không có dữ liệu",
                "sInfo": "Hiện thị _START_ Đến _END_ Trong tất cả _TOTAL_ Nhân viên",
                "sInfoEmpty": "Hiện thị 0 Đến 0 Của 0",
                "sInfoFiltered": "(Trong tất cả _MAX_ Nhân viên)",
                "oPaginate": {
                    "sFirst": "Trang đầu",
                    "sLast": "Trang cuối",
                    "sNext": "Tiếp",
                    "sPrevious": "Trước"
                }
            },
        
    });
    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

});
</script>
<!-- <script>
    var btn_them_nhan_vien = document.getElementById('btn_them_nhan_vien');
    var tr_them_nhan_vien = document.getElementById('tr_them_nhan_vien');
    btn_them_nhan_vien.addEventListener('click', function(e){
        e.preventDefault();
        tr_them_nhan_vien.style.display = "block"

    })
</script> -->

<script>
$(document).ready(function() {
    $('#btn_them_nhan_vien').click(function(e) {
        e.preventDefault();
        $('#tr_them_nhan_vien').attr('hidden', false);
    });
    $('#btn_huy_them_nhan_vien').click(function(e) {
        e.preventDefault();
        $('#tr_them_nhan_vien').attr('hidden', true);
    });
    $('.btn_sua_nhan_vien').click(function(e) {
        e.preventDefault();
        var id = $(this).closest("tr").attr('id');
        $(this).hide();
        $(this).closest("tr").find(".sua_nhan_vien_span").hide();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").hide();
        $(this).closest("tr").find(".btn_tao_mat_khau").hide();

        $(this).closest("tr").find(".sua_input").show();
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").show();
        $(this).closest("tr").find(".btn_huy_nhan_vien").show();
    });
    $('.btn_huy_nhan_vien').click(function(e) {
        e.preventDefault();
        $(this).hide();
        var th_mat_khau = document.getElementById('th_mat_khau').innerText = "Mật khẩu";
        $(this).closest("tr").find(".sua_nhan_vien_span").show();
        $(this).closest("tr").find(".btn_sua_nhan_vien").show();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").show();
        $(this).closest("tr").find(".btn_tao_mat_khau").show();
        $(this).closest("tr").find(".sua_input").hide();
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").hide();
        $(this).closest("tr").find(".input_sua_").attr('disabled', true);
    });
    $('.btn_tao_mat_khau').click(function(e) {
        e.preventDefault();
        $(this).hide();
        var id = $(this).closest("tr").attr('id');
        var th_mat_khau = document.getElementById('th_mat_khau').innerText = "Mật khẩu mới";
        $(this).closest("tr").find(".input_sua_").attr('disabled', false);
        $(this).closest("tr").find(".btn_cap_nhap_mat_khau").show();
        $(this).closest("tr").find(".btn_huy_mat_khau").show();
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").hide();
        $(this).closest("tr").find(".btn_huy_nhan_vien").hide();

        $(this).closest("tr").find(".btn_sua_nhan_vien").hide();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").hide();
        $(this).closest("tr").find(".btn_tao_mat_khau").hide();
        // alert(id);
    });
    $('.btn_huy_mat_khau').click(function(e) {
        e.preventDefault();
        $(this).hide();
        var th_mat_khau = document.getElementById('th_mat_khau').innerText = "Mật khẩu";
        $(this).closest("tr").find(".sua_nhan_vien_span").show();
        $(this).closest("tr").find(".btn_sua_nhan_vien").show();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").show();
        $(this).closest("tr").find(".btn_tao_mat_khau").show();
        $(this).closest("tr").find(".sua_input").hide();
        $(this).closest("tr").find(".btn_cap_nhap_mat_khau").hide();
        // $(this).closest("tr").find(".btn_huy_mat_khau").hide();
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").hide();
        $(this).closest("tr").find(".input_sua_").attr('disabled', true);
    });
})
</script>
<script>
function func_them_nhan_vien() {
   
    var ho_ten = document.querySelector('#ho_ten').value
    var so_dien_thoai = document.querySelector('#so_dien_thoai').value
    var email = document.querySelector('#email').value
    var gioi_tinh = document.querySelector('#gioi_tinh').value
    var ma_phong = document.querySelector('#phong').value
    var ten_dang_nhap = document.querySelector('#ten_dang_nhap').value
    var mat_khau = document.querySelector('#mat_khau').value
    var xac_nhan_mat_khau = document.querySelector('#xac_nhan_mat_khau').value
    // alert(xac_nhan_mat_khau);
    if (ho_ten != "" && so_dien_thoai != "" && email != "" && gioi_tinh != "" && ma_phong != "" &&
        ten_dang_nhap != "" && mat_khau != "" && xac_nhan_mat_khau != "" && mat_khau ==
        xac_nhan_mat_khau) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend/them_nhan_vien.php', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var x = '';
                if (xhr.response) {
                    x = xhr.response;
                }
                if (x.status == 1) {
                    swal_succ(x.msg);
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500)
                } else {
                    swal_err(x.msg);
                }
            }
        }
        const mydata = {
            'ho_ten': ho_ten,
            'so_dien_thoai': so_dien_thoai,
            'gioi_tinh': gioi_tinh,
            'email': email,
            'ma_phong': ma_phong,
            'ten_dang_nhap': ten_dang_nhap,
            'mat_khau': mat_khau,
            'xac_nhan_mat_khau': xac_nhan_mat_khau
        }
        const data = JSON.stringify(mydata);
        console.log(data)
        xhr.send(data)
    } else {
        if (ho_ten == '') {
            swal_err('Thêm nhân viên không thành công', 'Họ tên không thể để trống');
        } else if (so_dien_thoai == '') {
            swal_err('Thêm nhân viên không thành công', 'Số điện thoại không thể để trống');
        } else if (email == '') {
            swal_err('Thêm nhân viên không thành công', 'Email không thể để trống');
        } else if (gioi_tinh == '') {
            swal_err('Thêm nhân viên không thành công', 'Giới tính không thể để trống');
        } else if (ma_phong == '') {
            swal_err('Thêm nhân viên không thành công', 'Phòng không thể để trống');
        } else if (ten_dang_nhap == '') {
            swal_err('Thêm nhân viên không thành công', 'Tên đăng nhập không thể để trống');
        } else if (mat_khau == '') {
            swal_err('Thêm nhân viên không thành công', 'Mật khẩu không thể để trống');
        } else if (xac_nhan_mat_khau == '') {
            swal_err('Thêm nhân viên không thành công', 'Xác nhận mật khẩu không thể để trống');
        } else if (mat_khau != xac_nhan_mat_khau) {
            swal_err('Thêm nhân viên không thành công', 'Xác nhận mật khẩu không đúng');
        }
    }
};
</script>
<script>
function confirm_delete(ma_user, ten_user) {
    swal.fire({
        title: '<h5 style="font-weight: bolder;"> Bạn chắc chắn Xóa nhân viên này không?</h5>',
        html: "<div>" + ten_user + "</div>",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#e9aa17",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function(result) {
        if (result.value) {
            func_xoa(ma_user)
        }
    });
}
function func_xoa(ma_user) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/xoa_nhan_vien.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.responseType = "json";
    xhr.onload = () => {
        if (xhr.status === 200) {
            var x = xhr.response;
            if (xhr.response) {
                x = xhr.response
            } else {
                x = "";
            }
            if (x.status == 1) {
                swal_succ(x.msg)
                window.setTimeout(function() {
                    location.reload();
                }, 1500)
            } else {
                swal_err(x.msg)
            }
        } else {
            swal_err('Xóa nhân viên không thành công', '')
        }
    }
    const mydata = {
        ma_user: ma_user
    };
    const data = JSON.stringify(mydata);
    xhr.send(data);
}
</script>

<script>
function func_cap_nhap(ma_user) {
    var sua_ho_ten = document.querySelector('#sua_ho_ten' + ma_user).value
    var sua_so_dien_thoai = document.querySelector('#sua_so_dien_thoai' + ma_user).value
    var sua_email = document.querySelector('#sua_email' + ma_user).value
    var sua_gioi_tinh = document.querySelector('#sua_gioi_tinh' + ma_user).value
    var sua_ma_phong = document.querySelector('#sua_phong' + ma_user).value
    // alert(sua_ma_phong)
    if (sua_ho_ten != "" && sua_so_dien_thoai != "" && sua_email != "" && sua_gioi_tinh != "" && sua_ma_phong != "") {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend/sua_nhan_vien.php', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var x = '';
                if (xhr.response) {
                    x = xhr.response;
                }
                if (x.status == 1) {
                    swal_succ(x.msg);
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500)
                } else {
                    swal_err(x.msg);
                }
            }
        }
        const mydata = {
            'ma_user': ma_user,
            'ho_ten': sua_ho_ten,
            'so_dien_thoai': sua_so_dien_thoai,
            'gioi_tinh': sua_gioi_tinh,
            'email': sua_email,
            'ma_phong': sua_ma_phong,
        }
        const data = JSON.stringify(mydata);
        xhr.send(data)
    } else {
        if (sua_ho_ten == '') {
            swal_err('Sửa nhân viên không thành công', 'Họ tên không thể để trống');
        } else if (sua_so_dien_thoai == '') {
            swal_err('Sửa nhân viên không thành công', 'Số điện thoại không thể để trống');
        } else if (sua_email == '') {
            swal_err('Sửa nhân viên không thành công', 'Email không thể để trống');
        } else if (sua_gioi_tinh == '') {
            swal_err('Sửa nhân viên không thành công', 'Giới tính không thể để trống');
        } else if (sua_phong == '') {
            swal_err('Sửa nhân viên không thành công', 'Phòng không thể để trống');
        }
    }
}
</script>
<script>
function func_tao_mat_khau(ma_user) {
    // var sua_ten_dang_nhap = document.querySelector('#sua_ten_dang_nhap' + ma_user).value
    var sua_mat_khau = document.querySelector('#sua_mat_khau' + ma_user).value
    var sua_xac_nhan_mat_khau = document.querySelector('#sua_xac_nhan_mat_khau' + ma_user).value
    // alert(sua_xac_nhan_mat_khau);
    if (sua_mat_khau != "" && sua_xac_nhan_mat_khau != "" && sua_mat_khau ==
        sua_xac_nhan_mat_khau) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend/thay_doi_mat_khau.php', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var x = '';
                if (xhr.response) {
                    x = xhr.response;
                }
                if (x.status == 1) {
                    swal_succ(x.msg);
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500)
                } else {
                    swal_err(x.title, x.msg);

                }
            }
        }
        const mydata = {
            'ma_user': ma_user,
            // 'ten_dang_nhap': sua_ten_dang_nhap,
            'mat_khau': sua_mat_khau,
            'xac_nhan_mat_khau': sua_xac_nhan_mat_khau
        }
        const data = JSON.stringify(mydata);
        xhr.send(data)
    } else {
        if (sua_mat_khau == '') {
            swal_err('Thay đổi mật khẩu không thành công', 'Mật khẩu không thể để trống');
        } else if (sua_xac_nhan_mat_khau == '') {
            swal_err('Thay đổi mật khẩu không thành công', 'Xác nhận mật khẩu không thể để trống');
        } else if (sua_mat_khau != xac_nhan_mat_khau) {
            swal_err('Thay đổi mật khẩu không thành công', 'Xác nhận mật khẩu không đúng');
        }
    }
}
</script>
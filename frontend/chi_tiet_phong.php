<?php
if (isset($_GET['list'])) {
    if ($_GET['list'] == 1) {
        $active = "bg-primary";
        $col = "12";
    } else {
        $active = "bg-primary";
        $col = "6";
    }
} else {
    $active = "bg-primary";
    $col = "12";
}
?>
<section class="p-2">
    <div class="card">
        <div>
            <div class="col-md-12 p-3">
                <div id="div_btn_them_thu_muc" class="p-0">
                    <div class="d-flex justify-content-start align-content-center justify-content-between">
                        <img src="assets/image/add_folder.png" alt="" width="35" id="btn_them_thu_muc" title="Thêm Thư mục mới">
                        <div>
                            <a href="?page=chi_tiet_phong&list=1" class="btn btn-sm btn-light <?= ($_GET['list'] == '1') ? "$active" : '' ?>"><i class="fa fa-list"></i></a>
                            <a href="?page=chi_tiet_phong&list=2" class="btn btn-sm btn-light <?= ($_GET['list'] == '2') ? "$active" : '' ?>"><i class="fa fa-border-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="div_them_thu_muc" style="display: none;">
                    <div class="btn-group w-100" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn border border-success p-0" style="width: 60%;"><input type="text" class="form-control rounded-0" placeholder="Nhập tên thư mục" id="ten_thu_muc"></button>
                        <button type="button" class="btn border border-success p-0" style="width: 30%;">
                            <select class="form-select border-0" aria-label="Default select example">
                                <option selected value=''>-- Chọn quyền --</option>
                                <option value="1">Mọi người</option>
                                <option value="2">Cá nhân</option>
                            </select>
                        </button>
                        <button type="button" class="btn btn-success" id="btn_luu_them_thu_muc" style="width: 5%;"><i class="fa fa-save text-white" style="width:50%;font-size: 20px"></i></button>
                        <button type="button" class="btn btn-danger" id="btn_huy_them_thu_muc" style="width: 5%;"><i class="fa fa-close text-white" style="width: 100%;font-size: 20px"></i></button>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="p-3">
                <div class="row">
                    <div class="col-md-<?= $col ?> d-flex align-items-center justify-content-sm-between ">
                        <div class="d-flex align-items-center" style="width: 100%;cursor:pointer" onclick="window.location.href='?page=chi_tiet_thu_muc&thu_muc=1'">
                            <div>
                                <img src="assets/image/folder_icon.png" alt="" width="40">
                            </div>
                            <div class="" style="width:100%"><span id="txt_ten_thu_muc">Quản lý đồ án sinh viên (2023-2024)</span><input type="text" class="form-control" id="input_ten_thu_muc" style="display: none;" value=""></div>
                        </div>
                        <div class="text-end" id="div_sua_xoa" style="width: 20%;">
                            <button class="btn btn-sm border rounded p-2 " id="btn_sua_thu_muc" data-id='1'><i class="fa fa-edit text-primary"></i></button>
                            <button class="btn btn-sm border rounded p-2 " id="btn_xoa_thu_muc"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                        <div id="div_cap_nha_huy" class="text-end" style="display: none;width: 20%;">
                            <button class="btn btn-sm border rounded p-2 " id="btn_cap_nhap_thu_muc"><i class="fa fa-save text-primary"></i></button>
                            <button class="btn btn-sm border rounded p-2 " id="btn_huy_sua_thu_muc"><i class="fa fa-close text-danger"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var div_btn_them_thu_muc = document.querySelector('#div_btn_them_thu_muc')
    var btn_them_thu_muc = document.querySelector('#btn_them_thu_muc')
    var div_them_thu_muc = document.querySelector('#div_them_thu_muc')
    var btn_luu_them_thu_muc = document.querySelector('#btn_luu_them_thu_muc')
    var btn_huy_them_thu_muc = document.querySelector('#btn_huy_them_thu_muc')
    btn_them_thu_muc.addEventListener('click', function(e) {
        e.preventDefault();
        div_them_thu_muc.style.display = "block";
        div_btn_them_thu_muc.style.display = "none"
    })
    btn_huy_them_thu_muc.addEventListener('click', function(e) {
        e.preventDefault();
        div_them_thu_muc.style.display = "none";
        div_btn_them_thu_muc.style.display = "block"
        ten_thu_muc.value = ''
    })
    btn_luu_them_thu_muc.addEventListener('click', function(e) {
        e.preventDefault();
        var ten_thu_muc = document.querySelector('#ten_thu_muc').value;
        alert(ten_thu_muc)
    })
</script>
<script>
    var btn_sua_thu_muc = document.querySelector('#btn_sua_thu_muc')
    var btn_xoa_thu_muc = document.querySelector('#btn_xoa_thu_muc')
    var btn_cap_nhap_thu_muc = document.querySelector('#btn_cap_nhap_thu_muc')
    var btn_huy_sua_thu_muc = document.querySelector('#btn_huy_sua_thu_muc')
    var txt_ten_thu_muc = document.querySelector('#txt_ten_thu_muc')
    var input_ten_thu_muc = document.querySelector('#input_ten_thu_muc')

    var div_cap_nha_huy = document.querySelector('#div_cap_nha_huy')
    var div_sua_xoa = document.querySelector('#div_sua_xoa')

    btn_sua_thu_muc.addEventListener('click', function(e) {
        e.preventDefault();
        let dataId = $(this).attr("data-id");
        div_sua_xoa.style.display = "none"
        txt_ten_thu_muc.style.display = "none"
        div_cap_nha_huy.style.display = "block"
        input_ten_thu_muc.style.display = "block"
        var input_ten_thu_muc_value = document.querySelector('#input_ten_thu_muc').value;
    })
    btn_huy_sua_thu_muc.addEventListener('click', function() {
        div_sua_xoa.style.display = "block"
        txt_ten_thu_muc.style.display = "block"
        div_cap_nha_huy.style.display = "none"
        input_ten_thu_muc.style.display = "none"
    })
</script>
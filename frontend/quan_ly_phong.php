<section class="p-2">
    <div class="card">
        <div>
            <div class="col-md-12 p-3">
                <?php if($log_quyen == 1) {?>
                <div id="div_btn_them_phong">
                    <span class="btn btn-primary" id="btn_them_phong"><i class="fa fa-add"></i> Thêm phòng</span>
                </div>
                <?php }?>
                <div class="col-md-12" id="div_them_phong" style="display: none;">
                    <div class="btn-group w-100" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn border border-success p-0" style="width: 90%;"><input
                                type="text" class="form-control rounded-0" placeholder="Nhập tên phòng"
                                id="ten_phong"></button>
                        <button type="button" class="btn btn-success" id="btn_luu_them_phong" style="width: 5%;"><i
                                class="fa fa-save text-white" style="width:50%;font-size: 20px"></i></button>
                        <button type="button" class="btn btn-danger" id="btn_huy_them_phong" style="width: 5%;"><i
                                class="fa fa-close text-white" style="width: 100%;font-size: 20px"></i></button>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="p-3">
                <div class="row">
                    <?php 
                    $arr = [];
                    $sql ="SELECT * FROM tb_phong";
                    $query = mysqli_query($conn, $sql);
                    if($query->num_rows > 0){
                        while($row = mysqli_fetch_object($query)){
                            $arr =$row->Ma_Phong; 
                    ?>
                    <div class="col-md-6 mb-2">
                        <div class="p-2 alert-success">
                            <div class="btn-group w-100" role="group" aria-label="Basic mixed styles example">
                                <button type="button"
                                    onclick="window.location.href='?page=chi_tiet_phong&phong=<?=$row->Ma_Phong?>&list=1'"
                                    class="btn border border-white p-2 text-start ps-2 btn_ten_phong<?=$row->Ma_Phong?>"
                                    style="width: 100%;"><?=$row->Ten_Phong?></button>
                                <?php if($log_quyen == 1) {?>
                                <button type="button" class="btn border p-0 btn_sua_phong<?=$row->Ma_Phong?>"
                                    style="width: 100%;display: none;"><input type="text" class="form-control"
                                        id="input_sua<?=$row->Ma_Phong?>" value="<?=$row->Ten_Phong?>"
                                        required></button>
                                <button type="button" class="btn btn-info btn_sua<?=$row->Ma_Phong?>"
                                    onclick="event.preventDefault();fuc_sua_phong('<?=$row->Ma_Phong?>')"><i
                                        class="fa fa-edit text-white" style="width: 100%;font-size: 20px"></i></button>
                                <button type="button" class="btn btn-danger btn_xoa<?=$row->Ma_Phong?>"
                                    onclick="event.preventDefault();fuc_xoa_phong('<?=$row->Ma_Phong?>')"><i
                                        class="fa fa-trash text-white" style="width: 100%;font-size: 20px"></i></button>
                                <button type="button" class="btn btn-success saveBtn<?=$row->Ma_Phong?>"
                                    onclick="event.preventDefault();fuc_save_phong('<?=$row->Ma_Phong?>')"
                                    style="display: none;"><i class="fa fa-save text-white"
                                        style="width: 100%;font-size: 20px"></i></button>
                                <button type="button" class="btn btn-danger cancelBtn<?=$row->Ma_Phong?>"
                                    onclick="event.preventDefault();fuc_cencel_phong('<?=$row->Ma_Phong?>')"
                                    style="display: none;"><i class="fa fa-close text-white"
                                        style="width: 100%;font-size: 20px"></i></button>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <?php } } else {?>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="card p-3 text-center">
                            <h3 class="text-danger">Không có dữ liệu</h3>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
var div_btn_them_phong = document.querySelector('#div_btn_them_phong')
var btn_them_phong = document.querySelector('#btn_them_phong')
var div_them_phong = document.querySelector('#div_them_phong')
var btn_luu_them_phong = document.querySelector('#btn_luu_them_phong')
var btn_huy_them_phong = document.querySelector('#btn_huy_them_phong')
btn_them_phong.addEventListener('click', function(e) {
    e.preventDefault();
    div_them_phong.style.display = "block";
    div_btn_them_phong.style.display = "none"
})
btn_huy_them_phong.addEventListener('click', function(e) {
    e.preventDefault();
    div_them_phong.style.display = "none";
    div_btn_them_phong.style.display = "block"
    ten_phong.value = ''
})
btn_luu_them_phong.addEventListener('click', function(e) {
    e.preventDefault();
    var ten_phong = document.querySelector('#ten_phong').value;
    if (ten_phong != '') {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/them_phong_data.php", true);
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
                if (x.status == 1) {
                    swal_succ(x.msg)
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500)
                } else {
                    swal_err(x.title, x.msg)
                }
            } else {
                swal_err('Thêm phòng không thành công', '')
            }
        }
        const mydata = {
            ten_phong: ten_phong
        };
        // console.log(mydata);
        const data = JSON.stringify(mydata);
        //console.log(data);
        xhr.send(data);
    } else {
        swal_err('Thêm phòng không thành công', 'Tên phòng không thể để trống')
    }
})
</script>
<script>
function fuc_sua_phong(id) {
    var btn_sua = document.querySelector('.btn_sua' + id)
    var btn_xoa = document.querySelector('.btn_xoa' + id)
    var btn_sua_phong = document.querySelector('.btn_sua_phong' + id)
    var btn_ten_phong = document.querySelector('.btn_ten_phong' + id)
    var saveBtn = document.querySelector('.saveBtn' + id)
    var cancelBtn = document.querySelector('.cancelBtn' + id);
    btn_sua.style.display = "none"
    btn_xoa.style.display = "none"
    btn_ten_phong.style.display = "none"

    btn_sua_phong.style.display = "block"
    saveBtn.style.display = "block"
    cancelBtn.style.display = "block"
}

function fuc_cencel_phong(id) {
    var btn_sua = document.querySelector('.btn_sua' + id)
    var btn_xoa = document.querySelector('.btn_xoa' + id)
    var btn_sua_phong = document.querySelector('.btn_sua_phong' + id)
    var btn_ten_phong = document.querySelector('.btn_ten_phong' + id)
    var saveBtn = document.querySelector('.saveBtn' + id)
    var cancelBtn = document.querySelector('.cancelBtn' + id);


    btn_sua.style.display = "block"
    btn_xoa.style.display = "block"
    btn_ten_phong.style.display = "block"

    btn_sua_phong.style.display = "none"
    saveBtn.style.display = "none"
    cancelBtn.style.display = "none"
}

function fuc_save_phong(id) {
    var input_sua = document.querySelector('#input_sua' + id).value;
    var id = id;
    if (input_sua != '') {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/sua_phong_data.php", true);
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
                if (x.status == 1) {
                    swal_succ(x.msg)
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500)
                } else {
                    swal_err(x.title, x.msg)
                }
            } else {
                swal_err('Sửa phòng không thành công', 'Chưa có phòng này trong hệ thống')
            }
        }
        const mydata = {
            input_sua: input_sua,
            ma_phong: id
        };
        // console.log(mydata);
        const data = JSON.stringify(mydata);
        console.log(data);
        xhr.send(data);
    } else {
        swal_err('Sửa phòng không thành công', 'Tên phòng không thể để trống')
    }
}

function fuc_xoa_phong(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/xoa_phong_data.php", true);
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
            if (x.status == 1) {
                swal_succ(x.msg)
                window.setTimeout(function() {
                    location.reload();
                }, 1500)
            } else {
                swal_err(x.title, x.msg)
            }
        } else {
            swal_err('Xóa phòng không thành công', 'Chưa có phòng này trong hệ thống')
        }
    }
    const mydata = {
        ma_phong: id
    };
    // console.log(mydata);
    const data = JSON.stringify(mydata);
    console.log(data);
    xhr.send(data);
}
</script>
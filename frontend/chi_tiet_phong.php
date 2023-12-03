<style>
.cd_popup {
    border: none;
    padding: 4px;
}

.cd_popup li {
    list-style: none;
    padding: 5px;
}

.popup {
    display: none;
    position: absolute;
    left: 4rem;
    top: 20px;
    width: 200px;
    padding: 10px;
    z-index: 1000
}

.popup .hover:hover {
    background-color: #eee;
}

.close_popup {
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    position: absolute;
    right: -4px;
    top: -4px;
    background-color: red;
    color: white;
    padding: 6px;
}

.btn_hide {
    display: none;
}
</style>

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
<?php 
$ma_phong = $_GET['phong'];
?>
<section class="p-2 click" oncontextmenu="event.preventDefault()" style="min-height: 100vh;">
    <div class="card">
        <div>
            <div class="col-md-12 p-3">
                <div id="div_btn_them_thu_muc" class="p-0">
                    <div class="d-flex justify-content-start align-content-center justify-content-between">
                        <img src="assets/image/add_folder.png" alt="" width="45" id="btn_them_thu_muc"
                            title="Thêm Thư mục mới"
                            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;padding:4px">
                        <div>
                            <a href="?page=chi_tiet_phong&phong=<?=$ma_phong?>&list=1"
                                class="btn btn-sm btn-light <?= ($_GET['list'] == '1') ? "$active" : '' ?>"><i
                                    class="fa fa-list"></i></a>
                            <a href="?page=chi_tiet_phong&phong=<?=$ma_phong?>&list=2"
                                class="btn btn-sm btn-light <?= ($_GET['list'] == '2') ? "$active" : '' ?>"><i
                                    class="fa fa-border-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="div_them_thu_muc" style="display: none;">
                    <div class="btn-group w-100" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn p-0" style="width: 90%;"><input type="text"
                                class="form-control rounded-0" placeholder="Nhập tên thư mục" id="ten_thu_muc"></button>
                        <button type="button" class="border " id="btn_luu_them_thu_muc"
                            onclick="func_them_thu_muc('<?=$ma_phong?>')" style="width: 5%;"><i
                                class="fa fa-save text-success" style="width:50%;font-size: 20px"></i></button>
                        <button type="button" class="border text-danger" id="btn_huy_them_thu_muc" style="width: 5%;"><i
                                class="fa fa-close text-danger" style="width: 100%;font-size: 20px"></i></button>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="p-3">
                <div class="row">
                    <?php
                $sql= mysqli_query($conn, "SELECT*FROM tb_thu_muc where Ma_Phong = $ma_phong ORDER BY Ma_Thu_Muc DESC");
                if($sql->num_rows >0){
                    while($row= $sql->fetch_object()){?>
                    <div class="col-md-<?= $col ?> d-flex align-items-center justify-content-sm-between ">
                        <div id="show_rename<?=$row->Ma_Thu_Muc?>">
                            <div class="d-flex align-items-center" style="width: 100%;cursor:pointer;position:relative"
                                onclick="mouseclick(this, event,'<?=$row->Ma_Thu_Muc?>')"
                                oncontextmenu="mouseclick(this, event,'<?=$row->Ma_Thu_Muc?>')">
                                <div>
                                    <img src="assets/image/folder_icon.png" alt="" width="40">
                                </div>
                                <div class="" style="width:100%"><span
                                        id="txt_ten_thu_muc"><?=$row->Ten_Thu_Muc?></span><input type="text"
                                        class="form-control" id="input_ten_thu_muc" style="display: none;"
                                        value="<?=$row->Ten_Thu_Muc?>">
                                </div>
                                <div class="popup" id="popup_act<?=$row->Ma_Thu_Muc?>">
                                    <div class="card bg-warning cd_popup">
                                        <li class="w-100 mb-3" style="position: relative;">
                                            <i class="fa fa-close close_popup"
                                                onclick="event.stopPropagation();close_popup('<?=$row->Ma_Thu_Muc?>')"></i>
                                            <i class="fas fa-caret-up text-warning"
                                                style="position: absolute;left:4px; top:-16px;font-size: 30px"></i>
                                        </li>
                                        <li onclick="event.stopPropagation();close_popup('<?=$row->Ma_Thu_Muc?>');mouseclick(this, event,'<?=$row->Ma_Thu_Muc?>')"
                                            class="hover"><span><i class="fa fa-folder"></i>&nbsp;Mở</span></li>
                                        <li onclick="event.stopPropagation();close_popup('<?=$row->Ma_Thu_Muc?>');func_thay_doi_ten('<?=$row->Ma_Thu_Muc?>')"
                                            class="hover"><span><i class="fa fa-edit text-primary"></i>&nbsp;Thay đổi
                                                tên</span></li>
                                        <li onclick="event.stopPropagation();close_popup('<?=$row->Ma_Thu_Muc?>');confirm_delete('<?=$row->Ma_Thu_Muc?>', '<?=$row->Ten_Thu_Muc?>')"
                                            class="hover"><span><i class="fa fa-trash text-danger"></i>&nbsp;Xoa</span>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: none;width:100%;" id="rename<?=$row->Ma_Thu_Muc?>">
                            <div class="d-flex align-items-center" style="width: 100%;cursor:pointer;">
                                <div>
                                    <img src="assets/image/folder_icon.png" alt="" width="40">
                                </div>
                                <div class="" style="width:50%">
                                    <input type="text" class="form-control p-0 rounded-0 " id="input_ten_thu_muc"
                                        value="<?=$row->Ten_Thu_Muc?>">
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php } } else {?>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 card p-5 text-center alert-danger">Không có dữ liệu</div>
                        <div class="col-md-4"></div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal_thay_doi_ten" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal_thay_doi_tenLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal_thay_doi_tenLabel">Thay đổi tên thư mục</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form_sua_ten_thu_muc">
                    <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%;">
                        <input type="hidden" name="ma_phong" id="ma_phong" value="<?=$ma_phong?>">
                        <input type="hidden" class="form-control" name="ma_sua_thu_muc" id="ma_sua_thu_muc">
                        <button type="button" class="btn border p-0"><input type="text" class="form-control border-0"
                                name="txt_ten_thu_muc_moi" id="txt_ten_thu_muc_moi" placeholder="Nhập tên mới"
                                required></button>
                        <button type="button" onclick="func_sua_thu_muc()" class="btn border text-success btn_hide"
                            title="Lưu"><i class="fa fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
function func_them_thu_muc(ma_phong) {
    var ten_thu_muc = document.getElementById('ten_thu_muc').value
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'backend/them_thu_muc.php', true);
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
        'ma_phong': ma_phong,
        'ten_thu_muc': ten_thu_muc

    }
    const data = JSON.stringify(mydata);
    xhr.send(data)
}
</script>
<script type="text/javascript">
function mouseclick(ele, e, id) {
    if (e.type == 'click') {
        window.open('?page=chi_tiet_thu_muc&thu_muc=' + id, '_blank');
    }
    if (e.type == 'contextmenu') {
        document.getElementById('popup_act' + id).style.display = "block"
    }
}
</script>
<script>
    // dùng khi thay đoiir tên thư múc nhưng mà lại không thay đổi và tắt modal sua ten thư múc để reset input thành null
    document.querySelector('.btn-close').addEventListener('click', function(){
        document.getElementById('form_sua_ten_thu_muc').reset();
    });
    // dùng khi 
function close_popup(id) {
    document.getElementById('popup_act' + id).style.display = "none"
}
function func_thay_doi_ten(id) {
    $('#modal_thay_doi_ten').modal('show');
    $('#ma_sua_thu_muc').val(id)
    $('#txt_ten_thu_muc_moi').keyup(function() {
        if ($(this).val() != '') {
            $('.btn_hide').show();
        } else {
            $('.btn_hide').hide()
        }

    })

}
</script>
<script>
function func_sua_thu_muc() {
    var ma_phong = document.getElementById('ma_phong').value;
    var ma_thu_muc = document.getElementById('ma_sua_thu_muc').value;
    var txt_ten_thu_muc_moi = document.getElementById('txt_ten_thu_muc_moi').value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/sua_thu_muc.php", true);
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
                swal_err(x.title,x.msg)
            }
        } else {
            swal_err('Xóa Thư mục không thành công11', '')
        }
    }
    const mydata = {
        'ma_phong':ma_phong,
        'ma_thu_muc': ma_thu_muc,
        'ten_thu_muc':txt_ten_thu_muc_moi
    };
    const data = JSON.stringify(mydata);
    console.log(data)
    xhr.send(data);
}
</script>
<script>
function confirm_delete(id, ten_thu_muc) {
    swal.fire({
        title: '<h5 style="font-weight: bolder;"> Bạn chắc chắn Xóa tệp tin này không?</h5>',
        html: "<div>" + ten_thu_muc + "</div>",
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
            func_xoa_thu_muc(id)
        }
    });

    function func_xoa_thu_muc(id) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/xoa_thu_muc.php", true);
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
                    swal_err(x.title,x.msg)
                }
            } else {
                swal_err('Xóa Thư mục không thành công', '')
            }
        }
        const mydata = {
            ma_thu_muc: id
        };
        const data = JSON.stringify(mydata);
        xhr.send(data);
    }
}
</script>
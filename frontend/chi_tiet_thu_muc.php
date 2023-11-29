<style>
tr {
    cursor: pointer;
}

.i_act {
    position: relative;
    cursor: pointer;
}

.ul_act {
    display: none;
    position: absolute;
    right: 2rem;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .13), 0 1px 1px 0 rgba(0, 0, 0, .11);
    z-index: 100;
}

.ul_act li {
    list-style: none;
    font-size: small;
    padding: 5px;
}

.ul_act li:hover {
    background-color: white;
}

.ul_act li a {
    text-decoration: none;
    color: dimgray
}

.close_top {
    position: absolute;
    top: 0;
    right: 0;


}

.close_top i {
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
}

.close_top i:hover {
    color: red;
    cursor: pointer;
}

.circle {
    background: red;
    border-radius: 100%;
    font-size: small;
    display: flex;
    width: 20px;
    height: 20px;
    justify-content: center;
    align-items: center;
    position: absolute;
    right: 0;
    top: -15px
}
</style>
<?php
    $ma_user = $_SESSION['ma_user'];
    $ma_thu_muc = $_GET['thu_muc'];

    $sql_recycle = mysqli_query($conn , "SELECT COUNT(tti.Ma_Tep_Tin) as tong_xoa FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE tti.Ma_Thu_Muc = $ma_thu_muc AND tti.Trang_Thai = '0' AND tti.Nguoi_Xoa = $ma_user");
    $result = $sql_recycle->fetch_object();
    $tong_xoa = $result->tong_xoa;
    if($tong_xoa > 0){
        $alert_ = "<span class='alert-primary circle'>".$tong_xoa."</span>";
    } else {
        $alert_ = "";
    }
?>
<section class="p-2">
    <div class="card">
        <div>
            <div class="p-3" id="div_btn_them_tep_tin">
                <form action="#">
                    <input type="hidden" id="ma_thu_muc" value="<?=$_GET['thu_muc']?>">
                    <div class="alert-success rounded d-flex" style="width: 10%;position:relative">
                        <img src="assets/image/add_file.png" alt="" width="45" id="btn_them_tep_tin"
                            style="border: 2px dashed #6990F2;border-radius: 5px;padding:5px;width:50%"
                            title="Upload file">
                        <input class="file-input" type="file" name="file" hidden>
                        <img src="assets/image/recycle.png" alt="" style="color:#6990F2;width:50px;height:50px"
                            data-bs-toggle="modal" data-bs-target="#modal_recycle">
                        
                        <div class="tong_xoa"><?=$alert_?></div>
                    </div>
                </form>
                <div>
                </div>
            </div>
            <hr class="m-0">
            <div class="p-3">
                <div class="row">
                    <div class="data_table">
                        <table id="tb_quan_ly_nhan_vien" class="table table-striped table-bordered"
                            style="width: 100%;">
                            <thead class="bg-warning">
                                <tr>
                                    <th width="5%" class="text-center">STT</th>
                                    <th width="70%">Tên tài liệu</th>
                                    <!-- <th width="15%">Người tải lên</th> -->
                                    <th width="20%">Ngày tải lên</th>
                                    <th width="5%" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $arr = [];
                                $stt = 0;
                                
                                $sql = mysqli_query($conn , "SELECT tti.*,us.Ho_Ten,us.Ten_Dang_Nhap FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE Ma_Thu_Muc = $ma_thu_muc AND Trang_Thai = '1'");
                                $exts_pdf = array('pdf'); 
                                $exts_img = array('png','jpg','JPG','jpeg','gif','svg'); 
                                $exts_word = array('docx','doc'); 
                                $exts_excel = array('xlsx','xls'); 
                                $exts_ppt = array('ppt'); 
                                
                                while($row = mysqli_fetch_object($sql)){
                                    $tmp = explode('.', $row->Ten_Tep_Tin);
                                    $file_extension = end($tmp);
                                    if(in_array($file_extension,$exts_pdf)){
                                        $i = "<i class='fa fa-file-pdf text-danger'></i>";
                                    } else if(in_array($file_extension, $exts_img)){
                                        $i = "<i class='fas fa-image text-success'></i>";
                                    } else if(in_array($file_extension, $exts_word)){
                                        $i = "<i class='fas fa-file-word text-primary'></i>";
                                    }else if(in_array($file_extension,$exts_excel)){
                                        $i = "<i class='fas fa-file-excel text-success'></i>";
                                    }else if(in_array($file_extension,$exts_ppt)){
                                        $i = "<i class='fas fa-file-powerpoint text-danger'></i>";
                                    }else {
                                        $i = "<i class='fas fa-file-word'></i>";
                                    }
                                    $stt++;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$stt?></td>
                                    <td><?=$i?> <?=$row->Ten_Tep_Tin?></td>
                                    <!-- <th><?=$row->Ho_Ten?></th> -->
                                    <td><?=$row->Ngay_Tai_Len?></td>
                                    <td class="text-center" id="i_act">

                                        <i class="fa fa-ellipsis" onclick="func_show_act('<?=$row->Ma_Tep_Tin?>')"></i>
                                        <ul class="bg-warning p-2 rounded text-start ul_act"
                                            id="ul_act<?=$row->Ma_Tep_Tin?>">

                                            <li><i class="fa fa-download text-primary"></i> <a
                                                    href="./files/<?=trim($row->Ten_Tep_Tin)?>" target="_blank"
                                                    onclick="func_cencel('<?=$row->Ma_Tep_Tin?>')">Tải xuống</a></li>
                                            <li><i class="fa fa-trash text-danger"></i> <a href="javascript:void(0)"
                                                    onclick="confirm_delete('<?=$row->Ma_Tep_Tin?>','<?=$row->Ten_Tep_Tin?>');func_cencel('<?=$row->Ma_Tep_Tin?>')">Xóa</a>
                                            </li>
                                            <hr class="m-0">
                                            <li class="text-center"><i class="fa fa-close text-danger"></i> <a
                                                    href="javascript:void(0)"
                                                    onclick="func_cencel('<?=$row->Ma_Tep_Tin?>')">Hủy</a></li>
                                            <div class="close_top">
                                                <i class="fa fa-close bg-white p-1"
                                                    onclick="func_cencel('<?=$row->Ma_Tep_Tin?>')"></i>
                                            </div>

                                        </ul>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal_recycle" tabindex="-1" aria-labelledby="modal_recycleLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning" id="modal_recycleLabel">Danh sách tài liệu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm" id="tb_recycle" style="width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
            <div class=" modal-footer text-start">
                <div class="w-100">
                    <button class="btn btn-sm btn-light border btn_check_all"> <input type="checkbox" class="check_all">
                        Chọn tất cả</button>
                    <button class="btn btn-sm btn-danger btn_xoa_recycle_all" onclick="xoa_khoi_phuc_all('xoa','<?=$ma_thu_muc?>')"> <i
                            class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                    <button class="btn btn-sm btn-success btn_khoi_phuc_all" onclick="xoa_khoi_phuc_all('khoi_phuc','<?=$ma_thu_muc?>')"><i
                            class="fa fa-undo" aria-hidden="true"></i> Khôi
                        phục</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
// var btn_check_all = document.querySelector('.btn_check_all');

// lay du lieu table recycle
function tb_recycle(ma_thu_mu) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "backend/bang_thung_giac_data.php?ma_thu_muc=" + ma_thu_mu, true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.responseType = "json"
    xhr.onload = () => {
        if (xhr.status === 200) {
            if (xhr.response) {
                x = xhr.response
            } else {
                x = "";
            }
            var tb_recycle = document.getElementById('tb_recycle');
            var html = "";
            var no = 0;
            if (x.length > 0) {
                html +='<thead class="bg-warning"><tr><th width="5%"></th><th width="5%">STT</th><th width="70%">Tên tệp tin</th></tr></thead><tbody id="tbody">';
                x.forEach(function(el) {
                    no++;
                    html +=
                        '<tr><td  width="5%" align="center"><input type="checkbox" class="select_all" value="' +
                        el.Ma_Tep_Tin + '" name="chk"></td><td  width="5%">' + no +
                        '</td><td width="70%">' + el.Ten_Tep_Tin +
                        '</td></tr>';
                })
                html +='</tbody>';
            } else {
                html +=
                    '<tr class="p-5 text-center"><td class="text-center text-danger">Không có dữ liệu</td></tr>';
                document.querySelector('.modal-footer').style.display = "none"
            }
            tb_recycle.innerHTML = html;
            // document.getElementById('ol').value = 'dfdsfsdf'
            var check_all = document.querySelector('.check_all');
            var select_all = document.querySelectorAll('.select_all')
            var data_send = [];
            check_all.onclick = () => {
                if (check_all.checked == true) {
                    for (var i = 0, n = select_all.length; i < n; i++) {
                        select_all[i].checked = true;
                    }
                } else {
                    for (var i = 0, n = select_all.length; i < n; i++) {
                        select_all[i].checked = false;
                    }
                }
            }

            // console.log(xhr.response);
        }
    }
    // const mydata = {
    //     ma_thu_muc: ma_thu_muc
    // }
    // var data = stringify(mydata);
    xhr.send();

}
tb_recycle(<?=json_encode($ma_thu_muc)?>);
</script>
<script>
function xoa_khoi_phuc_all(action,ma_thu_mua) {
    var checkboxes = document.querySelectorAll('input[name="chk"]:checked');
    var checkedValues = [];
    checkboxes.forEach(function(checkbox) {
        checkedValues.push(checkbox.value);
    });
    // console.log(checkedValues)
    if (checkedValues.length > 0) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST','backend/xoa_khoi_phuc_tep_tin_thung_giac.php?action='+action+'&ma_thu_muc='+ma_thu_mua, true);
        // xhr.setRequestHeader("Content-Type", "application/json");
        xhr.responseType = "json";
        xhr.onload = () => {
            if (xhr.status === 200) {
                var x = xhr.response;
                if (xhr.response) {
                    x = xhr.response
                } else {
                    x = "";
                }
                console.log(x)
                if (x.status == 1) {
                    swal_succ(x.msg);
                    document.querySelector('.tong_xoa').innerHTML = x.tong_xoa;
                    tb_recycle(ma_thu_mua);
                } else {
                    swal_err(x.msg, '');
                }
            }
        }
        var data = JSON.stringify(checkedValues);
        xhr.send(data);
    } else {
        if(action == "khoi_phuc"){
            swal_err('Khôi phục không thành công', 'hãy chọn tệp tin mà bạn muốn Khôi phục')
        } else {
            swal_err('Xóa không thành công', 'hãy chọn tệp tin mà bạn muốn xóa')
        }
        
    }
}
</script>
<script>
    var btn_close = document.querySelector('.btn-close');
    btn_close.onclick = ()=>{
        location.reload();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- =======  Data-Table  = End  ===================== -->
<script>
$(document).ready(function() {

    var table = $('#tb_quan_ly_nhan_vien').DataTable({
        // scrollX: true,
    });
    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');
});
$(document).ready(function() {

    var table = $('#tb_recycle').DataTable({
        // scrollX: true,
    });
    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');
});
const btn_them_tep_tin = document.querySelector("#btn_them_tep_tin"),
    form = document.querySelector("form"),
    fileInput = document.querySelector(".file-input"),
    progressArea = document.querySelector(".progress-area"),
    uploadedArea = document.querySelector(".uploaded-area");

btn_them_tep_tin.addEventListener("click", () => {
    fileInput.click();
});

fileInput.onchange = ({
    target
}) => {
    let file = target.files[0];
    if (file) {
        let fileName = file.name;
        if (fileName.length >= 12) {
            let splitName = fileName.split('.');
            fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
        }
        uploadFile(fileName);
    }
}

function uploadFile(name) {
    var ma_thu_muc = document.getElementById('ma_thu_muc').value;
    // alert(ma_thu_muc)
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/tai_tep_tin_len.php?ma_thu_muc=" + ma_thu_muc);
    // xhr.setRequestHeader("Content-Type", "application/json");
    xhr.responseType = "json";
    // xhr.upload.addEventListener("progress", () => {});
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
                swal_err('Thêm tệp tin không thành công', '')
            }
        } else {
            swal_err('Thêm tệp tin không thành công', '')
        }
    }
    let data = new FormData(form);
    // console.log(data)
    xhr.send(data);
}
</script>

<script>
function show_recycle() {

}
</script>
<script>
function func_show_act(id) {
    var ul_act = document.getElementById('ul_act' + id);
    ul_act.style.display = 'block';
}

function func_cencel(id) {
    var ul_act = document.getElementById('ul_act' + id);
    ul_act.style.display = 'none';
}

function confirm_delete(id, ten_tep_tin) {
    swal.fire({
        title: '<h5 style="font-weight: bolder;"> Bạn chắc chắn Xóa tệp tin này không?</h5>',
        html: "<div>" + ten_tep_tin + "</div>",
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
            func_xoa(id)
        }
    });
}

function func_xoa(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/xoa_tep_tin.php", true);
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
                swal_err('Xóa tệp tin không thành công', '')
            }
        } else {
            swal_err('Xóa tệp tin không thành công', '')
        }
    }
    const mydata = {
        ma_tep_tin: id
    };
    const data = JSON.stringify(mydata);
    xhr.send(data);
}
</script>
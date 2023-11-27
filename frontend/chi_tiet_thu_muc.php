<style>
    .i_act {
        position: relative;
    }
.ul_act {
    display: none;
    position: absolute;
    right: 2rem;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .13), 0 1px 1px 0 rgba(0, 0, 0, .11);
    z-index: 100;
}
.ul_act li{
    list-style: none;
    font-size:small;
    padding: 5px;
}
.ul_act li a{
    text-decoration: none;
    color:dimgray
}
</style>
<section class="p-2">
    <div class="card">
        <div>
            <div class="p-3" id="div_btn_them_tep_tin">
                <input type="hidden" id="ma_thu_muc" value="<?=$_GET['thu_muc']?>">
                <form action="#">
                    <div class="alert-success rounded" style="width: 5%;">
                        <img src="assets/image/add_file.png" alt="" width="45" id="btn_them_tep_tin"
                            style="border: 2px dashed #6990F2;border-radius: 5px;padding:5px;width:100%">
                        <input class="file-input" type="file" name="file" hidden>
                    </div>
                </form>
                <section class="progress-area"></section>
                <section class="uploaded-area"></section>
                <!-- <button class="btn btn-primary">Thêm nhân viên</button> -->
            </div>
            <!-- <div class="col-md-12 p-3 text-end" id="div_them_tep_tin">
                <form action="" id="form_chon_tep_tin">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn border border-success p-0" style="width: 90%;"><input type="file" class="form-control rounded-0" placeholder="Nhập tên thư mục" id="ten_tep_tin"></button>
                        <button type="button" class="btn btn-success" id="btn_luu_them_tep_tin" style="width: 5%;display:none"><i class="fa fa-save text-white" style="width:50%;font-size: 20px"></i></button>
                        <button type="button" class="btn btn-danger" id="btn_huy_them_tep_tin" style="width: 5%;;display:none"><i class="fa fa-close text-white" style="width: 100%;font-size: 20px"></i></button>
                    </div>
                </form>
            </div> -->
            <hr class="m-0">
            <div class="p-3">
                <div class="row">
                    <div class="data_table">
                        <table id="tb_quan_ly_nhan_vien" class="table table-striped table-bordered" style="width: 100%;">
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
                                $ma_thu_muc = $_GET['thu_muc'];
                                $sql_chk = mysqli_query($conn , "SELECT tti.*,us.Ho_Ten,us.Ten_Dang_Nhap FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE Ma_Thu_Muc = $ma_thu_muc");

                                $exts = array('pdf'); 

                                while($row_chk = mysqli_fetch_object($sql_chk)){
                                    
                                }



                                $sql = mysqli_query($conn , "SELECT tti.*,us.Ho_Ten,us.Ten_Dang_Nhap FROM tb_tep_tin as tti LEFT JOIN tb_user as us ON tti.Ma_User = us.Ma_User WHERE Ma_Thu_Muc = $ma_thu_muc");
                                $exts_pdf = array('pdf'); 
                                $exts_img = array('png','jpg','JPG','jpeg','gif','svg'); 
                                $exts_word = array('docx','doc'); 
                                $exts_excel = array('xlsx','xls'); 
                                $exts_ppt = array('ppt'); 
                                
                                while($row = mysqli_fetch_object($sql)){
                                    $tmp = explode('.', $row->Ten_Tep_Tin);
                                    $file_extension = end($tmp);
                                    if(in_array($file_extension,$exts)){
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
                                    <td class="text-center"id="i_act">
                                        <!-- <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-sm btn-success"><i
                                                    class="fa fa-download"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </div> -->
                                        <i class="fa fa-ellipsis" onclick="func_show_act('<?=$row->Ma_Tep_Tin?>')"></i>
                                        <ul class="bg-warning p-2 rounded text-start ul_act" id="ul_act<?=$row->Ma_Tep_Tin?>">
                                            <li><i class="fa fa-download text-primary"></i> <a href="">Download</a></li>
                                            <li><i class="fa fa-trash text-danger"></i> <a href="">Delete</a></li>
                                            <li><i class="fa fa-close text-danger"></i> <a href="javascript:void(0)" onclick="func_cencel('<?=$row->Ma_Tep_Tin?>')">Cencel</a></li>
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
<!-- =======  Data-Table  = End  ===================== -->
<script>
$(document).ready(function() {

    var table = $('#tb_quan_ly_nhan_vien').DataTable({
        // scrollX: true,
    });
    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');
});
</script>
<!-- <script>
    var div_btn_them_tep_tin = document.querySelector('#div_btn_them_tep_tin')
    var btn_them_tep_tin = document.querySelector('#btn_them_tep_tin')
    var div_them_tep_tin = document.querySelector('#div_them_tep_tin')
    var btn_luu_them_tep_tin = document.querySelector('#btn_luu_them_tep_tin')
    var btn_huy_them_tep_tin = document.querySelector('#btn_huy_them_tep_tin')
    btn_them_tep_tin.addEventListener('click', function(e) {
        e.preventDefault();
        div_them_tep_tin.style.display = "block";
        div_btn_them_tep_tin.style.display = "none"
    })
    btn_huy_them_tep_tin.addEventListener('click', function(e) {
        e.preventDefault();
        div_them_tep_tin.style.display = "none";
        div_btn_them_tep_tin.style.display = "block"
        ten_thu_muc.value = ''
    })
    btn_luu_them_tep_tin.addEventListener('click', function(e) {
        e.preventDefault();
        var ten_thu_muc = document.querySelector('#ten_thu_muc').value;
        alert(ten_thu_muc)
    })
</script> -->
<script>
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
    function func_show_act(id){
        var ul_act = document.getElementById('ul_act'+id);
        ul_act.style.display = 'block';
    }
    function func_cencel(id){
        var ul_act = document.getElementById('ul_act'+id);
        ul_act.style.display = 'none';
    }
</script>

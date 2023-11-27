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
                <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_them_nhan_vien"><i class="fa fa-add"></i> Thêm nhân
                    viên</button> -->
            </div>
            <hr class="m-0">
            <div class="p-3">
                <div class="row">
                    <div class="data_table">
                        <table id="tb_quan_ly_nhan_vien" class="table table-striped table-bordered">
                            <thead class="bg-warning">
                                <tr>
                                    <th width="1%" class="text-center bg-warning" style="position: sticky;left:0px;z-index:100;"><pre style="width: 30px;">STT</pre></th>
                                    <th  class="col_tong_quan bg-warning" style="position: sticky;left:70px;z-index:100;"><pre>Họ tên</pre></th>
                                    <th  class="col_tong_quan"><pre>Số điện thoại</pre></th>
                                    <th  class="col_tong_quan"><pre>Email</pre></th>
                                    <th  class="col_tong_quan"><pre>Giới tính</pre></th>
                                    <th  class="col_tong_quan"><pre>Phòng</pre></th>
                                    <th  class="col_tao_mat_khao"><pre>Tên đăng nhập</pre></th>
                                    <th  class="col_tao_mat_khao"><pre>Mật khẩu</pre></th>
                                    <th  class="col_tao_mat_khao"><pre>Xác nhận mật khẩu</pre></th>
                                    <th width="10%" class="text-center">
                                        <button class="btn btn-primary" id="btn_them_nhan_vien"><i
                                                class="fa fa-add"></i>
                                        </button>
                                    </th>
                                </tr>
                                <tr id="tr_them_nhan_vien" hidden>
                                    <form action="" id="form_them_nhan_vien" method="post">
                                        <td style="position: sticky;left:0px;z-index:100" class="bg-warning"><input type="text" class="form-control" disabled></td>
                                        <td class="bg-warning" style="position: sticky;left:70px;z-index:100"><input type="text" class="form-control" id="ho_ten" required></td>
                                        <td><input type="text" class="form-control" id="so_dien_thoai"></td>
                                        <td><input type="email" class="form-control" id="email"></td>
                                        <td><select class="form-control" id="gioi_tinh" style="width: 100%;" required>
                                                <option value="">-- Chọn giới tính --</option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                                <option value="Khác">Khác</option>
                                            </select></td>
                                        <td>
                                            <select class="form-control" id="phong" style="width: 100%;" required>
                                                <option value="">-- Chọn phòng --</option>
                                                <option value="US">United States of America</option>
                                                <option value="UK">United Kingdom</option>
                                                <option value="ZA">South Africa</option>
                                            </select>
                                        </td>
                                        <td class="col_tao_mat_khao">
                                            <input type="text" name="them_ten_dang_nhap" id="them_ten_dang_nhap"
                                                class="form-control">
                                        </td>
                                        <td class="col_tao_mat_khao">
                                            <input type="text" name="them_mat_khau" id="them_mat_khau"
                                                class="form-control">
                                        </td>
                                        <td class="col_tao_mat_khao">
                                            <input type="text" name="xac_nhan_mat_khau" id="xac_nhan_mat_khau"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success"
                                                    id="btn_luu_them_nhan_vien"><i class="fa fa-save"></i></button>
                                                <button type="button" class="btn btn-danger"
                                                    id="btn_huy_them_nhan_vien"><i class="fa fa-close"></i></button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="1">
                                    <td style="position: sticky;left:0px;z-index:100" class="text-center bg-white">1</td>
                                    <td class="bg-white" style="position: sticky;left:70px;z-index:100">
                                        <span class="sua_nhan_vien_span ho_ten">sdfsdfsdf</span>
                                        <input type="text" class="form-control sua_input" id="sua_ho_ten"
                                            style="display: none;" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span so_dien_thoai">sdfsdfsdf</span>
                                        <input type="text" class="form-control sua_input" id="sua_so_dien_thoai"
                                            style="display: none;" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span email">sdfsdfsdf</span>
                                        <input type="email" class="form-control sua_input" id="sua_email"
                                            style="display: none;" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span gioi_tinh">sdfsdfsdf</span>
                                        <select class="form-control sua_input" id="sua_gioi_tinh"
                                            style="width: 100%;display:none" required>
                                            <option value="">-- Chọn giới tính --</option>
                                            <option selected value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                            <option value="Khác">Khác</option>
                                        </select>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span phong">sdfsdfsdf</span>
                                        <select class="form-control sua_input" id="sua_phong1"
                                            style="width: 100%;display:none" required>
                                            <option value="">-- Chọn phòng --</option>
                                            <option selected value="US">United States of America</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="ZA">South Africa</option>
                                        </select>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_ten_dang_nhap" id="sua_ten_dang_nhap"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_mat_khau" id="sua_mat_khau"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_xac_nhan_mat_khau" id="sua_xac_nhan_mat_khau"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-info btn_tao_mat_khao"><i
                                                    class="fa fa-key"></i></button>
                                            <button type="button" class="btn btn-success btn_sua_nhan_vien"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn_xoa_nhan_vien"><i
                                                    class="fa fa-trash"></i></button>

                                            <button type="button" class="btn btn-success btn_cap_nhap_nhan_vien"
                                                style="display: none;"><i class="fa fa-save"></i></button>
                                            <button type="button" class="btn btn-danger btn_huy_nhan_vien"
                                                style="display: none;"><i class="fa fa-close"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="2">
                                    <td style="position: sticky;left:0px;z-index:1000" class="text-center bg-white">2</td>
                                    <td class="bg-white" style="position: sticky;left:70px;z-index:1000">
                                        <span class="sua_nhan_vien_span ho_ten">hhhhfdf</span>
                                        <input type="text" class="form-control sua_input" id="sua_ho_ten"
                                            style="display: none;" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span so_dien_thoai">kkkgfhgfhgfhf</span>
                                        <input type="text" class="form-control sua_input" id="sua_so_dien_thoai"
                                            style="display: none;" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span email">sdfsdfsdf</span>
                                        <input type="email" class="form-control sua_input" id="sua_email"
                                            style="display: none;" required>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span gioi_tinh">sdfsdfsdf</span>
                                        <select class="form-control sua_input" id="sua_gioi_tinh"
                                            style="width: 100%;display:none" required>
                                            <option value="">-- Chọn giới tính --</option>
                                            <option selected value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                            <option value="Khác">Khác</option>
                                        </select>
                                    </td>
                                    <td>
                                        <span class="sua_nhan_vien_span phong">sdfsdfsdf</span>
                                        <select class="form-control sua_input" id="sua_phong1"
                                            style="width: 100%;display:none" required>
                                            <option value="">-- Chọn phòng --</option>
                                            <option selected value="US">United States of America</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="ZA">South Africa</option>
                                        </select>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_ten_dang_nhap" id="sua_ten_dang_nhap"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_mat_khau" id="sua_mat_khau"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="col_tao_mat_khao">
                                        <input type="text" name="sua_xac_nhan_mat_khau" id="sua_xac_nhan_mat_khau"
                                            class="form-control input_sua_" disabled>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-info btn_tao_mat_khao"><i
                                                    class="fa fa-key"></i></button>
                                            <button type="button" class="btn btn-success btn_sua_nhan_vien"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn_xoa_nhan_vien"><i
                                                    class="fa fa-trash"></i></button>

                                            <button type="button" class="btn btn-success btn_cap_nhap_nhan_vien"
                                                style="display: none;"><i class="fa fa-save"></i></button>
                                            <button type="button" class="btn btn-danger btn_huy_nhan_vien"
                                                style="display: none;"><i class="fa fa-close"></i></button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <div class="modal fade" id="modal_them_nhan_vien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal_them_nhan_vienLabel">Thêm nhân viên</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_them_nhan_vien">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-2 text-end">
                            <label for="country">Họ tên</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="ho_ten" id="ho_ten" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 text-end">
                            <label for="country">Số điện thoại</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 text-end">
                            <label for="country">Email</label>
                        </div>
                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 text-end">
                            <label for="country">Giới tính</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="gioi_tinh" value="Nam" checked required>
                                <label class="form-check-label" for="gioi_tinh">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="gioi_tinh" value="Nữ" required>
                                <label class="form-check-label" for="gioi_tinh">Nữ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="gioi_tinh" value="Khác" required>
                                <label class="form-check-label" for="gioi_tinh">Khác</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 text-end">
                            <label for="country">Phòng</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" id="phong" style="width: 100%;" required>
                                <option value="">-- Chọn phòng --</option>
                                <option value="US">United States of America</option>
                                <option value="UK">United Kingdom</option>
                                <option value="ZA">South Africa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-close"></i> Thoát</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
$(document).ready(function() {
    // $("#phong").select2({
    //     // dropdownParent: $("#modal_them_nhan_vien")
    // });

});
</script>
<!-- =======  Data-Table  = End  ===================== -->
<script>
$(document).ready(function() {

    var table = $('#tb_quan_ly_nhan_vien').DataTable({
        orderCellsTop: true,
        // "columnDefs": [
        //     { "width": "200px", "targets": "_all" }
        // ]
        scrollX: true,
        
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
    $('#btn_luu_them_nhan_vien').click(function() {
        var data = $('#ho_ten').val();
        alert(data)
    });
    $('.btn_sua_nhan_vien').click(function(e) {
        e.preventDefault();
        //hide edit button
        var id = $(this).closest("tr").attr('id');
        alert(id)
        $(this).hide();
        $(this).closest("tr").find(".sua_nhan_vien_span").hide();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").hide();
        $(this).closest("tr").find(".btn_tao_mat_khao").hide();

        $(this).closest("tr").find(".sua_input").show();
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").show();
        $(this).closest("tr").find(".btn_huy_nhan_vien").show();
        $("#sua_phong").select2({
            // dropdownParent: $("#modal_them_nhan_vien")
        });
    });
    $('.btn_huy_nhan_vien').click(function(e) {
        e.preventDefault();
        //hide edit button
        $(this).hide();
        $(this).closest("tr").find(".sua_nhan_vien_span").show();
        $(this).closest("tr").find(".btn_sua_nhan_vien").show();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").show();
        $(this).closest("tr").find(".btn_tao_mat_khao").show();
        $(this).closest("tr").find(".sua_input").hide();
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").hide();
        $(this).closest("tr").find(".input_sua_").attr('disabled', true);
        $("#sua_phong").select2({
            // dropdownParent: $("#modal_them_nhan_vien")
        });
    });
    $('.btn_tao_mat_khao').click(function(e){
        e.preventDefault();
        var id = $(this).closest("tr").attr('id');
        alert(id)
        $(this).closest("tr").find(".input_sua_").attr('disabled', false);
        $(this).closest("tr").find(".btn_cap_nhap_nhan_vien").show();
        $(this).closest("tr").find(".btn_huy_nhan_vien").show();

        $(this).closest("tr").find(".btn_sua_nhan_vien").hide();
        $(this).closest("tr").find(".btn_xoa_nhan_vien").hide();
        $(this).closest("tr").find(".btn_tao_mat_khao").hide();
    })

})
</script>
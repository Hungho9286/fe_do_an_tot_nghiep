@extends('layouts.client.client')
@section('content')
<h1>
    Thông tin cá nhân
</h1>

<div class="row" style="border: 1px solid rgb(112, 108, 108);" ng-app="myApp" ng-controller="SinhVienController" style="width:130%">
    <div class="col-md-6" style="border-right:5px solid rgb(177, 173, 173);" >
        {{-- Thông tin sinh viên --}}
        <div style="background-color:rgb(55, 55, 233); width:100% height:auto; margin-top:10px;">
            <strong style="font-size:1.5em;  color:white; margin-left:10px">Thông tin sinh viên</strong>
        </div>

        <div style="width:100%; height:5px; background-color: rgb(226, 219, 219);margin-top:3px;"></div>

        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Mã số sinh viên</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.ma_sv%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Họ tên</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.ten_sinh_vien%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Ngày sinh</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ng-bind="sinhvien.ngay_sinh | date:'dd/MM/yyyy'"><%sinhvien.ngaysinh|date:'dd/MM/yyyy'%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Nơi sinh</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.noi_sinh%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Giới tính</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.gioi_tinh && 'Nam' || 'Nữ'%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Dân tộc</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.dan_toc%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">CMND/CCCD</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.so_cmt%></span></div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Quốc gia</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.quoc_gia%></span></div>
        </div> --}}
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Tỉnh/Thành phố</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%tinh_thanh_pho%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Quận/Huyện</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%quan_huyen%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Xã/Phường</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%xa_phuong%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Địa chỉ thường trú</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.dia_chi_thuong_tru%></span></div>
        </div>
        {{-- End --}}
        {{-- Thông tin khóa học --}}
        <div style="width:100%; height:5px; background-color: rgb(226, 219, 219);margin-bottom:3px;"></div>

        <div style="background-color:rgb(106, 106, 250); width:100% height:auto">
            <strong style="font-size:1.5em;  color:white; margin-left:10px">Thông tin khóa học</strong>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Lớp</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.lop_hoc.ten_lop_hoc%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Khóa học</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" >Khóa <%sinhvien.khoa_hoc%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Niên khóa</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.nien_khoa%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Khoa</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.khoa_nganh.ten_khoa%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Chuyên ngành</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.chuyen_nganh.ten_chuyen_nganh%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Bậc đào tạo</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.bac_dao_tao%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Hệ đào tạo</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.he_dao_tao%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Tình trạng học</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.tinh_trang_hoc%></span></div>
        </div>
        {{-- End --}}
    </div>
    <div class="col-md-6" >

        <div class="text-center" style="margin-top: 10px; margin-bottom:10px;">
            <img src="{{env('SERVER_URL')}}/public/sinhvien_img/<%sinhvien.hinh_anh_dai_dien%>" alt="" width="40%">
        </div>

        <div style="background-color:rgb(252, 146, 33); width:100% height:auto">
            <strong style="font-size:1.5em;  color:white; margin-left:10px">Thông tin liên lạc</strong>
        </div>
        <div style="width:100%; height:5px; background-color: rgb(226, 219, 219);margin-top:3px;"></div>
        <div class="row" style="color:red;">
            <div class="col-md-8" >*Thông tin liên lạc của sinh viên</div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Số điện thoại</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; color:rgb(43, 43, 243)" ><%sinhvien.so_dien_thoai%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Email</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; color:rgb(43, 43, 243)" ><%sinhvien.email%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;">Địa chỉ</div>
            <div class="col-md-8" ><span>:</span><span style="margin-left: 10px; color:rgb(43, 43, 243)" ><%sinhvien.dia_chi_tam_tru%></span></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight: 700;"><a href="" class="btn" data-toggle="modal" data-target="#formDoiMatKhau">Đổi mật khẩu</a></div>

        </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="formDoiMatKhau">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Đổi mật khẩu</h4>
        </div>
        <div class="modal-body">
            <form id="formNhapThongTin">
                <div class="form-group">
                    <label for="mat_khau_cu">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control" id="mat_khau_cu" name="mat_khau_cu" placeholder="Mật khẩu hiện tại" >
                </div>
                <div class="form-group">
                    <label for="mat_khau_cu">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="mat_khau_moi" name="mat_khau_moi" placeholder="Mật khẩu mới" >
                </div>
                <div class="form-group">
                    <label for="nhap_lai_mat_khau_moi">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" id="nhap_lai_mat_khau_moi" name="nhap_lai_mat_khau_moi" placeholder="Mật khẩu hiện tại" >
                </div>
                <a  class="btn btn-primary" id="btnXacNhanDoiMatKhau">Đổi mật khẩu</a>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
     app.controller("SinhVienController",function($scope,$http){

        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/sinh-vien/{{Session::get('ma_sv')}}",
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).then($response=>{
            $scope.sinhvien=$response.data
            var $diachithuongtru=$scope.sinhvien.dia_chi_thuong_tru;
            var $strSplit=$diachithuongtru.split(", ");
            $scope.tinh_thanh_pho=$strSplit[$strSplit.length-1];
            $scope.quan_huyen=$strSplit[$strSplit.length-2];
            $scope.xa_phuong=$strSplit[$strSplit.length-3];

        });
     })
     $('#btnXacNhanDoiMatKhau').click(function(){

        var mat_khau_cu=$('#mat_khau_cu').val();
        var mat_khau_moi=$('#mat_khau_moi').val();
        var nhap_lai_mat_khau_moi=$('#nhap_lai_mat_khau_moi').val();
        console.log("ABC");
        if(mat_khau_cu=="" ||mat_khau_moi==""||nhap_lai_mat_khau_moi==""){
            Swal.fire('Hãy nhập đầy đủ thông tin')
        }
        else
            if(mat_khau_moi==nhap_lai_mat_khau_moi){

                Swal.fire({
                    title: 'Bạn có chắc muốn đổi mật khẩu?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Có',
                    denyButtonText: `Không`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var dataJson={
                            'mat_khau_cu':$('#mat_khau_cu').val(),
                            'mat_khau_moi':mat_khau_moi,
                        }
                        $.ajax({
                            url:"{{env('SERVER_URL')}}/api/sinh-vien/doi-mat-khau/{{Session::get('ma_sv')}}",
                            type:"POST",
                            data:dataJson,
                            dataType:'Json',
                            headers:{
                                "Authorization":"Bearer {{Session::get('access_token')}}",
                            }
                        }).done(function(response){
                            if(response.status==1){
                                Swal.fire('Đổi mật khẩu thành công!', '', 'success')
                            }
                            if(response.status==0){
                                Swal.fire({
                                icon: 'error',
                                title: 'Lỗi...',
                                text: response.message,
                                // footer: '<a href="">Why do I have this issue?</a>'
                                })
                            }
                        })

                    } else if (result.isDenied) {
                        Swal.fire('Hủy thay đổi mật khẩu', '', 'info')
                    }
                })

            }else{
                Swal.fire({
                icon: 'error',
                title: 'Lỗi...',
                text: "Mật khẩu mới và mật khẩu nhập lại không khớp",
                // footer: '<a href="">Why do I have this issue?</a>'
                })
            }
     })

</script>
@endsection

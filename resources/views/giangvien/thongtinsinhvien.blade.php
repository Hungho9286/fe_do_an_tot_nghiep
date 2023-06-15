@extends('layouts.giangvien.giangvien')
@section('css')
@endsection
@section('content')
<a href="{{route('lop-hoc-phan-cua-giang-vien',['id'=>$id_lop_hoc_phan])}}" class="btn btn-outline-primary">Trở lại</a>
<div class="row" style="border: 1px solid rgb(112, 108, 108); margin-top: 20px;" ng-app="myApp" ng-controller="SinhVienController">
    <div class="col-md-6" style="border-right:5px solid rgb(177, 173, 173);">
        {{-- Thông tin sinh viên --}}
        <div style="background-color:rgb(55, 55, 233); width:100% height:auto; margin-top:10px;">
            <strong style="font-size:1.5em;  color:white; margin-left:10px">Thông tin sinh viên</strong>
        </div>

        <div style="width:100%; height:5px; background-color: rgb(226, 219, 219);margin-top:3px;"></div>

        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Mã số sinh viên</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.ma_sv%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Họ tên</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.ten_sinh_vien%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Ngày sinh</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ng-bind="sinhvien.ngay_sinh | date:'dd/MM/yyyy'"><%sinhvien.ngaysinh|date:'dd/MM/yyyy'%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Nơi sinh</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.noi_sinh%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Giới tính</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.gioi_tinh && 'Nam' || 'Nữ'%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Dân tộc</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.dan_toc%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">CMND/CCCD</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.so_cmt%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Quốc gia</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.quoc_gia%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Tỉnh/Thành phố</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%tinh_thanh_pho%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Quận/Huyện</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%quan_huyen%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Xã/Phường</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%xa_phuong%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Địa chỉ thường trú</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.dia_chi_thuong_tru%></span></div>
        </div>
        {{-- End --}}
        {{-- Thông tin khóa học --}}
        <div style="width:100%; height:5px; background-color: rgb(226, 219, 219);margin-bottom:3px;"></div>

        <div style="background-color:rgb(106, 106, 250); width:100% height:auto">
            <strong style="font-size:1.5em;  color:white; margin-left:10px">Thông tin khóa học</strong>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Lớp</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.lop_hoc.ten_lop_hoc%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Khóa học</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" >Khóa <%sinhvien.khoa_hoc%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Niên khóa</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.nien_khoa%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Khoa</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.khoa_nganh.ten_khoa%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Chuyên ngành</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.chuyen_nganh.ten_chuyen_nganh%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Bậc đào tạo</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.bac_dao_tao%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Hệ đào tạo</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.he_dao_tao%></span></div>
        </div>
        <div class="row">
            <div class="col-md-6" style="font-weight: 700;">Tình trạng học</div>
            <div class="col-md-6" ><span>:</span><span style="margin-left: 10px; font-weight: 700;color:rgb(43, 43, 243)" ><%sinhvien.tinh_trang_hoc%></span></div>
        </div>
        {{-- End --}}
    </div>
    <div class="col-md-6">

        <div class="text-center" style="margin-top: 10px; margin-bottom:10px;">
            <img src="{{asset('<%sinhvien.hinh_anh_dai_dien%>')}}" alt="" width="40%">
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
    </div>
  </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
     app.controller("SinhVienController",function($scope,$http){

        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/sinh-vien/{{$ma_sv}}",
            headers:{
                "Authorization":"Bearer token",
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
</script>
@endsection

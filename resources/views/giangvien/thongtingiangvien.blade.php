@extends('layouts.giangvien.giangvien')
@section('css')
<style>
    body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
@endsection

@section('content')
<div class="container rounded bg-white mt-5 mb-5" ng-app="ThongTinGiangVien" ng-controller="ThongTinGiangVienController">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><%ThongTinGiangVien.ten_giang_vien%></span><span class="text-black-50"><%ThongTinGiangVien.email%></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Hồ Sơ Giảng Viên</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Mã giảng viên </label><input  readonly  type="text" class="form-control"  value="<%ThongTinGiangVien.ma_gv%>"></div>
                    <div class="col-md-12"><label class="labels">Họ Tên</label><input  readonly type="text" class="form-control" value="<%ThongTinGiangVien.ten_giang_vien%>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input  readonly type="text" class="form-control"  value="<%ThongTinGiangVien.so_dien_thoai%>"></div>
                    <div class="col-md-12"><label class="labels">Địa chỉ thường trú </label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.dia_chi_thuong_tru%>"></div>
                    <div class="col-md-12"><label class="labels">Địa chỉ tạm trú</label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.dia_chi_tam_tru%>"></div>
                    <div class="col-md-12"><label class="labels">Ngày sinh</label><input readonly  type="text" class="form-control"  value="<%ThongTinGiangVien.ngay_sinh%>"></div>
                    <div class="col-md-12"><label class="labels">Nơi sinh</label><input readonly  type="text" class="form-control"  value="<%ThongTinGiangVien.noi_sinh%>"></div>
                   
                </div>
               
               
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
              <br>
              <br>
              
                 <div class="col-md-12"><label class="labels">Căn cước công dân</label><input readonly  type="text" class="form-control"  value="<%ThongTinGiangVien.so_cmt%>"></div>
                    <div class="col-md-12"><label class="labels">Giới tính </label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.gioi_tinh && 'Nam' || 'Nữ' %>"></div>
                    <div class="col-md-12"><label class="labels">Dân tộc</label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.dan_toc%>"></div>
                    <div class="col-md-12"><label class="labels">Tôn giáo</label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.ton_giao%>"></div>
                    <div class="col-md-12"><label class="labels">Quốc Gia</label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.quoc_gia%>"></div>
                    <div class="col-md-12"><label class="labels">Chức vụ</label><input readonly  type="text" class="form-control" value="<%ThongTinGiangVien.id_chuc_vu%>"></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<script>
    var app = angular.module("ThongTinGiangVien", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    app.controller("ThongTinGiangVienController",function($scope,$http){
        $http.get('{{env('SERVER_URL')}}/api/giang-vien/GVCNTT1').then($response=>{
            $scope.ThongTinGiangVien=$response.data;
            console.log($response.data);
            console.log("Doo");
        });
});
  
</script>
@endsection
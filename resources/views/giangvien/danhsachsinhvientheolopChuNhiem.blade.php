@extends('layouts.giangvien.giangvien')
@section('content')
<div ng-app="myApp" ng-controller="DanhSachSinhVienTheoLopChuNhiemController">
    <a href="{{route('trang-chu-giang-vien')}}" class="btn btn-outline-primary">Trở lại</a>
    <ul class="list-group" >
        <li class="list-group-item" ng-repeat="sinhVien in lopHocPhan.danh_sach_sinh_vien">
            <div class="row justify-content-around">
                <div class="col-8">
                  <div>MSSV: <%sinhVien.mssv%></div>
                  <div>Lớp: CĐTH20F</div>
                  <div>Email: <%sinhVien.email%></div>
                  <div>Tên: <%sinhVien.ho_ten%></div>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-success" ng-click="XemThongTinSinhVien(sinhVien.id)">Xem thông tin</button>
                    <button type="button" class="btn btn-primary" ng-click="XemDiemSinhVien(sinhVien.id)">Xem điểm</button>
                </div>
            </div>
        </li>
    </ul>
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
    app.controller("DanhSachSinhVienTheoLopChuNhiemController",function($scope,$http){
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/giang-vien/danh-sach-lop-hoc-phan/{{Session::get('ma_gv')}}",
            params:{
                'opition':0,
                'id_lop_hoc':{{$id_lop_hoc}},
            },
            headers:{
               "Authorization":"Bearer {{Session::get('access_token_gv')}} " 
               
            },
        }).then($response=>{
            $scope.lopHocPhan=$response.data;

            $scope.XemThongTinSinhVien=function($id_sinh_vien){
                window.location.href="/giang-vien/danh-sach-lop-hoc-phan/danh-sach-sinh-vien/{{$id_lop_hoc_phan}}/thong-tin-sinh-vien?id_sinh_vien="+$id_sinh_vien;
            }
        })
    });
</script>
@endsection

@extends('layouts.giangvien.giangvien')
@section('content')
<div ng-app="myApp" ng-controller="DanhSachSinhVienTheoLopHocPhanController">
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
    $id_giang_vien=1;
    app.controller("DanhSachSinhVienTheoLopHocPhanController",function($scope,$http){
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/giang-vien/danh-sach-lop-hoc-phan/"+$id_giang_vien,
            params:{
                'opition':1,
                'id_lop_hoc_phan':{{$id_lop_hoc_phan}},
            },
            headers:{
                "Authorizations":"Bearer token"
            }
        }).then($response=>{
            $scope.lopHocPhan=$response.data;

            console.log($scope.danhSachSinhVien);
        })
    });
</script>
@endsection

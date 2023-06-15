@extends('layouts.giangvien.giangvien')

@section('css')
<style>



    .div-box-class{
        margin-left: 20px;
        margin-top: 20px;
        background-color: rgb(132, 132, 254);
        border-radius:3px;
        width: 30%;
        height:100px;
        position: relative;
        border:solid 1px rgb(237, 237, 237);
        cursor: pointer;
    }
    .div-name-subject{
        color: white;
        font-size:1.5em;
        font-weight:bold
    }
    .div-code-class{
        color: white
    }
    .div-name-class{
        height:30%;
        width:100%;
        background-color:white;
        position: absolute;
        bottom:0px;
        right:0px;
        color: rgb(105, 105, 105);
        text-align:right;
        padding-right:10px;
        border-radius:0px 0px 2px 2px;
        font-weight:800;
    }
</style>
@endsection
@section('content')
<div ng-app="myApp" ng-controller="DanhSachLopHocPhanController">
    <div id="danh-sach-lop-hoc-phan">
        <div class="d-flex flex-wrap">
            <div class="p-2 bd-highlight div-box-class" ng-repeat="lopHocPhan in danhSachLopHocPhanCuaGiangVien" ng-click="DanhSachSinhVien(lopHocPhan.id_lop_hoc_phan)">
                <div>
                    <div class="d-flex justify-content-start div-name-subject" ><%lopHocPhan.mon_hoc.ten_mon_hoc%></div>
                    <div class="d-flex justify-content-start div-code-class">Mã lớp: <%lopHocPhan.id_lop_hoc_phan%></div>
                </div>
                <div class="div-name-class">
                    <div >Lớp: <%lopHocPhan.lop_hoc.ten_lop_hoc%></div>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
        var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    app.controller("DanhSachLopHocPhanController",function($scope,$http){
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/giang-vien/danh-sach-lop-hoc-phan/GVCNTT1",
            headers:{
                "Authorizations":"Bearer token",
            }
        }).then(response=>{
            $scope.danhSachLopHocPhanCuaGiangVien=response.data;
            console.log($scope.danhSachLopHocPhanCuaGiangVien);
            $scope.DanhSachSinhVien=function($id_lop_hoc_phan){
                $scope.showListLopHocPhan=false;
                $scope.danhSachLopHocPhanCuaGiangVien.forEach(element => {
                    if(element.id_lop_hoc_phan==$id_lop_hoc_phan){
                        window.location.href='/giangvien/lop-hoc-phan-cua-giang-vien/?id='+element.id_lop_hoc_phan+'&type=1';
                    }
                });
            }
        })
    })
</script>
@endsection



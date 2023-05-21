@extends('layouts.client.client')
@section('content')
{{-- <div ng-app="myApp" ng-controller="DangKyHocPhanController">
    <h1>
        Đăng ký lớp học phần
    </h1>
    <p>Các môn chưa hoàn thành</p>
    <div ng-repeat="mon in monRot">
        <p><%mon.ten_mon_hoc%></p>
        <div >
            <%HienThiButtonDangKy(mon.id_mon_hoc,2020)%>
        </div>
    </div>
</div> --}}

<div >
    <h1>
        Đăng ký lớp học phần
    </h1>
    <p>Các môn chưa hoàn thành</p>
    <div id="ds-mon-dang-ky">

        <div >

        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    $khoa_hoc=2020;
    $(document).ready(function(){
        $.ajax({
        method: "GET",
        url: "http://127.0.0.1:8000/api/danh-sach-dang-ky-mon-cua-sinh-vien/2",
        })
        .done(function( data ) {
            $arr=JSON.parse(data)
            console.log($arr);
            $arr.forEach(item => {
                var mon_hoc='<p style="font-size:1.5em; font-weight: bold;">'+item.ten_mon_hoc+'</p>';
                $("#ds-mon-dang-ky").append(mon_hoc);
                $.ajax({
                method: "GET",
                url: "http://127.0.0.1:8000/api/mo-dang-ky-mon?id_mon_hoc="+item.id_mon_hoc+"&khoa_hoc="+$khoa_hoc,
                }).done(function(data_info){
                    //console.log(data_info);
                    //$thong_tin_dang_ky=JSON.parse(data_info);
                    $thong_tin_dang_ky=data_info;
                    //console.log($thong_tin_dang_ky);
                    if($thong_tin_dang_ky.trang_thai==1){
                        var ngay_mo="<p>Ngày mở: "+$thong_tin_dang_ky.mo_dang_ky+"&#9;Ngày đóng: "+$thong_tin_dang_ky.dong_dang_ky+"</p>"
                        var nutDangKy='<br><button type="button" class="btn btn-success nut-dang-ky-mon" data-id_mon_hoc="'+item.id_mon_hoc+'" data-khoa_hoc="'+$khoa_hoc+'">Đăng ký môn</button>';
                        $("#ds-mon-dang-ky").append(ngay_mo,nutDangKy);
                    }else{
                        $("#ds-mon-dang-ky").append("<p>Chưa mở đăng ký</p>")
                    }
                })
            });

        });



    });
    $(document).on('click', '.nut-dang-ky-mon', function(event){
        var element = $(event.target);
        console.log(element.data("id_mon_hoc")+" "+element.data("khoa_hoc"));
        window.location.href='/chon-lop-dang-ky-mon?type=dang_ky_lop&khoa_hoc='+element.data("khoa_hoc")+"&id_mon="+element.data("id_mon_hoc");
    });
</script>
{{-- <script>
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });

    app.controller("DangKyHocPhanController",function($scope,$http){
        $http.get("http://127.0.0.1:8000/api/danh-sach-dang-ky-mon-cua-sinh-vien/2").then($response=>{
            $scope.monRot=$response.data;
            console.log($scope.monRot);

        })
        $scope.HienThiButtonDangKy=function($id,$khoa_hoc){
                $http.get('http://127.0.0.1:8000/api/danh-sach-dang-ky-mon-cua-sinh-vien/2').then($response=>{
                    console.log($id);
                })
            }
    })
</script> --}}
@endsection

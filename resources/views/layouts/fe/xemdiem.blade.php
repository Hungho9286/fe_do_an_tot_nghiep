@extends('layouts.client.client')
@section('content')
<div ng-app="myApp" ng-controller="DiemController">
<h1>Bảng điểm</h1>
    <h2>Học Kỳ 1</h2>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Môn học</th>
                <th>Điểm tổng kết</th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="diem in danh_sach_diem_hoc_ki_1" ng-class="getClassInformation(diem.diem)">

                    <th scope="row"><%$index+1%></th>
                    <td ><%diem.ten_mon_hoc%></td>
                    <td><%diem.diem==-1 ? '' : diem.diem %></td>


            </tr>
            <tr class="">
                <th scope="row"></th>
                <td ><strong style="color: rgb(244, 85, 85)">Điểm TB HK1</strong></td>
                <td><strong style="color: rgb(244, 85, 85)"><%trung_binh_hoc_ky_1%></strong></td>
            </tr>
            {{-- <tr class="success">
                <th scope="row">2</th>
                <td>CTDL - TT</td>
                <td>5</td>
            </tr> --}}
        </tbody>
    </table>
    <h2>Học Kỳ 2</h2>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Môn học</th>
                <th>Điểm tổng kết</th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="diem in danh_sach_diem_hoc_ki_2" ng-class="getClassInformation(diem.diem)">

                    <th scope="row"><%$index+1%></th>
                    <td ><%diem.ten_mon_hoc%></td>
                    <td><%diem.diem==-1 ? '' : diem.diem %></td>


            </tr>
            <tr class="">
                <th scope="row"></th>
                <td ><strong style="color: rgb(244, 85, 85)">Điểm TB HK2</strong></td>
                <td><strong style="color: rgb(244, 85, 85)"><%trung_binh_hoc_ky_2%></strong></td>
            </tr>

            {{-- <tr class="success">
                <th scope="row">2</th>
                <td>CTDL - TT</td>
                <td>5</td>
            </tr> --}}
        </tbody>
    </table>
    <h2>Học Kỳ 3</h2>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Môn học</th>
                <th>Điểm tổng kết</th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="diem in danh_sach_diem_hoc_ki_3" ng-class="getClassInformation(diem.diem)">

                    <th scope="row"><%$index+1%></th>
                    <td ><%diem.ten_mon_hoc%></td>
                    <td><%diem.diem==-1 ? '' : diem.diem %></td>

            </tr>
            <tr class="">
                <th scope="row"></th>
                <td ><strong style="color: rgb(244, 85, 85)">Điểm TB HK3</strong></td>
                <td><strong style="color: rgb(244, 85, 85)"><%trung_binh_hoc_ky_3%></strong></td>
            </tr>
            {{-- <tr class="success">
                <th scope="row">2</th>
                <td>CTDL - TT</td>
                <td>5</td>
            </tr> --}}
        </tbody>
    </table>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    var app=angular.module("myApp",[],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });

    app.controller("DiemController",function($scope,$http){
        $http.get("http://127.0.0.1:8000/api/danh-sach-diem-cua-sinh-vien/1/hoc-ky/1").then(function($response){
            $scope.danh_sach_diem_hoc_ki_1=$response.data;
            for(let i=0;i<$scope.danh_sach_diem_hoc_ki_1.length;i++){
                if($scope.danh_sach_diem_hoc_ki_1[i].diem!=-1){
                    $sum=$sum+$scope.danh_sach_diem_hoc_ki_1[i].diem;
                    console.log($scope.danh_sach_diem_hoc_ki_1[i].diem);
                }
            }
            $scope.trung_binh_hoc_ky_1=$sum/$scope.danh_sach_diem_hoc_ki_1.length;


        })
        $http.get("http://127.0.0.1:8000/api/danh-sach-diem-cua-sinh-vien/1/hoc-ky/2").then(function($response){
            $scope.danh_sach_diem_hoc_ki_2=$response.data;
            var $sum=0;

            for(let i=0;i<$scope.danh_sach_diem_hoc_ki_2.length;i++){
                if($scope.danh_sach_diem_hoc_ki_2[i].diem!=-1){
                    $sum=$sum+$scope.danh_sach_diem_hoc_ki_2[i].diem;
                    console.log($scope.danh_sach_diem_hoc_ki_2[i].diem);
                }
            }
            $scope.trung_binh_hoc_ky_2=$sum/$scope.danh_sach_diem_hoc_ki_2.length;



        })
        $http.get("http://127.0.0.1:8000/api/danh-sach-diem-cua-sinh-vien/1/hoc-ky/3").then(function($response){
            $scope.danh_sach_diem_hoc_ki_3=$response.data;
            for(let i=0;i<$scope.danh_sach_diem_hoc_ki_3.length;i++){
                if($scope.danh_sach_diem_hoc_ki_3[i].diem!=-1){
                    $sum=$sum+$scope.danh_sach_diem_hoc_ki_3[i].diem;
                    console.log($scope.danh_sach_diem_hoc_ki_3[i].diem);
                }
            }
            $scope.trung_binh_hoc_ky_3=$sum/$scope.danh_sach_diem_hoc_ki_3.length;
        })

        $scope.getClassInformation=function(diem){
            if(diem==-1){
                return '';
            }
            return diem>=5?'success':'danger';
        }
    });

</script>

@endsection

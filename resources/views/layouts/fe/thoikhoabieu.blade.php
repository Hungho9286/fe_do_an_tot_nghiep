@extends('layouts.client.client')
@section('content')
<h1>THỜI KHÓA BIỂU</h1>
<div ng-app="myApp" ng-controller="ThoiKhoaBieuController">
    <div class="alert alert-info" role="alert">
    Sinh viên chọn học kỳ để xem lịch
    </div>
    <div>
        {{-- <label for="">Năm học: </label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>Chọn năm học</option>
            <option value="1">2020 - 2021</option>
            <option value="2">2021 - 2022</option>
            <option value="3">2022 - 2023</option>
        </select> --}}
        <label for="">Học kỳ: </label>
        <select id="chon-hoc-ky" class="form-select form-select-sm" aria-label=".form-select-sm example" ng-model="opitionHocKy">
            <option value="1" selected>Học kỳ 1</option>
            <option value="2">Học kỳ 2</option>
            <option value="3">Học kỳ 3</option>
            <option value="4">Học kỳ 4</option>
            <option value="5">Học kỳ 5</option>
            <option value="6">Học kỳ 6</option>
        </select>
    </div>
    {{-- <div class="text-right">
        <label for="">Tuần: </label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>Chọn tuần</option>
            <option value="1">Tuần 1</option>
            <option value="2">Tuần 2</option>
            <option value="3">Tuần 3</option>
            <option value="4">Tuần 4</option>
            <option value="5">Tuần 5</option>
            <option value="6">Tuần 6</option>
        </select>
        <span>Từ ngày ... đến ngày ...</span>
    </div> --}}
    <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col">Phòng</th>
        <th scope="col">Thứ 2</th>
        <th scope="col">Thứ 3</th>
        <th scope="col">Thứ 4</th>
        <th scope="col">Thứ 5</th>
        <th scope="col">Thứ 6</th>
        <th scope="col">Thứ 7</th>
        <th scope="col">CN</th>
      </tr>
    </thead>
    <tbody id="body-table">
      <tr ng-repeat="tkb in thoiKhoaBieu">
        <th scope="row" style="background-color:beige"><%tkb.ten_phong_hoc%></th>
          <td ng-repeat="count in [1,2,3,4,5,6,7]">
            <div ng-repeat="lp in tkb.lich|filter:{thu_trong_tuan:count}|filter:{hoc_ky:opitionHocKy}">
                    <strong><%lp.mon_hoc%></strong>
                    <p><%lp.tiet_bat_dau%> &#8594; <%lp.tiet_ket_thuc%></p>
                    <p><%lp.thoi_gian_bat_dau%> &#8594; <%lp.thoi_gian_ket_thuc%></p>
                    <p><%lp.giang_vien_1%></p>
            </div>
          </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<script>
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    app.controller("ThoiKhoaBieuController",function($scope,$http){

        $http({
            method:'GET',
            url:'http://127.0.0.1:8000/api/thoi-khoa-bieu-cua-sinh-vien/{{Session::get('id_sinh_vien')}}',
            headers:{
                'Authorization':"Bearer {{Session::get('access_token')}}",
            }
        }).then($response=>{
            $scope.thoiKhoaBieu=$response.data;
        });
        $scope.opitionHocKy="1";
        // $("#chon-hoc-ky").val("1").change();


});


    // app.filter("ThemThoiKhoaBieu",function(){
    //     return function(input,thu,phong,phongduyet,index,dongcuoi){

    //         console.log(index);
    //         console.log(nLast);
    //       console.log("thu index "+thu_index);
    //       console.log("thu "+thu);
    //       console.log("phong duyet "+phongduyet);
    //       console.log("phong "+phong);
    //       console.log("--------");
    //       if(dongcuoi==false){
    //         if(thu<=thu_index&&phong==phongduyet){
    //             return input;
    //         }
    //         if(thu==thu_index&&phong==phongduyet){

    //             return input;
    //         }

    //       }else{
    //         if(index+1==nLast){
    //             if(thu==thu_index&&phong==phongduyet){
    //                 return input;
    //             }
    //             thu_index=1;
    //         }
    //         else{

    //             thu_index=thu_index+1;
    //             return input;
    //         }



    //       }
    //       return '';

    //     }
    // });
</script>
@endsection

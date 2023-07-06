@extends('layouts.giangvien.giangvien')
@section('content')
<h1>THỜI KHÓA BIỂU</h1>
<div ng-app="thoiKhoaBieuGiangVien" ng-controller="ThoiKhoaBieuController">
   
    
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
            <div ng-repeat="lp in tkb.lich|filter:{thu_trong_tuan:count}">
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<script>
    var app = angular.module("thoiKhoaBieuGiangVien", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    app.controller("ThoiKhoaBieuController",function($scope,$http){
        $http( 
          {
            url:'{{env('SERVER_URL')}}/api/giang-vien/thoi-khoa-bieu/{{Session::get('ma_gv')}}',
            method: 'GET',
            headers:{
               "Authorization":"Bearer {{Session::get('access_token_gv')}}" 
            },
          }).then($response=>{
            $scope.thoiKhoaBieu=$response.data;
            console.log($response.data);
      
        });
});
  
</script>
@endsection
@extends('layouts.client.client')
@section('css')
<style>
    .container {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}

h2 {
  font-size: 26px;
  margin: 20px 0;
  text-align: center;
  small {
    font-size: 0.5em;
  }
}

.responsive-table {
  li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .col-1 {
    flex-basis: 10%;
  }
  .col-2 {
    flex-basis: 40%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }

  @media all and (max-width: 767px) {
    .table-header {
      display: none;
    }
    .table-row{

    }
    li {
      display: block;
    }
    .col {

      flex-basis: 100%;

    }
    .col {
      display: flex;
      padding: 10px 0;
      &:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
    }
  }
}
</style>
@endsection
@section('content')
<div ng-app="myApp" ng-controller="DanhSachHocPhiController">
    <h1>Đóng học phí</h1>
    @if(session('error_parameter_request'))
    <p>{{session('error_parameter_request')}}</p>
    @endif
    @if(session('error_server'))
    <p>{{session('error_server')}}</p>
    @endif
    {{-- <form method="POST" enctype="application/x-www-form-urlencoded" action="{{route('xu-ly-thanh-toan-momo-qr')}}" target="_blank">
        @csrf
        <button>Đóng học phí momo QR</button>
    </form>
    <form method="POST" enctype="application/x-www-form-urlencoded" action="{{route('xu-ly-thanh-toan-momo-atm')}}" target="_blank">
        @csrf
        <button>Đóng học phí momo ATM</button>
    </form> --}}
    <div class="container">
        <div class="table-responsive">
            <table class="table">
              <thead >
                <th class="info">Loại học phí</th>
                <th class="info">Tên học phí</th>
                <th class="info">Số tiền</th>
                <th class="info">Thời hạn</th>
                <th class="info">

                      {{-- <input type="checkbox" value="" id="checked_all_hoc_phi">
                     Chọn tất cả --}}
                </th>
              </thead>
              <tbody>
                <tr ng-repeat="hoc_phi_mon in danh_sach_hoc_phi_mon" >
                    <td>
                        Học phí môn học <%hoc_phi_mon.mon_hoc.loai_mon_hoc.ten_loai_mon_hoc%>
                    </td>
                    <td>
                        <%hoc_phi_mon.mon_hoc.mon_hoc.ten_mon_hoc%>
                    </td>
                    <td><%hoc_phi_mon.dang_ky_lop_hoc_phan.tien_dong%></td>
                    <td><%hoc_phi_mon.ngay_mo%> &#8594; <%hoc_phi_mon.ngay_dong%></td>
                    <td><input class="checked_hoc_phi" type="checkbox" value="" data-hoc-phi="<%hoc_phi_mon.dang_ky_lop_hoc_phan.tien_dong%>" data-id-hoc-phi="<%hoc_phi_mon.dang_ky_lop_hoc_phan.id%>" data-type="hoc_phi_mon"></td>
                </tr>
                <tr ng-repeat="hoc_phi_hoc_ky in danh_sach_hoc_phi_hoc_ky">
                    <td>
                        Học phí học kỳ
                    </td>
                    <td>
                        Học kỳ <%hoc_phi_hoc_ky.hoc_phi.hoc_ky%>
                    </td>
                    <td><%hoc_phi_hoc_ky.hoc_phi.so_tien%></td>
                    <td><%hoc_phi_hoc_ky.hoc_phi.ngay_bat_dau%>  &#8594; <%hoc_phi_hoc_ky.hoc_phi.ngay_ket_thuc%></td>
                    <td ng-if="ngayBatDau(hoc_phi_hoc_ky.hoc_phi.ngay_bat_dau) < currentDate && ngayKetThuc(hoc_phi_hoc_ky.hoc_phi.ngay_ket_thuc) > currentDate">
                        <input class="checked_hoc_phi" data-hoc-phi="<%hoc_phi_hoc_ky.hoc_phi.so_tien%>" data-id-hoc-phi="<%hoc_phi_hoc_ky.hoc_phi.id%>" type="checkbox" value="" data-type="hoc_phi_hoc_ky" >
                    </td>
                    <td ng-if="!(ngayBatDau(hoc_phi_hoc_ky.hoc_phi.ngay_bat_dau) < currentDate && ngayKetThuc(hoc_phi_hoc_ky.hoc_phi.ngay_ket_thuc) > currentDate)">
                        Đã kết thúc
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>

        <button id="btn-dong-hoc-phi-paypal">Đóng học phí qua PayPal</button>
        <button id="btn-dong-hoc-phi-vnpay">Đóng học phí qua VNPay</button>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    // var jsonArray={
    //     "id":1,
    //     "type":1,
    //     "ma_gv": "GVCNTT1",
    //     "tieu_de": $("#tieu-de-thong-bao").val(),
    //     "noi_dung":$("#noi-dung-thon-bao").val(),
    //     "danh_sach_sinh_vien":[]
    // }
    // var childSinhVien={
    //     "id_sinh_vien":"0306201537"
    // }
    // jsonArray.danh_sach_sinh_vien.push(childSinhVien);
    // var childSinhVien={
    //     "id_sinh_vien":"0306201573"
    // }

    // console.log(jsonArray);
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    app.controller("DanhSachHocPhiController",function($scope,$http){
        $scope.currentDate = new Date();
        console.log($scope.currentDate);
        $scope.ngayBatDau=function(ngay_bat_dau){
            return new Date(ngay_bat_dau);
        }
        $scope.ngayKetThuc=function(ngay_ket_thuc){
            return new Date(ngay_ket_thuc);
        }
        $http({
            url:"{{env('SERVER_URL')}}/api/danh-sach-dong-hoc-phi-cua-sinh-vien/{{Session::get('ma_sv')}}",
            method:"GET",
            headers:{
                'Authorization':"Bearer {{Session::get('access_token')}}",
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        }).then(response=>{
            $scope.danh_sach_hoc_phi_hoc_ky=response.data.danh_sach_hoc_phi_hoc_ky;
            $scope.danh_sach_hoc_phi_mon=response.data.danh_sach_hoc_phi_mon;
            console.log($scope.danh_sach_hoc_phi_hoc_ky);
            console.log($scope.danh_sach_hoc_phi_mon);
            // console.log(response.data);
        })
    })
    $(document).on('click', '.checked_hoc_phi', function(event){
        var element = $(event.target);
        $('.checked_hoc_phi').not(element).prop('checked', false);
    });
    $(document).ready(function(){

        $("#btn-dong-hoc-phi-paypal").click(function(){

            var $id=0;
            var $type="";
            var $hoc_phi=0;

            $('.checked_hoc_phi').each(function(){

                if($(this).is(":checked")){
                    $id=$(this).attr('data-id-hoc-phi');
                    $type=$(this).attr('data-type');
                    $hoc_phi=$(this).attr('data-hoc-phi');
                }
            });
            // $(".checked_hoc_phi").forEach(element => {
                // var $hocPhi={
                //     "id_hoc_phi":element.data('id-hoc-phi')
                // }
                // if(element.data('type')==="hoc_phi_mon"){
                //     $data.danh_sach_hoc_phi_mon.push($hocPhi);
                // }
                // else{
                //     $data.danh_sach_hoc_phi_hoc_ky.push($hocPhi);
                // }

            // });
            //console.log("id "+$id+" type "+$type);
            $.ajax({
                url:"/dong-hoc-phi-paypal",
                method:"POST",
                data:{id:$id,type:$type,hoc_phi:$hoc_phi},
                headers:{
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }

            }).done(function(dataRequest){
                window.location.href=dataRequest.link;
            })
        })
        $("#btn-dong-hoc-phi-vnpay").click(function(){
        var $id=0;
        var $type="";
        var $hoc_phi=0;

        $('.checked_hoc_phi').each(function(){

            if($(this).is(":checked")){
                $id=$(this).attr('data-id-hoc-phi');
                $type=$(this).attr('data-type');
                $hoc_phi=$(this).attr('data-hoc-phi');
            }
        });
        // $(".checked_hoc_phi").forEach(element => {
            // var $hocPhi={
            //     "id_hoc_phi":element.data('id-hoc-phi')
            // }
            // if(element.data('type')==="hoc_phi_mon"){
            //     $data.danh_sach_hoc_phi_mon.push($hocPhi);
            // }
            // else{
            //     $data.danh_sach_hoc_phi_hoc_ky.push($hocPhi);
            // }

        // });
        //console.log("id "+$id+" type "+$type);
        $.ajax({
            url:"/dong-hoc-phi-vnpay",
            method:"POST",
            data:{id:$id,type:$type,hoc_phi:$hoc_phi},
            headers:{
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }

        }).done(function(dataRequest){
            window.location.href=dataRequest.link;
        })
        })
    })
</script>

@endsection

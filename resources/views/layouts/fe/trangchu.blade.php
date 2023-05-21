@extends("layouts.client.client")
@section('content')
<!-- Alert -->
<div ng-app="myApp" ng-controller="ThongBaoController">


<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Thông báo:</strong> Bạn có một thông báo mới!
</div>
<div class="scrollbar" id="style-5" >
    <div class="force-overflow" >
<!-- Bản thông báo -->
        <div class="row" ng-repeat="thongbao in danh_sach_thong_bao">
            <article class="col-xs-12">
                <div class="media">
                    <div class="media-left">
                        <div >
                            <img class="media-object" src="{{asset('images/mail.png')}}" width="30px"  alt="">
                        </div>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading"><a ng-click="hienThiNoiDungThongBao(thongbao.id)"><%thongbao.tieu_de%></a></h2>
                        <p>Người gửi: <strong><%thongbao.ten_giang_vien%></strong> - Ngày gửi: <%thongbao.ngay_tao|date:'dd/MM/yyyy'%></p>
                    </div>
                </div>
            </article>
        </div>
        <hr>
    </div>
</div>
<hr>
<div style="width:100%">
    <h1>Nội dung</h1>
<div style="width:100%; height: 300px; overflow-y: scroll; border:1px solid black; padding:6px 6px 6px 9px;">
    <%content%>
</div>
</div>
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
    app.controller("ThongBaoController",function($scope,$http){
        var $thongbao;
        $http.get("http://127.0.0.1:8000/api/danh-sach-thong-bao/1").then($response=>{
            $thongbao=$scope.danh_sach_thong_bao=$response.data;
            $scope.content="";
            $scope.hienThiNoiDungThongBao=function($id){
                for (let i = 0; i < $scope.danh_sach_thong_bao.length; i++) {
                    if($scope.danh_sach_thong_bao[i].id==$id){
                        $scope.content=$scope.danh_sach_thong_bao[i].noi_dung;
                        console.log("Dô");
                        console.log($scope.content);
                        break;
                    }

                }
            }
        })



    })
</script>
@endsection

@extends("layouts.client.client")
@section('css')
<style>
.da-doc-thong-bao{
    font-weight: 100
}
.chua-doc-thong-bao{
    font-weight: bold
}
.media-heading{
    cursor: pointer;
}


</style>

@endsection
@section('content')
<!-- Alert -->
<div ng-app="myApp" ng-controller="ThongBaoController">


<div class="alert alert-info alert-dismissible" role="alert" ng-show="HienThiThongBaoCoTinMoi">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Thông báo:</strong> Bạn có <%so_luong_thong_bao_chua_doc%> thông báo mới!
</div>
<div class="col-md-5">
    <div class="scrollbar" id="style-5" >
        <div class="force-overflow" >
    <!-- Bảng thông báo -->
            <div class="row" ng-repeat="thongbao in danh_sach_thong_bao">
                <article class="col-xs-12">
                    <div class="media">
                        <div class="media-left">
                            <div >
                                <img class="media-object" src="{{asset('images/mail.png')}}" width="30px"  alt="">
                            </div>
                        </div>
                        <div class="media-body" >
                            <h2 class="media-heading"><a ng-click="hienThiNoiDungThongBao(thongbao.thong_bao.id)" data-trang-thai-thong-bao="<%thongbao.trang_thai_thong_bao%>" ng-class="classThongBao(thongbao.trang_thai_doc)"><%thongbao.thong_bao.tieu_de%></a></h2>
                            <p>Người gửi: <strong><%thongbao.giang_vien.ten_giang_vien%></strong> - Ngày gửi: <%thongbao.thong_bao.created_at|date:'dd/MM/yyyy'%></p>
                        </div>
                    </div>
                </article>
            </div>
            <hr>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div>
        <h1>Nội dung</h1>
    <div style="width:100%; height: 400px; overflow-y: scroll; border:1px solid black; padding:6px 6px 6px 9px;" ng-bind-html="content">
        {{-- <%content%> --}}
    </div>
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

    app.controller("ThongBaoController",function($scope,$http,$sce){
        var $thongbao;
        $http({
            method:'GET',
            url:"{{env('SERVER_URL')}}/api/danh-sach-thong-bao/{{Session::get('ma_sv')}}",
            headers:{
                'Authorization':"Bearer {{Session::get('access_token')}}",
            }
        }).then($response=>{
            $thongbao=$scope.danh_sach_thong_bao=$response.data;
            console.log($thongbao);
            var $dem_so_thong_bao_chua_doc=0;
            for(let i=0;i<$thongbao.length;i++){
                if($thongbao[i].trang_thai_doc==0){
                    $dem_so_thong_bao_chua_doc=$dem_so_thong_bao_chua_doc+1;
                }
            }
           $scope.so_luong_thong_bao_chua_doc=$dem_so_thong_bao_chua_doc;
            if( $dem_so_thong_bao_chua_doc>0){
                $scope.HienThiThongBaoCoTinMoi=true;
            }else{
                $scope.HienThiThongBaoCoTinMoi=false;
            }

            $scope.content="";
            $scope.hienThiNoiDungThongBao=function($id){
                for (let i = 0; i < $scope.danh_sach_thong_bao.length; i++) {
                    if($scope.danh_sach_thong_bao[i].thong_bao.id==$id){
                        if($scope.danh_sach_thong_bao[i].trang_thai_doc==0){
                            $scope.danh_sach_thong_bao[i].trang_thai_doc=1;
                            $http({
                                method:"POST",
                                url:"{{env('SERVER_URL')}}/api/cap-nhat-trang-thai-da-doc-cua-thong-bao/"+$scope.danh_sach_thong_bao[i].id,
                                headers:{
                                    "Authorization":"Bearer {{Session::get('access_token')}}"
                                }
                            });
                        }
                        $scope.content=$scope.danh_sach_thong_bao[i].thong_bao.noi_dung;
                        $scope.content=$sce.trustAsHtml($scope.content);
                        console.log("Dô");
                        console.log($scope.content);
                        break;
                    }

                }
            }
        });
        $scope.classThongBao=function($trang_thai){
            if($trang_thai==0){
                return "chua-doc-thong-bao";
            }
            return "da-doc-thong-bao";
        }



    })
</script>
@endsection


@extends('layouts.client.client')
@section('content')
<div ng-app="myApp" ng-controller="ChonLopHocPhanController">
    <div class="list-group col-md-3">
        <button type="button" class="list-group-item list-group-item-action active">
            Danh sách lớp học phần
        </button>
        <button type="button" class="list-group-item list-group-item-action"  ng-repeat="mon in data">
            <div ng-click="HienThiLichHoc(mon.id_lop_hoc_phan)">
                    <p style="font-weight:bold ">Mã lớp: </p><%mon.id_lop_hoc_phan%>
                    <p style="font-weight:bold ">Giảng viên: </p><%mon.giang_vien_1%>
                    <p style="font-weight:bold">Giảng viên phụ: </p> <%mon.giang_vien_2%>

              </div>
        </button>
    </div>
    <div class="col-md-9">
        <div class="row">
            <p  class="list-group-item list-group-item-action active" >
                Thời Khóa Biểu
            </p>
        </div>
        <div class="row" ng-bind-html="lich" style="width:100%; height: 300px; overflow-y: scroll; border:1px solid black; padding:6px 6px 6px 9px;">
        </div>
    </div>
    <button type="button" class="btn btn-info">Đăng ký</button>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    var currentURL=window.location.href;
    console.log(currentURL);
    var searchParams =new URLSearchParams(currentURL);
    var $id_mon=searchParams.get('id_mon');
    // var $khoa_hoc=searchParams.get('khoa_hoc');

    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    app.controller("ChonLopHocPhanController",function($scope,$http,$sce){
        $http({
            method:"GET",
            url:"http://127.0.0.1:8000/api/danh-sach-lop-hoc-phan-theo-mon-con-mo/"+$id_mon,
            headers:{
                "Authorization":"Bearer "+$access_token,
            }
        }).then(response=>{
            $scope.data=response.data;
            $scope.lich=$sce.trustAsHtml("<p>Trống</p>");
            console.log($scope.data);
            $scope.refreshHtmlContent = function() {
                // Kiểm tra xem có đang trong quá trình áp dụng ($digest) hay không
                if (!$scope.$$phase && !$scope.isApplyingChanges) {
                // Đánh dấu là đang thực hiện quá trình áp dụng
                $scope.isApplyingChanges = true;

                // Lấy nội dung HTML mới từ nguồn dữ liệu của bạn (ví dụ: từ server)
                var newHtmlContent = '<p>New HTML content</p>';

                // Cập nhật giá trị nội dung HTML
                $scope.htmlContent = newHtmlContent;

                // Thực hiện quá trình áp dụng ($digest)
                $timeout(function() {
                    $scope.isApplyingChanges = false;
                });
            };
            };
            $scope.HienThiLichHoc=function($id_lop_hoc_phan){
                for (let index = 0; index < $scope.data.length; index++) {
                    $scope.lich=$sce.trustAsHtml("<p>Trống</p>");
                    if($scope.data[index].id_lop_hoc_phan==$id_lop_hoc_phan){
                       // $scope.lich=$scope.data[index].lich_hoc;
                       console.log($scope.data[index].lich_hoc);
                       if($scope.data[index].lich_hoc.length>0){
                        var text="";
                        $scope.data[index].lich_hoc.forEach(element => {
                            var thu_trong_tuan=""
                            if(element.thu==1){
                                thu_trong_tuan="Thứ 2";
                            }
                            if(element.thu==2){
                                thu_trong_tuan="Thứ 3";
                            }
                            if(element.thu==3){
                                thu_trong_tuan="Thứ 4";
                            }
                            if(element.thu==4){
                                thu_trong_tuan="Thứ 5";
                            }
                            if(element.thu==5){
                                thu_trong_tuan="Thứ 6";
                            }
                            if(element.thu==6){
                                thu_trong_tuan="Thứ 7";
                            }
                            if(element.thu==7){
                                thu_trong_tuan="Chủ nhật";
                            }
                            text=text+'<div style="border-style: dotted;"><p style="font-weight: 700">Thứ trong tuần: '+thu_trong_tuan+'</p><p>Phòng học: '+element.phong_hoc+'</p><p>Tiết học: Từ '+element.tiet_bat_dau+' đến '+element.tiet_ket_thuc+'</p><p>Thời gian: '+element.thoi_gian_bat_dau+'  đến '+element.thoi_gian_ket_thuc+'</p></div>';
                        });
                        console.log(text);
                        $scope.lich=$sce.trustAsHtml(text);
                        $scope.refreshHtmlContent;
                        //$scope.$apply();
                        break;

                       }

                    }

                }

                //CheckScopeBeforeApply();
            }
        });
        function CheckScopeBeforeApply() {
            if(!$scope.$$phase) {

            }
        };
    })

</script>
@endsection


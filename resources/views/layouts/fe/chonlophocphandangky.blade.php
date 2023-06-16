@extends('layouts.client.client')
@section('css')

@endsection
@section('content')
<div ng-app="myApp" ng-controller="ChonLopHocPhanController" class="rows">
    <div>
        <div class="page-header">
            <h1>Môn :<small><%mon.ten_mon_hoc%></small></h1>
        </div>
        <div class="alert alert-danger"> Trùng lịch</div>
        <div class="alert alert-success">Không trùng lịch</div>

    </div>
    <div class="list-group col-md-4">
        <button type="button" class="list-group-item list-group-item-action active">
            Danh sách lớp học phần
        </button>
        <button type="button" class="list-group-item list-group-item-action"  ng-repeat="mon in data" >
            <div ng-click="HienThiLichHoc(mon.id_lop_hoc_phan,hocKyHienTai,thoiKhoaBieu,danhSachLopHocPhanDangKy,thoiKhoaBieuDangKyLopHocPhan)" >
                   {{-- <span> <p ></p><span></span></span> --}}
                   <div class="row">
                    <div class="col-md-5" style="font-weight:bold ">Mã lớp: </div>
                    <div class="col-md-3 col-md-offset-4"><%mon.id_lop_hoc_phan%></div>
                  </div>
                  <div class="row">
                    <div class="col-md-3" style="font-weight:bold ">Lớp: </div>
                    <div class="col-md-4 col-md-offset-4"><%mon.lop_hoc.ten_lop_hoc%></div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">Giảng viên: </div>
                    <div class="panel-body">
                        <%mon.giang_vien_1%>
                    </div>
                  </div>
                  {{-- <div class="">...</div> --}}
                  <div class="panel panel-info">
                    <div class="panel-heading">Giảng viên phụ: </div>
                    <div class="panel-body">
                        <%mon.giang_vien_2%>
                    </div>
                  </div>

            </div>
        </button>
    </div>
    <div class="col-md-8">

        <div class="row">
            <p  class="list-group-item list-group-item-action active" style="width:150%;">
                Thời Khóa Biểu
            </p>
        </div>
        <div class="row " ng-bind-html="lich" style="width:160%; height: 500px; overflow-y: scroll; border:1px solid black; padding:6px 6px 6px 9px;">
            <div class="table-responsive" >

              </div>
        </div>

    </div>
    <button type="button" class="btn btn-info" ng-click="DangKyLopHocPhan()">Đăng ký</button>
</div>

@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    const currentDate = new Date().toJSON().slice(0, 10);
    console.log(currentDate);
    var currentURL=window.location.href;
    console.log(currentURL);
    var searchParams =new URLSearchParams(currentURL);
    var $id_mon_hoc=searchParams.get('id_mon_hoc');
    // var $khoa_hoc=searchParams.get('khoa_hoc');
    var $arrThu=["Thứ 2","Thứ 3", "Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"];
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });

    app.controller("ChonLopHocPhanController",function($scope,$http,$sce){
        $scope.id_lop_hoc_phan_dang_chon=0;
        $scope.trung_lich=false;
        $scope.ket_thuc_chuong_trinh=false;
        $http({
            method:'GET',
            url:'{{env('SERVER_URL')}}/api/thoi-khoa-bieu-cua-sinh-vien-dang-ky-lop-hoc-phan/{{Session::get('ma_sv')}}',
            headers:{
                'Authorization':"Bearer {{Session::get('access_token')}}",
            }
        }).then($response=>{
            $scope.thoiKhoaBieuDangKyLopHocPhan=$response.data;
            console.log($scope.thoiKhoaBieuDangKyLopHocPhan);
        });
        $http({
            method: "GET",
            url: "{{env('SERVER_URL')}}/api/danh-sach-lop-dang-ky/{{Session::get('ma_sv')}}",
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).then(response=>{
            $scope.danhSachLopHocPhanDangKy=response.data.lop_dang_ky;
        })
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/qua-trinh-hoc-tap-cua-sinh-vien/{{Session::get('ma_sv')}}",
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).then(response=>{
            $scope.qua_trinh_hoc_tap=response.data.qua_trinh_hoc_tap;
            if($scope.qua_trinh_hoc_tap.thoi_gian_ket_thuc<currentDate){
                $scope.ket_thuc_chuong_trinh=true;
            }
        })
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/hoc-ky-hien-tai-cua-sinh-vien/{{Session::get('ma_sv')}}",
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).then(response=>{
            $scope.hocKyHienTai=response.data.hoc_ky_hien_tai;

        })
        $http({
            method:'GET',
            url:'{{env('SERVER_URL')}}/api/thoi-khoa-bieu-cua-sinh-vien/{{Session::get('ma_sv')}}',
            headers:{
                'Authorization':"Bearer {{Session::get('access_token')}}",
            }
        }).then($response=>{
            $scope.thoiKhoaBieu=$response.data;

        });
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/mon-hoc/"+$id_mon_hoc,
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).then(response=>{
            $scope.mon=response.data;
        })
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/danh-sach-lop-hoc-phan-theo-mon-con-mo/"+$id_mon_hoc,
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).then(response=>{
            //console.log(response.data);
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

            $scope.HienThiLichHoc=function($id_lop_hoc_phan,$hoc_ky_hien_tai,$thoi_khoa_bieu_cua_sinh_vien,$danhSachLopHocPhanDangKy,$thoiKhoaBieuDangKyLopHocPhan){
                console.log($hoc_ky_hien_tai);
                console.log("thoi khoa bieu cua sinh vien");
                console.log($thoi_khoa_bieu_cua_sinh_vien);
                console.log("danh sach lop hoc phan dang ky");
                console.log($danhSachLopHocPhanDangKy);
                console.log("thoi khoa bieu dang ky lop hoc phan");
                console.log($thoiKhoaBieuDangKyLopHocPhan);

                for (let index = 0; index < $scope.data.length; index++) {
                    $scope.lich=$sce.trustAsHtml("<p>Trống</p>");
                    if($scope.data[index].id_lop_hoc_phan==$id_lop_hoc_phan){
                       // $scope.lich=$scope.data[index].lich_hoc;
                       $scope.id_lop_hoc_phan_dang_chon=$id_lop_hoc_phan;
                       console.log($scope.data[index].lich_hoc);
                       if($scope.data[index].lich_hoc.length>0){
                            var text='<h3>Mã lớp: <span class="label label-success">'+$id_lop_hoc_phan+'</span></h3>';
                            for(let i=0;i<7;i++){
                                var thu_trong_tuan=$arrThu[i];

                                var textTemp=text;
                                text=text+'<div class="alert alert-warning">'+thu_trong_tuan+'</div>'+'<table class="table">';
                                $demLichTrungThu=0;
                                $scope.data[index].lich_hoc.forEach(element => {

                                if(element.thu==i+1){
                                    classtr='class="alert alert-success"';
                                    $scope.trung_lich=false;
                                    $thoiKhoaBieuDangKyLopHocPhan.forEach(elementThoiKhoaBieu => {
                                        if(elementThoiKhoaBieu.thu_trong_tuan==element.thu){
                                            elementThoiKhoaBieu.lich_hoc.forEach(elementMonHoc => {
                                                elementMonHoc.lich_hoc.forEach(elementLichHoc => {
                                                    var start = element.tiet_bat_dau;
                                                    var end = element.tiet_ket_thuc;
                                                    var arrayLich1 = Array.from({ length: end - start + 1 }, (_, index) => index + start);
                                                    console.log(arrayLich1);
                                                    var start = elementLichHoc.tiet_bat_dau.stt;
                                                    var end = elementLichHoc.tiet_ket_thuc.stt;
                                                    var arrayLich2 = Array.from({ length: end - start + 1 }, (_, index) => index + start);

                                                    if(arrayLich1.some(element => arrayLich2.includes(element)))
                                                    {
                                                        console.log("Dô");
                                                        classtr='class="alert alert-danger"';
                                                        $scope.trung_lich=true;
                                                    }
                                                });
                                            });
                                        }
                                    });
                                    $danhSachLopHocPhanDangKy.forEach(elementLopHocPhanDangKy => {
                                            elementLopHocPhanDangKy.lich.forEach(elementLich=>{
                                                if(elementLich.thu_trong_tuan==element.thu){
                                                    var start = element.tiet_bat_dau;
                                                    var end = element.tiet_ket_thuc;
                                                    var arrayLich1 = Array.from({ length: end - start + 1 }, (_, index) => index + start);
                                                    console.log(arrayLich1);
                                                    var start = elementLich.tiet_bat_dau.stt;
                                                    var end = elementLich.tiet_ket_thuc.stt;
                                                    var arrayLich2 = Array.from({ length: end - start + 1 }, (_, index) => index + start);

                                                    if(arrayLich1.some(element => arrayLich2.includes(element)))
                                                    {
                                                        console.log("Dô");
                                                        classtr='class="alert alert-danger"';
                                                        $scope.trung_lich=true;
                                                    }
                                                }

                                            })
                                        });
                                    if($scope.ket_thuc_chuong_trinh==false){
                                        $thoi_khoa_bieu_cua_sinh_vien.forEach(elementThoiKhoaBieu => {
                                            elementThoiKhoaBieu.lich.forEach(elementLich => {
                                                if(element.thu==elementLich.thu_trong_tuan&&elementLich.hoc_ky==$hoc_ky_hien_tai){
                                                    var start = element.tiet_bat_dau;
                                                    var end = element.tiet_ket_thuc;
                                                    var arrayLich1 = Array.from({ length: end - start + 1 }, (_, index) => index + start);
                                                    console.log(arrayLich1);
                                                    var start = elementLich.tiet_bat_dau;
                                                    var end = elementLich.tiet_ket_thuc;
                                                    var arrayLich2 = Array.from({ length: end - start + 1 }, (_, index) => index + start);
                                                    if(arrayLich1.some(element => arrayLich2.includes(element)))
                                                    {
                                                        console.log("Dô");
                                                        classtr='class="alert alert-danger"';
                                                        $scope.trung_lich=true;
                                                    }
                                                }


                                            });
                                        });

                                    }

                                    text=text+'<tr '+classtr+'><td style="font-weight:bold;">Phòng học:</td><td>'+element.phong_hoc+'</td><td style="font-weight:bold;">Tiết học:</td><td> Từ '+element.tiet_bat_dau+' đến '+element.tiet_ket_thuc+'</td><td style="font-weight:bold;">Thời gian:</td><td>'+element.thoi_gian_bat_dau+'  đến '+element.thoi_gian_ket_thuc+'</td></tr>'
                                // text=text+'</p><p>Phòng học: '+element.phong_hoc+'</p><p>Tiết học: Từ '+element.tiet_bat_dau+' đến '+element.tiet_ket_thuc+'</p><p>Thời gian: '+element.thoi_gian_bat_dau+'  đến '+element.thoi_gian_ket_thuc+'</p></div>';
                                    $demLichTrungThu=$demLichTrungThu+1;
                                }

                                });
                                if($demLichTrungThu==0){
                                    text=textTemp;
                                }else{
                                    text=text+"</table>"
                                }

                            }

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
            $scope.DangKyLopHocPhan=function(){

                if($scope.trung_lich==false){
                    $http({
                    method:"GET",
                    url:"{{env('SERVER_URL')}}/api/kiem-tra-mon-hoc-cua-lop-hoc-phan-dang-ky",
                    params:{
                        "id_mon_hoc":$id_mon_hoc,
                        "ma_sv":"{{Session::get('ma_sv')}}"
                    },
                    headers:{
                        "Authorization":"Bearer {{Session::get('access_token')}}"
                    }
                    }).then(function(response){
                        if(response.data.status==1){
                                Swal.fire({
                                title: 'Sinh viên có chắc là đăng ký lớp học phần có mã là '+$scope.id_lop_hoc_phan_dang_chon+'?',
                                showDenyButton: true,
                                //showCancelButton: true,
                                confirmButtonText: 'Có',
                                denyButtonText: `Không`,
                                }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    $http({
                                        method:"POST",
                                        url:"{{env('SERVER_URL')}}/api/them-dang-ky-lop-hoc-phan",
                                        params:{
                                            "ma_sv":"{{Session::get('ma_sv')}}",
                                            "id_mon_hoc":$id_mon_hoc,
                                            "id_lop_hoc_phan":$scope.id_lop_hoc_phan_dang_chon
                                        },
                                        headers:{
                                            "Authorization":"Bearer {{Session::get('access_token')}}",
                                        }
                                    }).then(function(data){
                                        Swal.fire('Thành công!', 'Đăng ký lớp học phần thành công, xin vui lòng liên hệ với phòng đào tạo để đóng học phí', 'success')
                                    });

                                } else if (result.isDenied) {
                                    Swal.fire('Changes are not saved', '', 'info')
                                }
                                })
                            }
                            else{
                                Swal.fire('Đã đăng ký lớp có môn học này rồi!');
                            }
                        });
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Hủy đăng ký...',
                    text: 'Lịch học của lớp học phần trùng với thời khóa biểu hiện tại!',

                    })
                }

            }
        });
        function CheckScopeBeforeApply() {
            if(!$scope.$$phase) {

            }
        };
    })
    // $(document).ready(function(){
    //     $('#dang-ky').click(function(){
    //         console.log($id_lop_hoc_phan_dang_chon);
    //     })
    // })

</script>
@endsection


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

    <div class="col-md-5 ">
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
    </div>
    <div class="col-md-7" style="">
        <div style=" width:170%;">
            <p>Danh sách lớp đăng ký chờ duyệt</p>
            <div style="width:100%; height: 500px; overflow-y: scroll; border:1px solid black; padding:6px 6px 6px 9px;">
                <table class="table table-hover" id="thoi-khoa-bieu">
                    {{-- <tr>
                        <td>
                            <strong>Thông tin lớp</strong>
                            <p>Mã lớp:</p>
                            <p>Giảng viên:</p>
                            <p>Giảng viên phụ:</p>
                            <button>Hủy đăng ký</button>
                        </td>
                        <td>
                            <strong>Lịch học</strong>
                            <p>Thứ</p>
                            <table class="table">
                                <tr>
                                    <th>Phòng học</th>
                                    <th>Thời gian</th>
                                </tr>
                            </table>

                        </td>

                    </tr> --}}
                </table>
            </div>

        </div>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    //$khoa_hoc=2020;
    $(document).ready(function(){
        $.ajax({
        method: "GET",
        url: "{{env('SERVER_URL')}}/api/danh-sach-dang-ky-mon-cua-sinh-vien/{{Session::get('id_sinh_vien')}}",
        headers:{
            "Authorization":"Bearer {{Session::get('access_token')}}",
        }
        })
        .done(function( data ) {
            $arr=data.dang_sach_mon_no;
            console.log($arr);
            $arr.forEach(item => {
                var mon_hoc='<p style="font-size:1.5em; font-weight: bold;">'+item.ten_mon_hoc+'</p>';
                $("#ds-mon-dang-ky").append(mon_hoc);
                $.ajax({
                method: "GET",
                url: "{{env('SERVER_URL')}}/api/mo-dang-ky-mon?id_mon_hoc="+item.id_mon_hoc+"&id_sinh_vien="+{{Session::get('id_sinh_vien')}},
                headers:{
                    "Authorization":"Bearer {{Session::get('access_token')}}",
                }
                }).done(function(data_info){
                    //console.log(data_info);
                    //$thong_tin_dang_ky=JSON.parse(data_info);
                    $thong_tin_dang_ky=data_info;
                    //console.log($thong_tin_dang_ky);
                    if($thong_tin_dang_ky.trang_thai==1){
                        var ngay_mo="<p>Ngày mở: "+$thong_tin_dang_ky.mo_dang_ky+"&#9;Ngày đóng: "+$thong_tin_dang_ky.dong_dang_ky+"</p>"
                        var nutDangKy='<br><button type="button" class="btn btn-success nut-dang-ky-mon" data-id_mon_hoc="'+item.id_mon_hoc+'">Đăng ký môn</button>';
                        $("#ds-mon-dang-ky").append(ngay_mo,nutDangKy);
                    }else{
                        $("#ds-mon-dang-ky").append("<p>Chưa mở đăng ký</p>")
                    }
                })
            });

        });
        $.ajax({
            method: "GET",
            url: "{{env('SERVER_URL')}}/api/danh-sach-lop-dang-ky/{{Session::get('id_sinh_vien')}}",
            headers:{
                "Authorization":"Bearer {{Session::get('access_token')}}",
            }
        }).done(function(data){
            $lichHoc=data.lop_dang_ky;
            console.log(data);
            var $arrThu=["Thứ 2","Thứ 3", "Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"];
            var $strHtml="";
            for(let i=0;i<$lichHoc.length;i=i+1){
                console.log($lichHoc[i]);
                var $tenGiangVien1=$lichHoc[i].giang_vien_1!=null?$lichHoc[i].giang_vien_1.ten_gv:'Trống';
                var $tenGiangVien2=$lichHoc[i].giang_vien_2!=null?$lichHoc[i].giang_vien_2.ten_gv:'Trống';


                var $buttonHuyDangKy=$lichHoc[i].cho_phep_huy_dang_ky?'</p><button class="huy-dang-ky-mon" data-id-dang-ky="'+$lichHoc[i].id+'" data-id-mon-hoc="'+$lichHoc[i].mon_hoc.id_mon_hoc+'" data-id-sinh-vien="'+{{Session::get('id_sinh_vien')}}+'">Hủy đăng ký</button></td>':'';
                var $tdThongTinLopHoc='<td><strong>Thông tin lớp</strong><p>Mã lớp:'+$lichHoc[i].id_lop_hoc_phan+'</p><p>Lớp: '+$lichHoc[i].lop_hoc.ten_lop_hoc+'</p><p>Môn: '+$lichHoc[i].mon_hoc.ten_mon_hoc+'</p><p>Giảng viên: '+$tenGiangVien1+'</p><p>Giảng viên phụ:'+$tenGiangVien2+$buttonHuyDangKy;
                var $tdThoiKhoaBieu='<td><strong>Lịch học</strong>';
                var $tableThoiKhoaBieu
                var $tdThoiKhoaBieuThem="";
                if($lichHoc[i].lich.length>1){

                    for(let j=0;j<7;j=j+1){
                        var count=0;
                        $tdThoiKhoaBieuThemTemp=$tdThoiKhoaBieuThem;
                        var $thu='<p>Thứ: '+$arrThu[j]+'</p>';
                        $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThem+$thu+'<table class="table"><tr><th>Phòng học:</th><th>Thời gian</th></tr>';
                            for(let k=0;k<$lichHoc[i].lich.length;k=k+1){
                                if($lichHoc[i].lich[k].thu_trong_tuan==j+1){
                                    console.log($lichHoc[i].lich[k]);
                                    count=count+1;
                                    $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThem+'<tr><td>'+$lichHoc[i].lich[k].phong_hoc.ten_phong_hoc+'</td><td><p>Tiết học: '+$lichHoc[i].lich[k].tiet_bat_dau.stt+' -> '+$lichHoc[i].lich[k].tiet_ket_thuc.stt+'</p><p>Thời gian: '+$lichHoc[i].lich[k].tiet_bat_dau.thoi_gian_bat_dau+' -> '+$lichHoc[i].lich[k].tiet_bat_dau.thoi_gian_ket_thuc+'</p></td></tr>';
                                }
                            }

                        if(count==0){
                            $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThemTemp;
                        }else{
                            $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThem+'</table>'
                        }
                    }
                }
                $tdThoiKhoaBieu=$tdThoiKhoaBieu+$tdThoiKhoaBieuThem+'</td>';
                console.log($tdThoiKhoaBieu);
                $strEnd=$tdThongTinLopHoc+$tdThoiKhoaBieu;
                $('#thoi-khoa-bieu').append($strEnd);

            }
        });
    });

    $(document).on('click', '.nut-dang-ky-mon', function(event){
        var element = $(event.target);
        console.log(element.data("id_mon_hoc"));
        window.location.href='/chon-lop-dang-ky-mon?type=dang_ky_lop&id_mon='+element.data("id_mon_hoc");
    });
    $(document).on('click', '.huy-dang-ky-mon', function(event){
        var element = $(event.target);
        $id_mon_hoc=element.data("id-mon-hoc");
        $id_dang_ky=element.data("id-dang-ky");

        console.log($id_mon_hoc);
        console.log($id_dang_ky);

        Swal.fire({
        title: 'Sinh viên có chắc muốn hủy đăng ký?',
        text: "Đăng ký sẽ được hủy!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            method:"POST",
            url:"{{env('SERVER_URL')}}/api/huy-dang-ky-lop-hoc-phan",
            data:{
                "id_sinh_vien":{{Session::get('id_sinh_vien')}},
                "id_mon_hoc":$id_mon_hoc,
                "id_dang_ky":$id_dang_ky
            },
            headers:{
            "Authorization":"Bearer {{Session::get('access_token')}}",
            }
            }).done(function(data){
                if(data.status==1){
                    console.log("Hủy xong");
                    Swal.fire(
                    'Đã hủy!',
                    'Đã hủy đăng ký lớp học phần.',
                    'success'
                    )
                    window.location.reload();
                }
            });


        }
        })

        //window.location.href='/chon-lop-dang-ky-mon?type=dang_ky_lop&id_mon='+element.data("id_mon_hoc")+'&id_sinh_vien='+$id_sinh_vien;
    });
</script>
{{-- <script>
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });

    app.controller("DangKyHocPhanController",function($scope,$http){
        $http.get("{{env('SERVER_URL')}}/api/danh-sach-dang-ky-mon-cua-sinh-vien/2").then($response=>{
            $scope.monRot=$response.data;
            console.log($scope.monRot);

        })
        $scope.HienThiButtonDangKy=function($id,$khoa_hoc){
                $http.get('{{env('SERVER_URL')}}/api/danh-sach-dang-ky-mon-cua-sinh-vien/2').then($response=>{
                    console.log($id);
                })
            }
    })
</script> --}}
@endsection
{{-- <td>
    <div>
        <strong>Lịch học</strong>
        <p>Thứ: Thứ 2</p>
        <table class="table">
            <tr>
                <th>Phòng học:</th>
                <th>Thời gian</th>
            </tr>
            <tr>
                <td>F7.14</td>
                <td>
                    <p>Tiết học: 4 -> 6</p>
                    <p>Thời gian: 09:05:00 -> 09:50:00</p>
                </td>
            </tr>
            <tr>
                <td>F7.3</td>
                <td>
                    <p>Tiết học: 6 -> 7</p>
                    <p>Thời gian: 10:45:00 -> 11:30:00</p>
                </td>
            </tr>
            <p>Thứ: Thứ 4</p>
            <table class="table">
                <tr>
                    <th>Phòng học:</th>
                    <th>Thời gian</th>
                </tr>
                <tr>
                    <td>F7.3</td>
                    <td>
                        <p>Tiết học: 1 -> 3</p>
                        <p>Thời gian: 06:30:00 -> 07:15:00</p>
                    </td>
                </tr>
            </table>
        </div>
    </td> --}}

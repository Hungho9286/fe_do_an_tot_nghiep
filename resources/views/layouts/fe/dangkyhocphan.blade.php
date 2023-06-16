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
            <div class="alert alert-info" role="alert"><h2>Danh sách môn học nợ</h2></div>

            <div id="ds-dang-ky-mon-no">
                <div >

                </div>
            </div>
            <div class="alert alert-info" role="alert"><h2>Môn tín chỉ</h2></div>

            <div id="ds-dang-ky-mon-chung-chi">
                <div >

                </div>
            </div>
        </div>

    </div>
    <div class="col-md-7" style="">
        <div style=" width:170%;">
            <p>Danh sách lớp đăng ký chờ duyệt</p>
            <div style="width:100%; height: 500px; overflow-y: scroll; border:1px solid black; padding:6px 6px 6px 9px;">
                <table class="table" id="thoi-khoa-bieu">
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

                    </tr>
                    <tr>
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
        url: "{{env('SERVER_URL')}}/api/danh-sach-dang-ky-mon-cua-sinh-vien/{{Session::get('ma_sv')}}",
        headers:{
            "Authorization":"Bearer {{Session::get('access_token')}}",
        }
        })
        .done(function( data ) {
            $arr=data.dang_sach_mon_no;
            $arrMonChungChi=data.danh_sach_mon_hoc_chung_chi;
            console.log($arr);
            $arr.forEach(item => {
                var mon_hoc='<p style="font-size:1.5em; font-weight: bold;">'+item.ten_mon_hoc+'</p>';
                $("#ds-dang-ky-mon-no").append(mon_hoc);
                $.ajax({
                method: "GET",
                url: "{{env('SERVER_URL')}}/api/mo-dang-ky-mon?id_mon_hoc="+item.id_mon_hoc+"&ma_sv={{Session::get('ma_sv')}}",
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
                        $("#ds-dang-ky-mon-no").append(ngay_mo,nutDangKy);
                    }else{
                        $("#ds-dang-ky-mon-no").append("<p>Chưa mở đăng ký</p>")
                    }
                })
            });
            $arrMonChungChi.forEach(item => {
                var mon_hoc='<p style="font-size:1.5em; font-weight: bold;">'+item.ten_mon_hoc+'</p>';
                $("#ds-dang-ky-mon-chung-chi").append(mon_hoc);
                $.ajax({
                method: "GET",
                url: "{{env('SERVER_URL')}}/api/mo-dang-ky-mon?id_mon_hoc="+item.id_mon_hoc+"&ma_sv={{Session::get('ma_sv')}}",
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
                        $("#ds-dang-ky-mon-chung-chi").append(ngay_mo,nutDangKy);
                    }else{
                        $("#ds-dang-ky-mon-chung-chi").append("<p>Chưa mở đăng ký</p>")
                    }
                })
            });

        });
        $.ajax({
            method: "GET",
            url: "{{env('SERVER_URL')}}/api/danh-sach-lop-dang-ky/{{Session::get('ma_sv')}}",
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
                var $tenGiangVien1=$lichHoc[i].giang_vien_1!=null?$lichHoc[i].giang_vien_1.ten_giang_vien:'Trống';
                var $tenGiangVien2=$lichHoc[i].giang_vien_2!=null?$lichHoc[i].giang_vien_2.ten_giang_vien:'Trống';
                var $buttonHuyDangKy="";
                if($lichHoc[i].da_dong_tien==1){
                    $buttonHuyDangKy='</p><span  class="label label-success">Chờ duyệt</span >';
                }
                else{
                    $buttonHuyDangKy=$lichHoc[i].cho_phep_huy_dang_ky?'</p><button class="huy-dang-ky-mon" data-id-dang-ky="'+$lichHoc[i].id+'" data-id-mon-hoc="'+$lichHoc[i].mon_hoc.id_mon_hoc+'" data-id-sinh-vien="'+{{Session::get('ma_sv')}}+'">Hủy đăng ký</button>':'';
                }
                if($lichHoc[i].lop_hoc==null){
                    var $tdThongTinLopHoc='<td><strong>Thông tin lớp</strong><p>Mã lớp:'+$lichHoc[i].id_lop_hoc_phan+'</p><p>Môn: '+$lichHoc[i].mon_hoc.ten_mon_hoc+'</p><p>Giảng viên: '+$tenGiangVien1+'</p><p>Giảng viên phụ:'+$tenGiangVien2+$buttonHuyDangKy+'</td>';
                }else{
                    var $tdThongTinLopHoc='<td><strong>Thông tin lớp</strong><p>Mã lớp:'+$lichHoc[i].id_lop_hoc_phan+'</p><p>Lớp: '+$lichHoc[i].lop_hoc.ten_lop_hoc+'</p><p>Môn: '+$lichHoc[i].mon_hoc.ten_mon_hoc+'</p><p>Giảng viên: '+$tenGiangVien1+'</p><p>Giảng viên phụ:'+$tenGiangVien2+$buttonHuyDangKy+'</td>';
                }
                var $tdThoiKhoaBieu='<td><strong>Lịch học</strong>';
                var $tableThoiKhoaBieu
                var $tdThoiKhoaBieuThem="";
                if($lichHoc[i].lich.length>=1){

                    for(let j=0;j<7;j=j+1){
                        var count=0;
                        $tdThoiKhoaBieuThemTemp=$tdThoiKhoaBieuThem;
                        var $thu='<p>Thứ: '+$arrThu[j]+'</p>';
                        console.log("Dô vòng thứ");
                        $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThem+$thu+'<table class="table"><tr><th>Phòng học:</th><th>Thời gian</th></tr>';
                            for(let k=0;k<$lichHoc[i].lich.length;k=k+1){
                                if($lichHoc[i].lich[k].thu_trong_tuan==j+1){
                                    console.log($lichHoc[i].lich[k]);
                                    console.log("Dô cộng chuỗi");
                                    count=count+1;
                                    $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThem+'<tr><td>'+$lichHoc[i].lich[k].phong_hoc.ten_phong_hoc+'</td><td><p>Tiết học: '+$lichHoc[i].lich[k].tiet_bat_dau.stt+' -> '+$lichHoc[i].lich[k].tiet_ket_thuc.stt+'</p><p>Thời gian: '+$lichHoc[i].lich[k].tiet_bat_dau.thoi_gian_bat_dau+' -> '+$lichHoc[i].lich[k].tiet_bat_dau.thoi_gian_ket_thuc+'</p></td></tr>';
                                }
                            }

                        if(count==0){
                            $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThemTemp;
                        }else{
                            $tdThoiKhoaBieuThem=$tdThoiKhoaBieuThem+"</table>";
                        }
                    }
                }
                $tdThoiKhoaBieu=$tdThoiKhoaBieu+$tdThoiKhoaBieuThem+'</td>';
                console.log($tdThoiKhoaBieu);
                $strEnd="<tr>"+$tdThongTinLopHoc+$tdThoiKhoaBieu+"</tr>";
                console.log($strEnd);
                $('#thoi-khoa-bieu').append($strEnd);

            }
        });
    });

    $(document).on('click', '.nut-dang-ky-mon', function(event){
        var element = $(event.target);
        console.log(element.data("id_mon_hoc"));
        window.location.href='/chon-lop-dang-ky-mon?type=dang_ky_lop&id_mon_hoc='+element.data("id_mon_hoc");
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
                ma_sv:"{{Session::get('ma_sv')}}",
                id_mon_hoc:$id_mon_hoc,
                id_dang_ky:$id_dang_ky
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

        //window.location.href='/chon-lop-dang-ky-mon?type=dang_ky_lop&id_mon='+element.data("id_mon_hoc")+'&ma_sv='+$ma_sv;
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

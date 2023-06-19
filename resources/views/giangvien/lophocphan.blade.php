@extends('layouts.giangvien.giangvien')

@section('css')
    <style>
        .div-post {
            width: 1000px;
        }

        @media only screen and (width <=1600px) {

            .div-post,
            .div-infor,
                {
                max-width: 90%;
            }
        }

        @media only screen and (width <=1400px) {

            .div-post,
            .div-infor {
                max-width: 80%;
            }
        }

        @media only screen and (width <=1280px) {

            .div-post,
            .div-infor {
                max-width: 70%;
            }
        }

        @media only screen and (width <=1024px) {

            .div-post,
            .div-infor {
                max-width: 55%;
            }
        }

        @media only screen and (width <=800px) {

            .div-post,
            .div-infor {
                max-width: 42%;
            }
        }

        @media only screen and (width <=600px) {

            .div-post,
            .div-infor {
                max-width: 27%;
            }
        }

        @media only screen and (width <=400px) {

            .div-post,
            .div-infor {
                max-width: 15%;
            }
        }

        @media only screen and (width <=200px) {

            .div-post,
            .div-infor {
                max-width: 7%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container" ng-app="myApp" ng-controller="DanhSachSinhVienTheoLopHocPhanController">

        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true"> Thông Báo </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false"> Danh sách sinh viên </button>

                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">


                            <div class="div-post">

                                <button class="btn btn-primary" id="togglePostButton" onclick="togglePostForm()">Thông báo
                                    nội dung nào đó cho lớp học của bạn</button>
                                <div id="postForm" style="display: none">


                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Danh sách sinh viên
                                        </button>

                                        <ul class="dropdown-menu"  id="checkboxList" aria-labelledby="dropdownMenuButton">
                                          <li >
                                            <label class="dropdown-item">
                                                <input type="checkbox" id="checkbox-all" class="form-check-input checkbox-item"> Tất cả sinh viên
                                            </label>
                                        </li>
                                        <li >
                                            <label class="dropdown-item">
                                                <input type="checkbox" id="checkbox-all" class="form-check-input checkbox-item"> Tất cả sinh viên1
                                            </label>
                                        </li>
                                        <li >
                                            <label class="dropdown-item">
                                                <input type="checkbox" id="checkbox-all" class="form-check-input checkbox-item"> Tất cả sinh viên2
                                            </label>
                                        </li>
                                            <li ng-repeat="sinhVien in lopHocPhan.danh_sach_sinh_vien">
                                                <label class="dropdown-item">
                                                    <input type="checkbox" class="form-check-input checked-sv checkbox-item"
                                                        data-ma-sv='<%sinhVien.ma_sv%>'> <%sinhVien.ma_sv%> -
                                                    <%sinhVien.ten_sinh_vien%>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>

                                    <br>
                                    <form id="form_post" action="" method="post">
                                        <div class="row-1">
                                            <div class="input-group">
                                                <span class="input-group-text">Tiêu đề</span>
                                                <input id="tieu_de_post" type="text" name="tieu_de" class="form-control"
                                                    required>
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <textarea class="noi_dung" id="summernote_post" name="noi_dung" data-noi-dung="" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary"
                                                id="btn-dang-thong-bao">Đăng</button>
                                            <button class="btn btn-primary" id="togglePostButton"
                                                onclick="togglePostForm()">Huỷ</button>

                                        </div>
                                    </form>


                                </div>

                                <div ng-repeat="tb in thongbao ">
                                    <div class="status-field-container write-post-container">
                                        <div class="user-profile-box">
                                            <div class="user-profile">
                                                <img src="<%tb.hinh_anh_dai_dien%>" alt="">
                                                <div>
                                                    <p><%tb.ten_giang_vien%></p>
                                                    <small><%tb.ngay_tao%></small>
                                                    <div data-post-id="<%tb.id%>"></div>
                                                </div>
                                            </div>
                                            <div>

                                                <div class="dropdown no-arrow">
                                                    <div class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right shadow "
                                                        aria-labelledby="userDropdown">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#suathongbao" ng-click='noi_dung_tb(tb)'>
                                                            <i
                                                                class="fa fa-pencil-square-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Sửa thông báo
                                                        </a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#xoathongbao" href="#">
                                                            <i class="fa fa-trash-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Xoá thông báo
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="status-field">
                                            <h3 data-tieu-de='<%tb.tieu_de%>'><%tb.tieu_de%></h3>
                                            <p ng-bind-html="trustHtml(tb.noi_dung)"></p>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#suathongbao" ng-click='noi_dung_tb(tb)'>
                                            <i
                                                class="fa fa-pencil-square-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Sửa thông báo
                                        </a>
                                        </div>

                                    </div>
                                </div>




                            </div>

                        </div>
                        <div class="tab-pane fade div-infor" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab" style="width:1000px">
                            <div>

                                <ul class="list-group">
                                    <li class="list-group-item" ng-repeat="sinhVien in lopHocPhan.danh_sach_sinh_vien">
                                        <div class="row justify-content-around">
                                            <div class="col-8">
                                                <div>MSSV: <%sinhVien.ma_sv%></div>
                                                <div>Lớp: CĐTH20F</div>
                                                <div>Email: <%sinhVien.email%></div>
                                                <div>Tên: <%sinhVien.ten_sinh_vien%></div>
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-success"
                                                    ng-click="XemThongTinSinhVien(sinhVien.ma_sv)">Xem thông tin</button>
                                                <button type="button" class="btn btn-primary"
                                                    ng-click="XemDiemSinhVien(sinhVien.ma_sv)">Xem điểm</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
                {{-- pop up delete post --}}
                <!-- Button trigger modal -->


                <!-- Modal -->
                <form action="" method="get">
                    <div class="modal fade" id="xoathongbao" tabindex="1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Xoá thông báo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc là xoá thông báo này
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                    <button type="button" class="btn btn-primary" id="btn-xoa-thong-bao">Xoá thông
                                        báo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <!-- Modal -->

                    <div class="modal fade" id="suathongbao" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Thông báo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Danh sách sinh viên
                                    </button>

                                    <ul class="dropdown-menu" id="checkboxList_modal"
                                        aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" id="checkbox-all"
                                                    class="form-check-input checkbox-item_modal"> Tất cả sinh viên
                                            </label>
                                        </li>
                                        {{-- <li ng-repeat="sinhVien in lopHocPhan.danh_sach_sinh_vien">
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="form-check-input checked-sv checkbox-item_modal"
                                                    data-ma-sv='<%sinhVien.ma_sv%>'> <%sinhVien.ma_sv%> -
                                                <%sinhVien.ten_sinh_vien%>
                                            </label>
                                        </li> --}}
                                    </ul>
                                </div>

                                <br>

                                <div class="row-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Tiêu đề</span>
                                        <input id="tieu_de_modal"  type="text" name="tieu_de" value="<%tieu_de%>" class="form-control" >

                                    </div>
                                    <br>
                                    <div class="mb-3">
                                        {{-- <div class="noi_dung" id="summernote_modal" ng-model="noi_dung"></div> --}}
                                        {{-- <textarea class="noi_dung" id="summernote_post" name="noi_dung" data-noi-dung="" required></textarea> --}}
                                        <textarea class="noi_dung" id="summernote_modal" name="noi_dung_modal" ></textarea>
                                    </div>


                                </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button value="" type="submit" class="btn btn-primary" id="btn-luu-thay-doi-thong-bao">Lưu thay đổi</button>
                                </div>

            </div>
        </div>
    </div>





                <script>

                    $('#summernote_post').summernote({
                        placeholder: 'Thông báo nội dung nào đó cho lớp học của bạn',
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['insert', ['link']],
                        ],


                    });
                    $('#summernote_modal').summernote({
                        placeholder: 'Thông báo nội dung nào đó cho lớp học của bạn',
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['insert', ['link']],
                        ],


                    });
                </script>



@endsection
            @section('js')
                <script src="{{ asset('giangvien/js/view/view.js') }}"></script>
                <script src="https://pagead2.googlesyndication.com/pagead/managed/js/adsense/m202305300101/show_ads_impl_fy2021.js"
                    id="google_shimpl"></script>
                <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                </script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                    crossorigin="anonymous">
            {{-- @section('js') --}}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
                <script>
                    var app = angular.module("myApp", [], function($interpolateProvider) {
                        $interpolateProvider.startSymbol('<%');
                        $interpolateProvider.endSymbol('%>');
                    });

        app.controller("DanhSachSinhVienTheoLopHocPhanController", function($scope, $http,$sce) {

            $scope.trustHtml = function(htmlContent) {

                            return $sce.trustAsHtml(htmlContent);
                        };
            $scope.setContentSummernoteEdit=function($content){
                // $(document).ready(function(){
                    $('#summernote_modal').summernote('code', $content);
                    console.log(summernoteElement);
                                    // Sau đó, sử dụng phương thức summernote để set giá trị
                    // summernoteElement.summernote('code',  $scope.noi_dung);

            }
             $scope.noi_dung_tb = function(thongbao)
             {


                $content=$scope.noi_dung;
                $scope.id = thongbao.id;
                $scope.tieu_de = thongbao.tieu_de;
                $scope.noi_dung = thongbao.noi_dung;
                $scope.danh_sach_sinh_vien = thongbao.danh_sach_sinh_vien;
                $scope.noi_dung_HTML = $sce.trustAsHtml(thongbao.noi_dung);

                console.log($scope.noi_dung);
                // $(document).ready(function() {
                //     $("#summernote_modal").append($scope.noi_dung);

                // });

                // })
             }

                        $http({
                            method: "GET",
                            url: "{{ env('SERVER_URL') }}/api/giang-vien/danh-sach-lop-hoc-phan/GVCNTT1",
                            params: {
                                'opition': 1,
                                'id_lop_hoc_phan': {{ $id_lop_hoc_phan }},
                            },
                            headers: {
                                "Authorizations": "Bearer token"
                            }
                        }).then($response => {
                            $scope.lopHocPhan = $response.data;

                $scope.XemThongTinSinhVien = function($ma_sv) {
                    window.location.href =
                        "/giang-vien/danh-sach-lop-hoc-phan/danh-sach-sinh-vien/{{ $id_lop_hoc_phan }}/thong-tin-sinh-vien?ma_sv=" +
                        $ma_sv;

                    }
            })

        $http({
                method: "GET",
                url: "{{ env('SERVER_URL') }}/api/giang-vien/thong-bao/danh-sach-thong-bao-lop-hoc-phan",
                params: {
                    'type': 1,
                    'id': {{ $id_lop_hoc_phan }},
                },
                headers: {
                    "Authorizations": "Bearer token"
                }
            }).then($response => {
                $scope.thongbao = $response.data;
                console.log($response.data);
            })
        });

                    $("#btn-xoa-thong-bao").click(function() {

                        var postId = $(this).data('post-id');
                        var json_obj = {
                            'id': postId,
                            'id_lop_hoc_phan': {{ $id_lop_hoc_phan }},
                            'type': 1,
                        }
                        $.ajax({
                            method: 'GET',
                            // headers:"@",
                            url: "{{ env('SERVER_URL') }}/api/giang-vien/thong-bao/xoa-thong-bao/id=",
                            data: {},

                        })

                    });

                    $(document).ready(function() {

                        $("#btn-dang-thong-bao").click(function() {

                            var json_obj = {
                                'id': {{ $id_lop_hoc_phan }},
                                'type': 1,
                                'ma_gv': "GVCNTT1",
                                'tieu_de': $("#tieu_de_post").val(),
                                'noi_dung': $(".noi_dung").val(),
                                'danh_sach_sinh_vien': [

                                ]

                }
                $(".checked-sv").each(function() {

                    if ($(this).is(':checked')) {
                        $mssv = $(this).attr('data-ma-sv');
                        var sv_obj = {
                            'ma_sinh_vien': $mssv
                        };
                        json_obj.danh_sach_sinh_vien.push(sv_obj);
                    }
                })



                if(json_obj.danh_sach_sinh_vien.length>0)
                {
                    $.ajax({
                    method: "POST",
                    // headers:"@",
                    url: "{{ env('SERVER_URL') }}/api/giang-vien/thong-bao/them-thong-bao",
                    data: JSON.stringify(json_obj),
                    contentType: "application/json; charset=utf-8",
                    dataType: 'json'
                }).done(function(data) {
                    if (data.status == 1) {
                        location.reload();
                    }
                })
                }
                else
                {
                    console.log('Lỗi');
                }


                console.log(json_obj.danh_sach_sinh_vien);
            });



                    });
                    // $(document).ready(function() {






    </script>
@endsection

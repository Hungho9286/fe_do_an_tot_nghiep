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

        #togglePostButton:hover {
            border: solid 2px rgb(102, 135, 233);
        }
    </style>
@endsection

@section('content')
    <div class="container" ng-app="myApp" ng-controller="DanhSachSinhVienTheoLopHocPhanController">

        <div class="row">




            <div class="col-md-6">
                <div class="alert alert-success">
                    <h4 ng-if="lophocphan.ten_lop_hoc!=null">
                        Lớp: <%lophocphan.ten_lop_hoc%> - <%lophocphan.ten_lop_hoc_phan%>
                    </h4>
                    <h4 ng-if="lophocphan.ten_lop_hoc==null">
                        Lớp chứng chỉ: <%lophocphan.ten_lop_hoc_phan%></h4>

                    </h4>

                </div>
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true"> Thông Báo </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false"> Danh sách sinh viên </button>
                        <button class="nav-link" id="v-pills-mark-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mark"
                            type="button" role="tab" aria-controls="v-pills-mark" aria-selected="false"> Bảng điểm
                        </button>
                    </div>

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">


                            <div class="div-post">
                                @if($trang_thai_hoan_thanh==0)
                                    <button class="alert alert-primary" role="alert" id="togglePostButton"
                                        onclick="togglePostForm()">
                                        Thông
                                        báo
                                        nội dung nào đó cho lớp học của bạn
                                    </button>
                                @endif
                                <div id="postForm" style="display: none">


                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Danh sách sinh viên
                                        </button>

                                        <ul class="dropdown-menu" id="checkboxList" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <label class="dropdown-item">
                                                    <input type="checkbox" id="checkbox-all"
                                                        class="form-check-input checkbox-item"> Tất cả sinh viên
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
                                                <input id="tieu_de_post" type="text" name="tieu_de" class="form-control">
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <textarea class="noi_dung" id="summernote_post" name="noi_dung" data-noi-dung=""></textarea>
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
                                                    <small><%tb.ngay_tao|date:'dd/MM/yyyy HH:mm'%></small>

                                                </div>
                                            </div>
                                            @if($trang_thai_hoan_thanh==0)
                                            <div>

                                                <div class="dropdown no-arrow">
                                                    <div class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </div>

                                                    <div class="dropdown-menu dropdown-menu-right shadow "
                                                        aria-labelledby="userDropdown">
                                                        <a class="dropdown-item"
                                                            href="/giangvien/thongbao/lay-thong-bao-sua?id=<%tb.id%>&id_lop_hoc={{ $id_lop_hoc_phan }}&type=1">
                                                            <i
                                                                class="fa fa-pencil-square-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Sửa thông báo
                                                        </a>
                                                        <a class="dropdown-item btn-thong-bao-xoa " data-toggle="modal"
                                                            data-target="#xoathongbao" href=""
                                                            data-post-id="<%tb.id%>">
                                                            <i class="fa fa-trash-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Xoá thông báo
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                            @endif
                                        </div>
                                        <div class="status-field">
                                            <h3 data-tieu-de='<%tb.tieu_de%>'><%tb.tieu_de%></h3>
                                            <p ng-bind-html="trustHtml(tb.noi_dung)"></p>

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

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="tab-pane fade div-infor" id="v-pills-mark" role="tabpanel"
                            aria-labelledby="v-pills-mark-tab" style="width:1000px">
                            <div style="display:flex;">

                                {{-- <button type="button" style="margin-right: 10px" class="btn btn-success"
                                    id="import">Import</button>
                                <button type="button" style="margin-right: 10px" class="btn btn-success"
                                    id="export">Export</button> --}}

                            </div>


                            <br>
                            <style>
                                .table-mark td input:focus {
                                    outline: none;
                                    border: none;
                                }

                                .table-mark td input {
                                    outline: none;
                                    border: none;
                                    width: 40px;
                                }
                            </style>
                            <div>
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Mã số sinh viên</th>
                                            <th scope="col">Họ Tên</th>
                                            <th scope="col">Chuyên cần</th>
                                            <th scope="col">Trung bình kiểm tra</th>
                                            <th scope="col">Thi lần 1</th>
                                            <th scope="col">Thi lần 2</th>
                                            <th scope="col">Tổng kết 1</th>
                                            <th scope="col">Tổng kết 2 </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr ng-repeat="diem in bangdiem " class="table-mark">
                                            <td scope="row"><%diem.ma_sv%></td>
                                            <td> <%diem.ten_sinh_vien%></td>
                                            <td><input readonly type="number" min="0" max="10"
                                                    class="input-field" name="chuyen_can" value="<%diem.chuyen_can%>"
                                                    step="1">
                                            </td>
                                            <td><input readonly type="number" min="0" max="10"
                                                    class="input-field" name="tbkt" value="<%diem.tbkt%>"></td>
                                            <td><input readonly type="number" min="0" max="10"
                                                    class="input-field" name="thi_1" value="<%diem.thi_1%>"></td>
                                            <td><input readonly type="number" min="0" max="10"
                                                    class="input-field" name="thi_2" value="<%diem.thi_2%>"></td>
                                            <td><input readonly type="number" min="0" max="10"
                                                    class="input-field" name="tong_ket_1" value="<%diem.tong_ket_1%>">
                                            </td>
                                            <td><input readonly type="number" min="0" max="10"
                                                    class="input-field" name="tong_ket_2" value="<%diem.tong_ket_2%>">
                                            </td>
                                            @if ($trang_thai_hoan_thanh==0)
                                            <td style="display: flex">
                                                <button class="btn btn-success" id="nhapdiem"
                                                    onclick="NhapDiem(this)">Nhập điểm</button>
                                                <button type="button" style="margin-right: 10px ;display: none"
                                                    onclick="LuuDiem(this)" class="btn btn-primary luudiem save"
                                                    data-mark-mssv="<%diem.ma_sv%>">Lưu </button>
                                                <button type="button" style="margin-right: 10px;display: none"
                                                    id="huythemdiem" class="btn btn-danger" class="cancel"
                                                    onclick="HuyThemDiem(this)">Huỷ</button>
                                            </td>
                                            @endif

                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
                {{-- pop up delete post --}}
                <!-- Button trigger modal -->


                <!-- Modal -->
                @if($trang_thai_hoan_thanh==0)
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
                @endif


                <!-- Modal -->
                <script>
                    $.getScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js', function() {
                        $('#summernote_post').summernote({
                            disableDragAndDrop: true,
                            placeholder: 'Thông báo nội dung nào đó cho lớp học của bạn',
                            tabsize: 2,
                            maximumImageFileSize: 2 * 1024 * 1024,
                            height: 150,
                            toolbar: [
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['fontname', ['fontname']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['insert', ['link', ]], // 'picture'


                            ],
                            // callbacks: {
                            //     onImageUpload: function(files) {
                            //         var maxSizeInBytes = 2 * 1024 * 1024; // 5MB

                            //         // Kiểm tra kích thước tệp ảnh
                            //         for (var i = 0; i < files.length; i++) {
                            //             var fileSize = files[i].size;
                            //             if (fileSize > maxSizeInBytes) {
                            //                 Swal.fire('Kích thước tệp ảnh không được vượt quá 2MB');
                            //                 return false; // Ngăn chặn việc tải lên ảnh
                            //             } else {
                            //                 var image = files[0];
                            //                 var reader = new FileReader();

                            //                 reader.onloadend = function() {
                            //                     var imgBase64 = reader.result;
                            //                     // Chỗ này xảy ra lỗi TypeError: $(...).summernote is not a function mà sửa hoài không được
                            //                     $('#summernote_post').summernote('insertImage', imgBase64);
                            //                 }

                            //                 if (image) {
                            //                     reader.readAsDataURL(image);
                            //                 }
                            //                 Swal.fire('Thêm rồi đó');
                            //             }
                            //         }


                            //     }
                            // }
                        });
                    });
                </script>


                <script>
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
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
                    crossorigin="anonymous">
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
                </script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="{{ asset('giangvien/js/view/view.js') }}"></script>
                <script src="https://pagead2.googlesyndication.com/pagead/managed/js/adsense/m202305300101/show_ads_impl_fy2021.js"
                    id="google_shimpl"></script>
                <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
                </script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                </script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                    crossorigin="anonymous">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
                <script>
                    var message_delete = localStorage.getItem("message_delete");
                    if (message_delete) {
                        Swal.fire('Đã xoá thành công ');
                        localStorage.removeItem("message_delete");
                    }
                    var message_add = localStorage.getItem("message_add");
                    if (message_add) {
                        Swal.fire('Đã thêm thành công ');
                        localStorage.removeItem("message_add");
                    }
                    var message_edit = localStorage.getItem("message_edit");
                    if (message_edit) {
                        Swal.fire('Đã sửa thành công ');
                        localStorage.removeItem("message_edit");
                    }

                    var app = angular.module("myApp", [], function($interpolateProvider) {
                        $interpolateProvider.startSymbol('<%');
                        $interpolateProvider.endSymbol('%>');
                    });

                    app.controller("DanhSachSinhVienTheoLopHocPhanController", function($scope, $http, $sce) {

                        $scope.trustHtml = function(htmlContent) {

                            return $sce.trustAsHtml(htmlContent);
                        };

                        $scope.noi_dung_tb = function(thongbao) {



                            $scope.id = thongbao.id;
                            $scope.tieu_de = thongbao.tieu_de;
                            $scope.noi_dung = thongbao.noi_dung;
                            $scope.danh_sach_sinh_vien = thongbao.danh_sach_sinh_vien;
                            $scope.noi_dung_HTML = $sce.trustAsHtml(thongbao.noi_dung);

                            $('#summernote_modal').append($scope.noi_dung);

                        }


                        $http({
                            method: "GET",
                            url: "{{ env('SERVER_URL') }}/api/giang-vien/danh-sach-lop-hoc-phan/{{ Session::get('ma_gv') }}",
                            params: {
                                'option': 1,
                                'id_lop_hoc_phan': {{ $id_lop_hoc_phan }},
                            },
                            headers: {
                                "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
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
                                "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                            }
                        }).then($response => {
                            $scope.thongbao = $response.data;
                            console.log($response.data);
                        })
                        $http({
                            method: "GET",
                            url: "{{ env('SERVER_URL') }}/api/giang-vien/lop-hoc-phan/bang-diem/{{ $id_lop_hoc_phan }}",
                            headers: {
                                "Authorization": "Bearer {{ Session::get('access_token_gv') }}"
                            }
                        }).then($response => {
                            $scope.bangdiem = $response.data;
                            console.log($response.data);
                        })
                        $http({
                            method: "GET",
                            url: "{{ env('SERVER_URL') }}/api/giang-vien/lop-hoc-phan/{{ $id_lop_hoc_phan }}",
                            headers: {
                                "Authorization": "Bearer {{ Session::get('access_token_gv') }}"
                            }

                        }).then($response => {
                            $scope.lophocphan = $response.data;
                            console.log($response);

                        })


                    });

                    var postID = 0;



                    $(document).on('click', '.save', function(event) {
                        var element = $(event.target);
                        var Mark_mssv = element.attr('data-mark-mssv');
                        var row = $(this).closest('tr');
                        var marks = {
                            'ma_sv': Mark_mssv,
                            'ma_gv':'{{Session::get('ma_gv')}}'
                        };
                        row.find('input[type="number"]').each(function() {
                            var inputValue = $(this).val();
                            var inputName = $(this).attr('name');
                            marks[inputName] = inputValue

                        });
                        var check_input = true;
                        if (marks['tong_ket_1'] != "" && marks['thi_1'] == "") {
                            Swal.fire('Nhập điểm thi lần 1 trước  khi nhập điểm tống kết lần 1');
                            check_input = false;
                        }
                        if (marks['tong_ket_2'] != "" && marks['thi_2'] == "") {
                            Swal.fire('Nhập điểm thi lần 2 trước khi nhập điểm tống kết lần 2');

                            check_input = false;
                        }
                        if (check_input == true) {
                            console.log("Dô 1");
                            if ((marks['chuyen_can'] < 11 && marks['chuyen_can'] > 0) || marks['chuyen_can'] == "") {
                                console.log('ok1');
                                if ((marks['tbkt'] < 11 && marks['tbkt'] > 0) || marks['tbkt'] == "") {
                                    console.log('ok1');
                                    if ((marks['thi_1'] < 11 && marks['thi_1'] > 0) || marks['thi_1'] == "") {
                                        console.log('ok1');
                                        if ((marks['thi_2'] < 11 && marks['thi_2'] > 0) || marks['thi_2'] == "") {
                                            console.log('ok1');
                                            if ((marks['tong_ket_1'] < 11 && marks['chuyen_can'] > 0) || marks['tong_ket_1'] ==
                                                "") {
                                                console.log('ok1');
                                                if ((marks['tong_ket_2'] < 11 && marks['tong_ket_2'] > 0) || marks[
                                                        'tong_ket_2'] ==
                                                    "") {
                                                    console.log('ok1');
                                                    $.ajax({
                                                        method: 'POST',
                                                        headers: {
                                                            "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                                                        },
                                                        url: "{{ env('SERVER_URL') }}/api/giang-vien/lop-hoc-phan/bang-diem-sinh-vien/thay-doi-diem/{{ $id_lop_hoc_phan }}",
                                                        data: marks,
                                                        dataType: 'json',

                                                    }).done(function($response) {
                                                        Swal.fire('Thay đổi thành công');
                                                    })

                                                } else {
                                                    Swal.fire('Điểm số không lớn hơn 10 và nhỏ hơn 0');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }







                    });
                    $(document).on('click', '.btn-thong-bao-xoa', function(event) {
                        var element = $(event.target);

                        postID = element.attr('data-post-id');

                    });

                    $(document).ready(function() {


                        $("#btn-xoa-thong-bao").click(function() {



                            $.ajax({
                                method: 'POST',
                                headers: {
                                    "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                                },
                                url: "{{ env('SERVER_URL') }}/api/giang-vien/thong-bao/xoa-thong-bao?id=" +
                                    postID

                            }).done(function($response) {
                                if ($response.status == 1) {
                                    var message_delete = "Thông báo xoá";
                                    localStorage.setItem("message_delete", message_delete);
                                    location.reload();
                                }
                            })



                        });




                    });


                    $(document).ready(function() {



                        $("#btn-dang-thong-bao").click(function() {

                            var json_obj = {
                                'id': {{ $id_lop_hoc_phan }},
                                'type': 1,
                                'ma_gv': '{{ Session::get('ma_gv') }}',
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


                            if (json_obj.danh_sach_sinh_vien.length == 0) {
                                Swal.fire('Hãy chọn sinh viên để gửi thông báo');
                            } else {
                                if (json_obj.tieu_de == "")
                                    Swal.fire('Không để trống tiêu đề');
                                else
                                if (json_obj.noi_dung == "")
                                    Swal.fire('Không để trống nội dung');
                            }


                            if (json_obj.danh_sach_sinh_vien.length > 0 && json_obj.noi_dung != '' && json_obj
                                .tieu_de != '') {
                                $.ajax({
                                    method: "POST",
                                    headers: {
                                        "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                                    },
                                    url: "{{ env('SERVER_URL') }}/api/giang-vien/thong-bao/them-thong-bao",
                                    data: JSON.stringify(json_obj),
                                    contentType: "application/json; charset=utf-8",
                                    dataType: 'json'
                                }).done(function(data) {
                                    if (data.status == 1) {
                                        var message_add = "Thông báo thêm";
                                        localStorage.setItem("message_add", message_add);
                                        location.reload();
                                    }
                                })
                            }


                            // console.log(json_obj);
                        });



                    });
                </script>
            @endsection

@extends('layouts.giangvien.giangvien')
@section('content')
    <div ng-app="myApp" ng-controller="DanhSachSinhVienTheoLopHocPhanController">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Danh sách sinh viên
            </button>

            <ul class="dropdown-menu" id="checkboxList_modal" aria-labelledby="dropdownMenuButton">
                <li>
                    <label class="dropdown-item">
                        <input type="checkbox" id="checkbox-all" class="form-check-input checkbox-item_modal"> Tất cả sinh
                        viên
                    </label>
                </li>
                <li>
                    <label class="dropdown-item">
                        @php
                            $svtb = '';
                            foreach ($danh_sach_sv as $sv) {
                                $flag = false;
                                foreach ($danh_sach_sv_thong_bao as $sv_tb) {
                                    if ($sv->ma_sv == $sv_tb->ma_sv) {
                                        $svtb = $sv_tb->ma_sv;
                                        $flag = true;
                            
                                        break;
                                    }
                                }
                                if ($flag == true) {
                                    echo '<input checked type="checkbox" class="form-check-input checked-sv checkbox-item_modal" data-ma-sv="' . $sv->ma_sv . '">' . $sv->ma_sv . ' - ' . $sv->ten_sinh_vien;
                                } else {
                                    echo '<input  type="checkbox" class=" checked-sv"data-ma-sv="' . $sv->ma_sv . '">' . $sv->ma_sv . ' - ' . $sv->ten_sinh_vien;
                                }
                            }
                        @endphp



                    </label>
                </li>
            </ul>
        </div>

        <br>

        <div class="row-1">
            <div class="input-group">
                <span class="input-group-text">Tiêu đề</span>
                <input id="tieu_de_modal" type="text" name="tieu_de" value="{{ $thong_bao->tieu_de }}"
                    class="form-control">

            </div>
            <br>
            <div class="mb-3">
                <textarea class="noi_dung" id="summernote_modal" name="noi_dung">{!! $thong_bao->noi_dung !!}</textarea>
            </div>


        </div>



    </div>
    <div class="modal-footer">
        <a href="/giangvien/lop-hoc-phan-cua-giang-vien?id={{ $id_lop_hoc }}&type={{ $type }}" type="button"
            class="btn btn-secondary">Đóng</a>
        <button type="submit" class="btn btn-primary" id="btn-luu-thay-doi-thong-bao">Lưu thay đổi</button>
    </div>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script>
        $(document).ready(function() {



            $('#btn-luu-thay-doi-thong-bao').click(function() {
                var PostID = {{ $thong_bao->id }};
                var tieu_de = $('#tieu_de_modal').val();
                var noi_dung = $('#summernote_modal').val();

                var danh_sach_sinh_vien = [];

                $(".checked-sv").each(function() {

                    if ($(this).is(':checked')) {
                        $mssv = $(this).attr('data-ma-sv');
                        var ma_sinh_vien = {
                            'ma_sinh_vien': $mssv
                        };
                        danh_sach_sinh_vien.push(ma_sinh_vien);
                    }
                })



                var json_obj = {
                    'id_thong_bao': {{ $thong_bao->id }},
                    'tieu_de': tieu_de,
                    'noi_dung': noi_dung,
                    'danh_sach_sinh_vien': danh_sach_sinh_vien
                }
                if (json_obj.danh_sach_sinh_vien.length == 0) {
                    Swal.fire('Hãy chọn sinh viên để gửi thông báo');
                } else {
                    if (json_obj.tieu_de === "")
                        Swal.fire('Không để trống tiêu đề');
                    else
                    if (json_obj.noi_dung === "")
                        Swal.fire('Không để trống nội dung');
                }

                if (json_obj.danh_sach_sinh_vien.length > 0 && json_obj.noi_dung != '' && json_obj
                    .tieu_de != '') {
                    $.ajax({
                        data: json_obj,
                        dataType: 'json',
                        method: 'POST',

                        headers: {
                            "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                        },
                        url: "{{ env('SERVER_URL') }}/api/giang-vien/thong-bao/sua-thong-bao/" +
                            PostID,

                    }).done(function($response) {
                        if ($response.status == 1) {
                            var message_edit = "Thông báo sửa";
                            localStorage.setItem("message_edit", message_edit);
                            $type_lop = {{ $type }};
                            if ($type_lop == 1) {
                                window.location.href =
                                    '/giangvien/lop-hoc-phan-cua-giang-vien?id=' +
                                    {{ $id_lop_hoc }} + '&type={{ $type }}';
                            } else {
                                window.location.href =
                                    '/giangvien/lop-chu-nhiem-cua-giang-vien?id=' +
                                    {{ $id_lop_hoc }} + '&type={{ $type }}';
                            }

                        }
                    })
                }



            })


        })
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



        });
    </script>
@endsection

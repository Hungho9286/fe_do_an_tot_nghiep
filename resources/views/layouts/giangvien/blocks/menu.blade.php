<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('trang-chu-giang-vien') }}">

        <div style="font-family: Arial, sans-serif;">Giảng Viên</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/giang-vien/trang-chu">
            <i class="fas fa-home"></i>
            <span style="font-family: Arial, sans-serif;">Trang chủ</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-school"></i>
            <span style="font-family: Arial, sans-serif;">Danh sách lớp</span>
        </a>


        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <a class="nav-link collapsed" data-toggle="collapse" href="#multiCollapseExample1" aria-expanded="false"
                aria-controls="multiCollapseExample1">
                <i class="fas fa-school"></i>
                <span style="font-family: Arial, sans-serif;">Lớp học phần</span>
            </a>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="bg-white py-2 collapse-inner rounded" id="danhsach-sv-lop">
                        <h6 class="collapse-header" style="font-family: Arial, sans-serif;">Lớp học phần:</h6>


                    </div>
                </div>
            </div>

        </div>
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#multiCollapseExample2"
        aria-expanded="false" aria-controls="multiCollapseExample2">
        <i class="fas fa-school"></i>
        <span style="font-family: Arial, sans-serif;">Lớp chủ nhiệm</span>
        </a>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="bg-white py-2 collapse-inner rounded" id="danhsach-sv-lop-chu-nhiem">

                        <h6 class="collapse-header" style="font-family: Arial, sans-serif;">Lớp chủ nhiệm:</h6>
                    </div>
                </div>
            </div>
        </div>
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#multiCollapseExample3"
            aria-expanded="false" aria-controls="multiCollapseExample3">
            <i class="fas fa-school"></i>
            <span style="font-family: Arial, sans-serif;">Lớp học lưu trữ</span>
        </a>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample3">
                    <div class="bg-white py-2 collapse-inner rounded" id="danhsach-lop-hoc-phan-da-hoan-thanh">

                        <h6 class="collapse-header" style="font-family: Arial, sans-serif;">Lớp học lưu trữ:</h6>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ env('SERVER_URL') }}/api/giang-vien/danh-sach-lop-hoc-phan/{{ Session::get('ma_gv') }}',
                method: "GET",
                headers: {
                    "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                }
            }).done(function($data) {
                text = "";
                $data.forEach(element => {
                    if (element.lop_hoc != null)
                        text = text +
                        '<a  class="collapse-item" href="/giangvien/lop-hoc-phan-cua-giang-vien?id=' +
                        element.id_lop_hoc_phan + '&type=1' + '"  >' + element.lop_hoc.ten_lop_hoc +
                        '<br>' + element.mon_hoc.ten_mon_hoc + '</a>'
                    else
                        text = text +
                        '<a  class="collapse-item" href="/giangvien/lop-hoc-phan-cua-giang-vien?id=' +
                        element.id_lop_hoc_phan + '&type=1' + '"  >' + element.mon_hoc.ten_mon_hoc +
                        '</a>'
                });
                $('#danhsach-sv-lop').append(text);

            })
            $.ajax({
                url: '{{ env('SERVER_URL') }}/api/giang-vien/danh-sach-lop-chu-nhiem/{{ Session::get('ma_gv') }}',
                method: "GET",
                headers: {
                    "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                }
            }).done(function($data) {

                // console.log($data);
                $data.forEach(element => {
                    $('#danhsach-sv-lop-chu-nhiem').append(

                        '<a class="collapse-item" href="/giangvien/lop-chu-nhiem-cua-giang-vien?id=' +
                        element.lop_hoc.id + '&type=0' + '"  >' + element.lop_hoc.ten_lop_hoc +
                        '</a>'

                    );
                });

            })
            $.ajax({
                url: '{{ env('SERVER_URL') }}/api/giang-vien/danh-sach-lop-hoc-phan-da-hoan-thanh/{{ Session::get('ma_gv') }}',
                method: "GET",
                headers: {
                    "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                }
            }).done(function($data) {
                text = "";
                $data.forEach(element => {
                    if (element.lop_hoc != null)
                        text = text +
                        '<a  class="collapse-item" href="/giangvien/lop-hoc-phan-cua-giang-vien?id=' +
                        element.id_lop_hoc_phan + '&type=1' + '"  >' + element.lop_hoc.ten_lop_hoc +
                        '<br>' + element.mon_hoc.ten_mon_hoc + '</a>'
                    else
                        text = text +
                        '<a  class="collapse-item" href="/giangvien/lop-hoc-phan-cua-giang-vien?id=' +
                        element.id_lop_hoc_phan + '&type=1' + '&save=1"  >' + element.mon_hoc.ten_mon_hoc +
                        '</a>'
                });
                $('#danhsach-lop-hoc-phan-da-hoan-thanh').append(text);

            })
        })
    </script>






    <li class="nav-item">
        <a class="nav-link" href="{{ route('thoi-khoa-bieu-giang-vien') }}">
            <i class="fas fa-calendar"></i>
            <span>Thời khoá biểu</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>

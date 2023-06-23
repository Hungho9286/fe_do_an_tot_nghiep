<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('trang-chu-giang-vien')}}">
        
        <div class="sidebar-brand-text mx-3">Giảng Viên</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/giang-vien/trang-chu">
            <i class="fas fa-home"></i> 
            <span>Trang chủ</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

   

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-school"></i>
            <span>Danh sách lớp</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded" id="danhsach-sv-lop" >
                
                <h6 class="collapse-header">Danh sách:</h6>
               
                
            </div>
        </div>
    </li>

    <script>
     
   $(document).ready(function()
   {
    $.ajax({
        url:'{{env("SERVER_URL")}}/api/giang-vien/danh-sach-lop-hoc-phan/GVCNTT1',
        method: "GET",
        headers:{
                "Authorizations":"Bearer token",
            }
    }).done(function($data)
    {
        console.log($data);
        $data.forEach(element => {
            $('#danhsach-sv-lop').append(
        
        '<a class="collapse-item" href="/giangvien/lop-hoc-phan-cua-giang-vien?id='+element.id_lop_hoc_phan+'&type=1'+'"  >'+ element.lop_hoc.ten_lop_hoc+'-' + element.mon_hoc.ten_mon_hoc + '</a>'
             
         );
        });
       
    })
   }) 
   
    </script>

   

  

    
    <li class="nav-item">
        <a class="nav-link" href="{{route('thoi-khoa-bieu-giang-vien')}}">
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

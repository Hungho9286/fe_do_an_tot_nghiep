@extends('layouts.giangvien.giangvien')

@section('css')
<style>
.div-post{
    width:1000px;
}
@media only screen and (width <= 1600px)  {
  .div-post,
  .div-infor,
   {
    max-width: 90%;
  }
}
@media only screen and (width <= 1400px)  {
  .div-post,
  .div-infor {
    max-width: 80%;
  }
}

@media only screen and (width <= 1280px)  {
  .div-post,
  .div-infor {
    max-width: 70%;
  }
}

@media only screen and (width <= 1024px)  {
  .div-post,
  .div-infor {
    max-width: 55%;
  }
}

@media only screen and (width <= 800px)  {
  .div-post,
  .div-infor {
    max-width: 42%;
  }
}
@media only screen and (width <= 600px)  {
  .div-post,
  .div-infor {
    max-width: 27%;
  }
}
@media only screen and (width <= 400px)  {
  .div-post,
  .div-infor {
    max-width: 15%;
  }
}
@media only screen and (width <= 200px)  {
  .div-post,
  .div-infor {
    max-width: 7%;
  }
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
 <div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"> Thông Báo </button>
  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"> Danh sách sinh viên </button>
    
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"> 
        <div class="div-post" >
            <form action="" method="post" enctype = "multipart/form-data" >
                 @csrf
                 <div class="input-group">
                  <span class="input-group-text">Tiêu đề</span>
                  <input type="text" name="tieu_de" class="form-control">
                </div>
                <br>
                <div class="mb-3" >
                  
                    <div id="summernote" name="noi_dung" ></div>
                </div>
        
                <button type="submit" class="btn btn-primary">Đăng</button>
              </form>
              <div class="status-field-container write-post-container">
                <div class="user-profile-box">
                    <div class="user-profile">
                        <img src="images/avatar/0306201537.jpg" alt="">
                        <div>
                            <p> Alex Carry</p>
                            <small>August 13 1999, 09.18 pm</small>
                        </div>
                    </div>
                    <div>
                        
                          <div class="dropdown no-arrow">
                            <div class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right shadow "
                            aria-labelledby="userDropdown" data-toggle="modal" data-target="#exampleModalLong">
                            <a class="dropdown-item"  href="#">
                                <i class="fa fa-pencil-square-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sửa thông báo
                            </a>
                            <a class="dropdown-item " data-toggle="modal" data-target="#xoathongbao" href="#">
                                <i class="fa fa-trash-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                Xoá thông báo
                            </a>
                           
                        </div>
                          </div>
                    
                    </div>
                </div>
                <div class="status-field">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis dolores praesentium dicta
                        laborum nihil accusantium odit laboriosam, sed sit autem! <a
                            href="#">#This_Post_is_Better!!!!</a> </p>
                    <img src="images/feed-image-1.png" alt="">
      
                </div>
          
            </div>
        </div>
       
    </div>
    <div class="tab-pane fade div-infor" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" style="width:1000px">
        <div ng-app="myApp" ng-controller="DanhSachSinhVienTheoLopHocPhanController">
     
            <ul class="list-group" >
                <li class="list-group-item" ng-repeat="sinhVien in lopHocPhan.danh_sach_sinh_vien">
                    <div class="row justify-content-around">
                        <div class="col-8">
                          <div>MSSV: <%sinhVien.mssv%></div>
                          <div>Lớp: CĐTH20F</div>
                          <div>Email: <%sinhVien.email%></div>
                          <div>Tên: <%sinhVien.ho_ten%></div>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-success" ng-click="XemThongTinSinhVien(sinhVien.id)">Xem thông tin</button>
                            <button type="button" class="btn btn-primary" ng-click="XemDiemSinhVien(sinhVien.id)">Xem điểm</button>
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
  <div class="modal fade" id="xoathongbao" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
          <button type="button" class="btn btn-primary">Xoá thông báo</button>
        </div>
      </div>
    </div>
  </div>
</form>


<!-- Modal -->
<form action="" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Thông báo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" >
            @csrf
            <div class="input-group">
             <span class="input-group-text">Tiêu đề</span>
             <input type="text" name="tieu_de" class="form-control">
           </div>
           <br>
           <div class="mb-3" style="border: solid 1px">
               <div id="summernote2" name="noi_dung" ></div>
           </div>
   
      
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</form>




    <script>
        $('#summernote').summernote({
            placeholder: 'Đăng thông báo',
            tabsize: 2,
            height: 100
        });
    </script>
        <script>
          $('#summernote2').summernote({
           
              tabsize: 2,
              height: 100
          });
      </script>
@endsection
@section('js')

<script src="https://pagead2.googlesyndication.com/pagead/managed/js/adsense/m202305300101/show_ads_impl_fy2021.js" id="google_shimpl"></script><script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    var app = angular.module("myApp", [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    $id_giang_vien=1;
    app.controller("DanhSachSinhVienTheoLopHocPhanController",function($scope,$http){
        $http({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/giang-vien/danh-sach-lop-hoc-phan/"+$id_giang_vien,
            params:{
                'opition':1,
                'id_lop_hoc_phan':{{$id_lop_hoc_phan}},
            },
            headers:{
                "Authorizations":"Bearer token"
            }
        }).then($response=>{
            $scope.lopHocPhan=$response.data;

            $scope.XemThongTinSinhVien=function($id_sinh_vien){
                window.location.href="/giang-vien/danh-sach-lop-hoc-phan/danh-sach-sinh-vien/{{$id_lop_hoc_phan}}/thong-tin-sinh-vien?id_sinh_vien="+$id_sinh_vien;
            }
        })
    });
</script>
@endsection

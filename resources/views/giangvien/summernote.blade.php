<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<title>Giảng Viên CKC</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href=" {{asset('gv/stylesheets/foundation.min.css')}}">
<link rel="stylesheet" href=" {{asset('gv/stylesheets/main.css')}}">
<link rel="stylesheet" href="{{asset('gv/stylesheets/app.css')}}">
<script src="gv/javascripts/modernizr.foundation.js"></script>
<link rel="stylesheet" href="{{asset('stylesheets/LigatureSymbols/ligature.css')}}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

@yield('css')

<!-- Google fonts -->
<!-- 
  
<link href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="{{asset('https://code.jquery.com/jquery-3.5.1.min.js')}}"></script>
  <script src="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js')}}"></script>
  <link href="{{asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css')}}" rel="stylesheet">
  <script src="{{asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js')}}"></script> -->
<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div class="row">
  <div class="three columns"> <a href="index.html"><img src="{{asset('gv/images/logo.png')}}" alt="" class="header_logo"></a> </div>
  <div class="nine columns" style="padding:20px; text-align:right"> Xin Chào <a href="#" style="font-size:16px" title="instagram">Tên Giảng Viên</a> </div>
</div>
<div class="row page_wrap" style="margin-top:-2px;margin-left: 500px;">
  <!-- page wrap -->
  <div class="twelve columns justify-content-md-center">
    <!-- page wrap -->
    @include('layouts.giangvien.blocks.header')
    <!-- END Header -->
    @include('layouts.giangvien.blocks.main')
    <form action="{{route('xu-ly-them-thong-bao')}}" method="post">
      @csrf
        <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="" name="tieu_de">Tiêu đề</span>
            </div>
            <input type="text" class="form-control">
          </div>
        <div id="summernote" name="noi_dung"></div>
        <button type="submit" class="btn btn-primary">Đăng thông báo</button>
    </form>
 
    <script>
      $('#summernote').summernote({
        placeholder: 'Thông báo nội dung nào đó cho sinh viên của bạn',
        tabsize: 2,
        height: 100
      });
    </script>
    <!-- Menu -->
    @include('layouts.giangvien.blocks.menu')
    <!-- END Menu-->
    
    <div class="row">
      <div class="twelve columns">
        <ul id="menu3" class="footer_menu horizontal">
          <li><a href="index.html">Home</a></li>
        </ul>
      </div>
    </div>
    <script>$('ul#menu3').nav-bar();</script>
  </div>
</div>
<!-- end page wrap) -->
@include('layouts.giangvien.blocks.footer')

@yield('js')
</body>
</html>

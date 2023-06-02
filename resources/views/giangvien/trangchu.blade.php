@extends('layouts.giangvien.giangvien')
 
@section('css')

<link rel="stylesheet" href="{{asset('gv/stylesheets/foundation.min.css')}}">
<link rel="stylesheet" href="{{asset('gv/stylesheets/main.css')}}">
<link rel="stylesheet" href="{{asset('gv/stylesheets/app.css')}}"> 
<script src="{{asset('gv/javascripts/modernizr.foundation.js')}}"></script>
<link rel="stylesheet" href="{{asset('stylesheets/LigatureSymbols/ligature.css')}}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection

@section('content')
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


<div class="central-meta item">
  <div class="user-post">
    <div class="friend-info">
      <figure>
        <img alt="" src="images/resources/friend-avatar10.jpg">
      </figure>
      <div class="friend-name">
        <div class="more">
          <div class="more-post-optns"><i class="ti-more-alt"></i>
            <ul>
              <li><i class="fa fa-pencil-square-o"></i>Sửa thông báo </li>
              <li class="bad-report" ><i class="fa fa-trash-o"></i>Xoá thông báo</li>
            </ul>
          </div>
        </div>
        <ins><a title="" href="time-line.html">Janice Griffith</a></ins>
        <span>published: june,2 2010 19:PM</span>
      </div>
      <div class="description">
        <h2>Tiêu đề</h1>
        <p>
          Curabitur World's most beautiful car in <a title="" href="#">#test drive booking !</a> the most beatuiful car available in america and the saudia arabia, you can book your test drive by our official website
        </p>
      </div>
      
    </div>
  </div>
</div><!-- love post -->


<div class="popup-wraper3">
  <div class="popup">
    <span class="popup-closed"><i class="ti-close"></i></span>
    <div class="popup-meta">
      <div class="popup-head">
        <h5>Thông báo</h5>
      </div>
      <div class="Rpt-meta">
        <span>Bạn có chắc là xoá thông báo này</span>
       <form method="post" class="c-form"  {{-- action="{{route('/giangvien/thongbao/xoa/{{$giangvien->id}}')}}"--}}> 
        <div>
          <button data-ripple="" type="submit" class="main-btn">Đồng ý </button>
          <a href="#" data-ripple="" class="main-btn3 cancel">Huỷ</a>
        </div>
        </form>	
      </div>
    </div>	
  </div>
</div><!-- report popup -->
@endsection




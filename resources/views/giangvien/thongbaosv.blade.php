@extends('layouts.giangvien.giangvien')
 

@section('content')

<form action="{{route('xu-ly-them-thong-bao')}}" method="post">
    @csrf
    <div class="input-group">
        
        <div class="input-group-prepend">
          <span class="input-group-text" id="" >Tiêu đề</span> 
        </div>
        <input type="text" class="form-control input1" name="tieu_de" required > 
      </div>
      <div class="form-outline">
        <label class="form-label" for="textAreaExample">Thông báo nội dung nào đó cho sinh viên của bạn</label>
        <textarea class="form-control" id="textAreaExample1" rows="4" name="noi_dung" required></textarea>
        
      </div>
      <div style="height: 20px">
      </div>
      <div class="notifications"></div>
    <div class="buttons">
        <button type="submit"  class="button-1" style="background-color: rgb(68, 68, 246)">Đăng thông báo</button>
    </div>
   
</form>

<div style="height: 50px">
</div>

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




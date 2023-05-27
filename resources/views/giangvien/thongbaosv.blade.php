@extends('layouts.giangvien.giangvien')
 
@section('css')


@endsection

@section('content')

<form action="{{route('xu-ly-them-thong-bao')}}" method="post">
    @csrf
    <div class="input-group">
        align
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Tiêu đề</span>
        </div>
        <input type="text" class="form-control" name="tieu_de">
      </div>
      <div class="form-outline">
        <label class="form-label" for="textAreaExample">Thông báo nội dung nào đó cho sinh viên của bạn</label>
        <textarea class="form-control" id="textAreaExample1" rows="4" name="noi_dung"></textarea>
        
      </div>
    <button type="submit" class="btn btn-primary">Đăng thông báo</button>
</form>

@endsection




@extends('layouts.giangvien.giangvien')
@section('css')
@endsection
@section('content')
<a href="{{route('danh-sach-lop-hoc-phan',['id'=>1,'type'=>1])}}" class="btn btn-outline-primary">Trở lại</a>
<br>
<br>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Mã số sinh viên</th>
      <th scope="col">Họ Tên</th>
      <th scope="col">Chuyên cần</th>
      <th scope="col">Trung bình kiểm tra</th>
      <th scope="col">Thi</th>
      <th scope="col">Tổng kết</th>
    </tr>
  </thead>
  <tbody>
  
    <tr ng-repeat="diem in bangdiem ">
      <th scope="row"><%diem.ma_sv%></th>
      <td><%diem.ten_sinh_vien%></td>
      <td><%diem.chuyen_can%></td>
      <td><%diem.tbkt%></td>
      <td><%diem.thi_1%></td>
      <td><%tong_ket_1%></td>
    </tr>     
  </tbody>
</table>
  
@endsection
@section('js')
<script>
                      $http({
                            method: "GET",
                            url: "{{ env('SERVER_URL') }}/api/giang-vien/lop-hoc-phan/bang-diem/1",
                            headers: {
                                "Authorizations": "Bearer token"
                            }
                        }).then($response => {
                            $scope.bangdiem = $response.data;
                            console.log($response.data);
                        })
              
</script>
@endsection

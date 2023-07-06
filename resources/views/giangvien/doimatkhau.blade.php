@extends('layouts.giangvien.giangvien')

@section('content')
    <div class="container" style="padding:0% 30%">
        <div class="container my-5 d-flex justify-content-center"
            style="margin:20px 0px;background-color:rgb(225, 237, 248);boder-radius:10px;">
            <form>
                <h3>Đổi mật khẩu</h3>

                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control" id="currentPassword" name="mat_khau" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="newPassword" name="mat_khau_moi" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="confirmPassword" name="mat_khau_moi_confirmation "
                        required>
                </div>
                <button type="submit" class="btn btn-primary" id="doi-mat-khau">Thay đổi mật khẩu</button>
                <a href="/giang-vien/trang-chu" class="btn btn-secondary">Trở lại</a>
            </form>
        </div>
    </div>



    </html>
@endsection

@section('js')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var message_change = localStorage.getItem("message_change");
        if (message_change) {
            Swal.fire('Đổi mật khẩu thành công ');
            localStorage.removeItem("message_change");
        }
        $(document).ready(function() {


            $("#doi-mat-khau").click(function() {


                $mat_khau_moi = $('#newPassword').val();
                $ma_gv = "{{ Session::get('ma_gv') }}";

                console.log($ma_gv);


                $.ajax({
                    method: 'POST',
                    headers: {
                        "Authorization": "Bearer {{ Session::get('access_token_gv') }} "
                    },
                    url: "{{ env('SERVER_URL') }}/api/giang-vien/xu-ly-doi-mat-khau",
                    data: {
                        id: $ma_gv,
                        ma_khau_moi: $mat_khau_moi,
                    }


                }).done(function($response) {
                    console.log('do');
                    if ($response.status == 1) {
                        var message_change = "Thông báo thay đổi mật khẩu";
                        localStorage.setItem("message_change", message_change);
                        window.location.href = "giang-vien/trang-chu";

                    }
                })



            });

        });
    </script>
@endsection

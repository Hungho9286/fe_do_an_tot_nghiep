<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Đăng nhập</div>
            <div class="title signup">Đăng nhập</div>
        </div>
        <div class="form-container" >
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Sinh Viên</label>
                <label for="signup" class="slide signup">Giảng Viên</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form method="POST" action="{{ route('xu-ly-dang-nhap') }}" class="login">
                    @csrf
                    <div class="field">
                        <input type="text" name="tai_khoan" placeholder="Tài khoản Sinh Viên" required>
                    </div>
                    <div class="field">
                        <input type="password" name="mat_khau" placeholder="Mật khẩu" required>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Đăng nhập">
                    </div>
                </form>
                @php
                    $message = session('message');

                @endphp
                @if (session('message'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Thông báo',
                                text: '{{ session('message') }}',
                                timer: 10000, // Thời gian hiển thị trong 10 giây
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>
                @endif



                <form method="POST" action="{{ route('xu-ly-dang-nhap-gv') }}" class="signup">
                    @csrf
                    <div class="field">
                        <input type="text" name="tai_khoan" placeholder="Tài khoản Giảng Viên" required>
                    </div>
                    <div class="field">
                        <input type="password"name="mat_khau" placeholder="Mật khẩu" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Đăng nhập">
                    </div>
                </form>

            </div>

        </div>
        <div class="d-flex justify-content-center">
            <p><a class="link-opacity-100" href="#" id="forgetPasswordBtn">Quên mật khẩu?</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        $(document).ready(function(){
            $('#forgetPasswordBtn').click(function(){
                Swal.fire(
                'Quên mật khẩu?',
                'Vui lòng hãy liên hệ với Quản trị viên để lấy lại mật khẩu?',
                'question'
                )
            })
        })
    </script>


</body>

</html>

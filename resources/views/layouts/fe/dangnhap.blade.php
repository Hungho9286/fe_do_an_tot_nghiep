<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Đăng nhập</div>
        <div class="title signup">Đăng nhập</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Sinh Viên</label>
          <label for="signup" class="slide signup">Giảng Viên</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form method="POST" action="http://127.0.0.1:8001/dang-nhap" class="login">
            @csrf
            <div class="field">
              <input type="text" name="tai_khoan" placeholder="Tài khoản" required>
            </div>
            <div class="field">
              <input type="password" name="mat_khau" placeholder="Mật khẩu" required>
            </div>

            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Đăng nhập">
            </div>
          </form>
          <form action="#" class="signup">
            @csrf
            <div class="field">
              <input type="text" name="tai_khoan" placeholder="Tài khoản" required>
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
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>


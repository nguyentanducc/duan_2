<?php
        include_once(__DIR__ . '/../../model/pdo.php');
        include_once (__DIR__ . '/../../controller/login.php'); 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="dangnhap.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height:700px" />

            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

              <form  action="dangnhap.php" method="post">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">PLD HOTEL</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập vào tài khoản của bạn</h5>

                  <div class="form-outline mb-4">
                    <!-- <label class="form-label" for="email">Địa chỉ email</label>
                    <input type="email" id="email" class="form-control form-control-lg" name="email" /> -->
                    <label class="form-label" for="user_name">Tên tài khoản</label>
                    <input type="text" id="username" class="form-control form-control-lg" name="username" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="pwd">Mật khẩu</label>
                    <input type="password" id="pwd" class="form-control form-control-lg" name="pass"/>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit" name="login">Đăng nhập</button>
                    <?php
                    if(isset($thongbao)&&($thongbao!="")) echo '<span style="color: red; font-weight: bold;">' . $thongbao . '</span>';
                    ?>
                  </div>
                
                  <a class="small text-muted" href="#!">Quên mật khẩu</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản?<a href="dangky.php"
                      style="color: #393f81;">Đăng ký tại đây</a></p>
                   
                <a href="#!" class="small text-muted">PLD HOTEL - KHÁCH SẠN CAO CẤP</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
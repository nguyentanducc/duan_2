<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Thêm mã nhúng vào head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Your+Selected+Font&display=swap" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        /* Tùy chỉnh giao diện của input text */
        .datepicker {
            display: inline-block;
            padding: 10px;
            font-size: 16px;
        }
        #banner {
      width: 100%;
      margin: auto;
      overflow: hidden;
      height: 600px;
    }

    .slider {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    .slide {
      flex: 0 0 100%;
    }

    img {
      width: 100%;
      height: auto;
    }
    </style>



</head>

<body>

    <!-- Bắt đầu phần header -->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" style="width: 10%;"> <img
                        src="./img/logo.png" alt="" style="width: 100%;"> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">Trang chủ |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Phòng |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Thông tin |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Liên hệ</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li> -->
                    </ul>
                    <form class="d-flex" role="search" style=" margin-right: 30px;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <?php



// Kiểm tra xem session 'user_id' có tồn tại hay không
if (isset($_SESSION['idPerson'])) {
    // Nếu đã đăng nhập
     echo '<button type="button" class="btn btn-danger" style="margin-right: 30px;"><a href="controller/logout.php" style="color: white;">Đăng xuất</a></button>';
} else {
    // Nếu chưa đăng nhập
    echo '<button type="button" class="btn btn-primary" style="margin-right: 30px;"><a href="view/taikhoan/dangnhap.php" style="color: white;">Đăng nhập</a></button>';
    echo '<button type="button" class="btn btn-success"><a href="view/taikhoan/dangky.php" style="color: white;">Đăng ký</a></button>';
}
?>
                </div>
        </nav>


        <div id="banner">
            <div class="slider">
              <div class="slide">
                <img src="./img/banner1.jpg" alt="Image 1">
              </div>
              <div class="slide">
                <img src="./img/banner2.jfif" alt="Image 2">
              </div>
              <div class="slide">
                <img src="./img/banner3.png" alt="Image 3">
              </div>
            </div>
          </div>
          
          <script>
            let currentIndex = 0;
            const totalSlides = document.querySelectorAll('.slide').length;
            const slider = document.querySelector('.slider');
          
            function showSlide(index) {
              const newPosition = -index * 100 + '%';
              slider.style.transform = 'translateX(' + newPosition + ')';
            }
          
            function nextSlide() {
              currentIndex = (currentIndex + 1) % totalSlides;
              showSlide(currentIndex);
            }
          
            // Auto slide every 3 seconds
            setInterval(nextSlide, 3000);
          
            // Show the first slide initially
            showSlide(currentIndex);
          </script>

    </header>
    <!-- Kết thúc phần header -->
    
   
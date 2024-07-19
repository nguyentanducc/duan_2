<?php
// session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đặt Phòng</title>
</head>
<body>

<div class="container">
        <h2 class="mt-4">Đặt phòng thành công</h2>

        <div class="alert alert-success mt-4">
            <p>Cảm ơn bạn đã đặt phòng với chúng tôi. Dưới đây là thông tin xác nhận:</p>

            <?php
            if (isset($_SESSION['confirmation_info'])) {
                $confirmation_info = $_SESSION['confirmation_info'];

                echo "<p><strong>Tên Khách Hàng:</strong> " . $confirmation_info['customer_name'] . "</p>";
                echo "<p><strong>Số CMND:</strong> " . $confirmation_info['id_number'] . "</p>";
                echo "<p><strong>Email:</strong> " . $confirmation_info['email'] . "</p>";
                echo "<p><strong>Ngày Check-in:</strong> " . $confirmation_info['checkin_date'] . "</p>";
                echo "<p><strong>Ngày Check-out:</strong> " . $confirmation_info['checkout_date'] . "</p>";
                echo "<p><strong>Ghi Chú:</strong> " . $confirmation_info['note'] . "</p>";
                echo "<p><strong>Tống giá:</strong> " . $confirmation_info['gia'] . "</p>";
                // Xóa thông tin đặt phòng từ session sau khi hiển thị
                unset($_SESSION['confirmation_info']);
            } else {
                echo "<p>Không có thông tin xác nhận.</p>";
            }
            ?>
        </div>

        <p class="mt-4">Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
        <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="view/datphong/xulythanhtoan.php">
        <!-- <a href="view/datphong/xulythanhtoan.php" class="btn btn-success mt-4">Tiến hành thanh toán</a> -->
        </form>
        <a href="../index.php" class="btn btn-primary mt-4">Quay lại Trang Chủ</a>
    </div>
</body>
</html>

<?php
// Lấy ngày check-in từ cơ sở dữ liệu 
$ngay_checkin_timestamp = strtotime($check_don['start_date']);
$ngay_checkout_timestamp = strtotime($check_don['end_date']);
$ngay_checkin = date('Y-m-d', $ngay_checkin_timestamp);
$ngay_checkout = date('Y-m-d', $ngay_checkout_timestamp);
$ngay_hom_nay = date('Y-m-d');
$so_ngay= round(($ngay_checkout_timestamp - $ngay_checkin_timestamp) / (60 * 60 * 24));
if($so_ngay<=0){
    $so_ngay=1;
}
$tienPhong= $so_ngay * $room_price;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-out Form</title>
</head>
<body>

<form action="index.php?pg=detail" method="post">
<div class="container mt-5">    
        <div class="form-group">
            <label for="room_number">Số Phòng:</label>
            <input type="text" class="form-control" id="room_number" name="room_number" value="<?=$check_don['room_id']?>"disabled>
            <input type="hidden" name="" value="<?=$tienPhong?>" id="room_price">
            <input type="hidden" name="booking_id" value="<?=$_GET['id']?>">
        </div>

        <div class="form-group">
            <label for="checkin_date">Ngày Nhận Phòng:</label>
            <input type="date" class="form-control" id="checkin_date" name="checkin_date" value="<?=$ngay_checkin?>"  disabled>
        </div>

        <div class="form-group">
            <label for="checkout_date">Ngày Trả Phòng:</label>
            <input type="date" class="form-control" id="checkout_date" name="checkout_date" value="<?=$ngay_hom_nay?>" disabled>
        </div>

        <div class="form-group">
            <label for="payment_method">Phương Thức Thanh Toán:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="1">Chuyển khoản</option>
                <option value="2">Thẻ Tín Dụng</option>
                <option value="3">Tiền Mặt</option> 
                Thêm phương thức thanh toán khác nếu cần
            </select>
        </div>

 


    
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Dịch Vụ Phòng</h2>

                <!-- Ô checkbox cho việc chọn đồ ăn -->
                <div class="form-group">
                    <label>Chọn đồ ăn:</label>
                    <?php foreach ($listdv as $dichvu): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="<?= $dichvu['service_id'] ?>" name="services[]" value="<?= $dichvu['service_price'] ?>" data-service-name="<?= $dichvu['service_name'] ?>" data-quantity="1" onchange="updateOrderDetails()">
                            <label class="form-check-label" for="<?= $dichvu['service_id'] ?>">
                                <?= $dichvu['service_name'] ?>
                            </label>
                            <!-- Thêm input hidden để lưu trữ giá trị quantity của mỗi dịch vụ -->
                            <input type="hidden" id="<?= $dichvu['service_id'] ?>-quantity" value="1">
                            
                            <!-- Nút tăng giảm số lượng -->
                            <button  type="button" class="btn btn-sm btn-outline-secondary mx-2" onclick="increaseQuantity('<?= $dichvu['service_id'] ?>')">+</button>
                            <button  type="button" class="btn btn-sm btn-outline-secondary" onclick="decreaseQuantity('<?= $dichvu['service_id'] ?>')">-</button>
                        </div>
                    <?php endforeach; ?>
                </div>

               <!-- Hiển thị thông tin đặt hàng -->
                <div class="form-group">
                    <h3>Thông Tin Đặt Hàng</h3>
                    <p id="giaPhong"></p>
                    <input  id="service" type="hidden" name="service_name">
                    <p id="service-name" name="service_name">Tên Dịch Vụ: </p>
                    <p id="price">Tiền Dịch Vụ: 0VNĐ</p>
                    <input id="totalp"type="hidden" name="total">
                    <p id="total"  >Tổng tiền: 0VNĐ</p>
                    <!-- <input class="form-control" type="number" id="quantity" value="1" min="1" onchange="updateOrderDetails()" type="hidden"> -->
                    <input type="hidden" name="" onchange="updateOrderDetails()" id="quantity">
                </div>

                <!-- Nút thanh toán -->
                <button class="btn btn-primary" type="submit" >Thanh Toán</button>

    </form>
    </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS và Popper.js (được yêu cầu bởi Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Hàm cập nhật thông tin đặt hàng khi có sự thay đổi
        var room_price = document.getElementById("room_price").value;
            giaPhong.innerText="Tiền Phòng: " +  room_price + "VNĐ"
          
        function updateOrderDetails() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var serviceName = document.getElementById("service-name");
            var price = document.getElementById("price");
            var quantity = document.getElementById("quantity").value;
           
            // Lọc các ô checkbox đã được chọn
            var selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);

            // Lấy thông tin từ các ô checkbox đã chọn
            var selectedServiceNames = [];
            var selectedPrices = [];

            selectedCheckboxes.forEach(function (checkbox) {
                var serviceName = checkbox.getAttribute("data-service-name");
                var quantityInput = document.getElementById(checkbox.id + "-quantity");
                var quantity = parseInt(quantityInput.value);
                selectedServiceNames.push(serviceName + " (" + quantity + ")");
                selectedPrices.push(parseFloat(checkbox.value) * quantity);
            });

            // Cập nhật thông tin đặt hàng
            serviceName.innerText = "Tên Dịch Vụ: " + selectedServiceNames.join(', ');
            var service = document.getElementById("service");
            service.value = selectedServiceNames;
            price.innerText = "Tiền Dịch Vụ: " + (selectedPrices.reduce((total, price) => total + price, 0)).toFixed(0)+"VNĐ";
            var tong=parseInt(room_price)+parseInt((selectedPrices.reduce((total, price) => total + price, 0)).toFixed(2));
            total.innerText="Tổng tiền: " +  tong + "VNĐ";
            var totalp = document.getElementById("totalp");
            totalp.value= tong;
        }

        // Hàm tăng số lượng
        function increaseQuantity(serviceId) {
            var quantityInput = document.getElementById(serviceId + "-quantity");
            var newQuantity = parseInt(quantityInput.value) + 1;
            quantityInput.value = newQuantity;
            updateOrderDetails();
        }

        // Hàm giảm số lượng
        function decreaseQuantity(serviceId) {
            var quantityInput = document.getElementById(serviceId + "-quantity");
            var newQuantity = parseInt(quantityInput.value) - 1;
            if (newQuantity >= 1) {
                quantityInput.value = newQuantity;
                updateOrderDetails();
            }
        }
        // Hàm xử lý thanh toán
        function checkout() {
            var serviceName = document.getElementById("service-name").innerText;
            var price = document.getElementById("price").innerText;

            alert("Đã chọn: " + serviceName + "\n" + price + "\nCảm ơn bạn đã thanh toán!");}
            </script>
       
</body>
</html>

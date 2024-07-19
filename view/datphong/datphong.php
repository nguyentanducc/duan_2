<?php  // Bắt đầu phiên

?>
<form action="index.php?pg=booking" method="post" class="container mt-5">
    <input type="hidden" name="price" value="<?=$phong['room_price'];?>" id="price">
    <div class="form-group">
        <label for="ten">Họ và Tên:</label>
        <input type="text" id="ten" name="ten" class="form-control"value="<?=$user['full_name']?>" required>
    </div>
    <div class="form-group">
        <label for="idNumber">Số Căn Cước Công Dân:</label>
        <input type="text" id="idNumber" name="idNumber" class="form-control" value="<?=$user['CCCD_id']?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" value="<?=$user['email']?>" required>
    </div>
    <div class="form-group">
        <label for="ten">Tên phòng</label>
        <input type="text" id="ten" name="ten" class="form-control"value="<?=$phong['room_name']?>" required>
        <input type="hidden" name="id" value="<?=$phong['room_id']?>">
    </div>
    <div class="form-group">
        <label for="ngay_den">Ngày Đến:</label>
        <input type="date" id="ngay_den" name="ngay_den" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="ngay_di">Ngày Đi:</label>
        <input type="date" id="ngay_di" name="ngay_di" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ghi_chu">Ghi Chú(nếu có):</label>
        <textarea id="ghi_chu" name="ghi_chu" rows="4" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="tong_gia">Tổng Giá:</label>
        <input type="text" id="tong_gia" name="tong_gia" class="form-control" value="" readonly>
    </div>
    <div class="form-group">
            <label for="payment_method">Phương Thức Thanh Toán:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="1">MOMO</option>
                <!-- <option value="2">Tiền Mặt</option> -->
                
                Thêm phương thức thanh toán khác nếu cần
            </select>
        </div>
    <!-- <div class="form-group">
        <label for="so_nguoi">Số Người:</label>
        <input type="number" id="so_nguoi" name="so_nguoi" class="form-control" required>
    </div> -->

    <!-- <div class="form-group">
        <label for="loai_phong">Loại Phòng:</label>
        <select id="loai_phong" name="loai_phong" class="form-control" required>
        <option value="0" selected> Loại Phòng</option> -->
        <?php 
        // foreach($listdanhmuc as $danhmuc){
        // extract($danhmuc);
        // echo '<option value="'. $type_id .'">'.$type_name.'</option>';
        // }
        ?> 
		<!-- </select> -->
            <!-- <option value="phong_don">Phòng Đơn</option>
            <option value="phong_doi">Phòng Đôi</option> -->
            <!-- Thêm các loại phòng khác nếu cần -->
        <!-- </select> -->
    </div>
            <br>
    <button type="submit" class="btn btn-primary" name="booking">Đặt Phòng</button>
</form>
<script>
    // Lấy thông tin phòng từ server hoặc truyền từ trang trước
    // const roomDetails = {
    //     roomName: "Phòng VIP",
    //     description: "Mô tả phòng...",
    //     price: 100
    // };

    // Hiển thị thông tin phòng
    // document.getElementById('roomDetails').innerHTML = `
    //     <h2>${roomDetails.roomName}</h2>
    //     <p>${roomDetails.description}</p>
    //     <p>Giá: $${roomDetails.price}/đêm</p>
    // `;

    // Gán giá trị mặc định cho ngày nhận phòng và ngày trả phòng
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('ngay_den').value = today;
    document.getElementById('ngay_di').value = today;
    
    function tinhTongGia() {
    var ngayDen = document.getElementById("ngay_den").value;
    var ngayDi = document.getElementById("ngay_di").value;
    var giaphong=document.getElementById("price").value;
    var dateNgayDen = new Date(ngayDen);
    var dateNgayDi = new Date(ngayDi);

    var soNgay = Math.ceil((dateNgayDi - dateNgayDen) / (1000 * 60 * 60 * 24));
    var giaMoiNgay = 100;
    var tongGia = soNgay * parseInt(giaphong);

    // Thiết lập giá trị của trường input hidden
    document.getElementById("tong_gia").value = tongGia;

    // (Không cần hiển thị alert ở đây)
}

// Sử dụng sự kiện onchange thay vì onclick
document.getElementById("ngay_den").addEventListener("change", tinhTongGia);
document.getElementById("ngay_di").addEventListener("change", tinhTongGia);
</script>
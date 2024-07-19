<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới tài khoản</title>
    <!-- Thêm các thư viện CSS để làm đẹp form -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Thêm tài khoản</h2>
    <form action="index.php?pg=themtaikhoan" method="post">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" class="form-control" id="full_name" name="full_name"  required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"  required>
        </div>
        <div class="form-group">
            <label for="birth_date">Birth Date:</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date"  required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username"  required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"  required>
        </div>
        <div class="form-group">
            <label for="CCCD_id">CCCD ID:</label>
            <input type="text" class="form-control" id="CCCD_id" name="CCCD_id"  required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="1" >Admin</option>
                <option value="2" >staff</option>
                <option value="3" >User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

        <?php
                    if(isset($thongbao)&&($thongbao!="")) echo '<span style="color: green; font-weight: bold;">' . $thongbao . '</span>';
                    ?>
    </form>
</div>

<!-- Thêm các thư viện JavaScript để làm đẹp form -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>

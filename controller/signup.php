<?php
    session_start(); 
    $thongbao = "";
    if(isset($_POST["signup_btn"])){ 
        if(!$_POST["username"] == "" && !$_POST["pass"] == "" && !$_POST["rppass"] == "" && !$_POST["sdt"] == ""&& !$_POST["email"] == ""){
            $check = $_POST["username"];
            $query = "select * from users where username like n'$check'"; 
            $users = pdo_query($query);
            if(count($users) == 0) {
                if($_POST["pass"] == $_POST["rppass"]){
                    // $id = $_POST["idUser"];
                    $userName = $_POST["username"];
                    $Email = $_POST["email"];
                    $sdt = $_POST["sdt"];
                    // !$_FILES["Avatar"]["size"] == 0
                    // $userImage = $_FILES["Avatar"]["name"]; 
                    $passWord = $_POST["pass"]; 
                    // $active = 1;
                    $role = 3;
                    // var_dump($_FILES);
                    $query = "insert into users(phone_number, username, password, role, email) values ('$sdt','$userName', '$passWord', '$role','$email')";
                    pdo_execute($query);

                    // move_uploaded_file($_FILES["Avatar"]["tmp_name"],"../src/images/".$_FILES["Avatar"]["name"]);

                    header("location:dangnhap.php");
                }
                else{
                    $thongbao =  "*Nhập sai dữ liệu hoặc mật khẩu không trùng khớp";
                }
            } else {
                $thongbao =  "*Tên người dùng đã tồn tại";
            }
        }
        else{
            $thongbao =  "*Vui long điền đủ thông tin";
        }
    }
?>
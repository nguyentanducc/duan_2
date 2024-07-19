<?php
//    include "../model/pdo.php";
   session_start(); //bắt đầu session
    $query = "select * from users"; 
    $users =pdo_query($query); 
    // var_dump($users);
    $thongbao="";
    foreach($users as $value){ 
        if(isset($_POST["login"])){
            if(!$_POST["username"] == "" && !$_POST["pass"] == ""){
                if($_POST["username"] == $value["username"] && $_POST["pass"] == $value["password"]){ 
                    $_SESSION["username"] = $_POST["username"]; 
                    // $_SESSION["avatar"] = "./src/images/".$value["picture"];
                    $_SESSION["id"] = $value["role"];
                    $_SESSION["idPerson"] = $value["user_id"];
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngayHienTai = date("Y-m-d");
                    var_dump( $ngayHienTai);
                    $sqlCheckEndDate = "SELECT  COUNT(*) AS SoLuong FROM rooms WHERE '$ngayHienTai' IN (SELECT checkin_date FROM datphong)";
                    $soluong=pdo_query_value($sqlCheckEndDate);
                    if($soluong>0)
                   {
                        $sql1="UPDATE rooms SET Trangthai = 2 WHERE room_id IN
                        ( SELECT DISTINCT room_id FROM datphong WHERE checkin_date = ' $ngayHienTai' );";
                        pdo_execute($sql1);
                    }
                    if($_SESSION["id"]==3 ) {
                        // header("location:__DIR__ . /../../../admin/index.php");
                        header("location:__DIR__ . /../../../index.php");
                        // header("location:./client-view/index.php"); 
                    } else {
                        // header("location:./admin-view/dashboard.php?ctr=dashboard");
                    }
                } else {
                    $thongbao =  "*Nhập sai mật khẩu hoặc tên đăng nhập";
                }
            }
        }
    }
?>
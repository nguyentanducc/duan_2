<?php
include "header.php";
include "../model/pdo.php";
include "../model/phong.php";
include "../model/danhmuc.php";
include "../model/taikhoan.php";
if(isset($_GET['pg'])&&($_GET['pg']!="")){
    $pg=$_GET['pg'];
    switch($pg){
        case "listdv":
            $sql="SELECT * FROM `service` WHERE 1  order by service_id desc";
            $listdv=pdo_query($sql);
            include "dichvu/listdv.php";
            break;
        case "listdon":
            $sql="SELECT * FROM `datphong` WHERE 1  order by datphong_id desc";
            $listdon=pdo_query($sql);
            include "dondat/listdon.php";
            break;
        case "chitietdon":
            $sql="SELECT * FROM `booking_detail` WHERE booking_id =".$_GET['id'];
            $list= pdo_query($sql);
            include "dondat/chitietdon.php";
            break;
        case "checkin":
            $bookingId = $_GET["id"];
            $sql1="select room_id from datphong where datphong_id =".$bookingId;
            $room_id=pdo_query_value($sql1);
            $sql = "UPDATE datphong SET checked_in = 1 WHERE datphong_id =".$bookingId;
            pdo_execute($sql);
            $insertBookingDetail = "INSERT INTO booking_detail (room_id, Booking_id, start_date) 
            VALUES ($room_id, $bookingId, NOW())";
            pdo_execute($insertBookingDetail);
            $sqlds="SELECT * FROM `datphong` WHERE 1  order by datphong_id desc";
            $listdon=pdo_query($sqlds);
            include "dondat/listdon.php";
            break;
        case "checkout":
            $bookingId = $_GET["id"];
            $sql1 = "UPDATE datphong SET checked_in = '4' WHERE datphong_id =".$bookingId;
            pdo_execute($sql1);
            $sql="select * from datphong where datphong_id=".$bookingId ;
            $donhang=pdo_query($sql);
            $sql4="SELECT * FROM `booking_detail` WHERE booking_id=".$bookingId;
            $check_don=pdo_query_one($sql4);
            $sql2="SELECT * FROM `datphong` WHERE 1  order by datphong_id desc";
            $listdon=pdo_query($sql2);
            $sql3="SELECT * FROM `service` WHERE 1  order by service_id desc";
            $listdv=pdo_query($sql3);
            $insertBookingDetail = "UPDATE  booking_detail SET end_date =NOW() where booking_id =".$bookingId;
            pdo_execute($insertBookingDetail);
            $sql5="select room_price from rooms join booking_detail ON rooms.room_id = booking_detail.room_id where booking_detail.booking_id =".$bookingId;
            $room_price=pdo_query_value($sql5);
            $sql_update_trangthai="UPDATE rooms SET Trangthai = '1' WHERE room_id = (SELECT room_id FROM datphong WHERE datphong_id =$bookingId)";
            pdo_execute($sql_update_trangthai);
            include "dondat/checkout_form.php";
            break;
        case "cancel":
            $bookingId = $_GET["id"];
            $sql_update_trangthai="UPDATE rooms SET Trangthai = '1' WHERE room_id = (SELECT room_id FROM datphong WHERE datphong_id =  $bookingId)";
            pdo_execute($sql_update_trangthai);
            $sql = "UPDATE datphong SET checked_in = 3 WHERE datphong_id = $bookingId";
            pdo_execute($sql);
            $sql="SELECT * FROM `datphong` WHERE 1";
            $listdon=pdo_query($sql);
            include "dondat/listdon.php";
            break;
        case "dsphong":
            $listphong=loadall_phong($keyw="",$type_id=0);
            include "phong/danhsachphong.php";
            break;

        case "themphong":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy dữ liệu từ các trường nhập
                $room_id = $_POST['room_id'];
                $room_name = $_POST['room_name'];
                $img = $_FILES['img']; // Dữ liệu từ trường tệp tải lên
                $description = $_POST['description'];
                $room_price = $_POST['room_price'];
                $type_id = $_POST['type_id'];
                $Trangthai = $_POST['Trangthai'];
                $img = $_FILES['img'];
                $img_name = $img['name'];
                $img_tmp_name = $img['tmp_name'];
                $img_error = $img['error'];
                
                if ($img_error === 0) {
                    // Di chuyển tệp tạm thời đến một địa chỉ cụ thể trên máy chủ
                    $img_destination = '../upload/' . $img_name;
                    move_uploaded_file($img_tmp_name, $img_destination);
    
                    insert_phong($room_name, $img_name,$description,$room_price,$type_id,$Trangthai);
                    $thongbao="Thêm thành công";
                }
            }
            $sql="SELECT * FROM type_room WHERE 1";
            $listdanhmuc=  pdo_query($sql);
            include "phong/add.php";
            break;

        case "xoaphong":
            if(isset($_GET['id'])&&($_GET['id']>0)){
                delete_phong($_GET['id']); 
            }
            $listphong=loadall_phong();
            include "phong/danhsachphong.php";                     
            break;
      
        case "listtk":
            $listtk=loadall_taikhoan();
            include "taikhoan/listtk.php";
            break;
        case "xoatk":
            if(isset($_GET['id'])&&($_GET['id']>0)){
                delete_taikhoan($_GET['id']); 
            }
            $listtk=loadall_taikhoan();
            include "taikhoan/listtk.php";
            break;

        case "suaphong":
            if(isset($_GET['id'])&&($_GET['id']>0)){
                $rooms=loadone_phong($_GET['id']);
            }
            $sql="SELECT * FROM type_room WHERE 1";
            $listdanhmuc=  pdo_query($sql);
            include "phong/update.php";
            break; 

        case "updatephong":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy giá trị từ form
                $room_id = $_POST['room_id'];
                $room_name = $_POST['room_name'];
                $description = $_POST['description'];
                $room_price = $_POST['room_price'];
                $type_id = $_POST['type_id'];
                $trangthai = $_POST['Trangthai'];
                $oldimg = $_POST["oldimg"];
                // Xử lý ảnh nếu có được chọn
                if (!empty($_FILES['img']['tmp_name']))  {
                    $upload_dir = "../upload/"; // Thư mục lưu trữ ảnh
                    $img_path = $upload_dir . basename($_FILES['img']['name']);
                    $img_name=basename($_FILES['img']['name']);
                    move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
                    $img=$img_path;
                }
                else{
                    $img_name=$oldimg;
                }
                $sql="UPDATE rooms SET 
                room_name = '$room_name', 
                img = '$img_name', 
                description = '$description', 
                room_price = '$room_price', 
                type_id = '$type_id', 
                Trangthai = '$trangthai' 
                WHERE room_id = '$room_id'";
                pdo_execute($sql);
                $thongbao ="Cập nhật thành công";
            
            }
            $listphong=loadall_phong($keyw="",$type_id=0);
            include "phong/danhsachphong.php";
            break; 
            case "xoaphong":
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    delete_phong($_GET['id']); 
                }
                $listphong=loadall_phong();
                include "phong/danhsachphong.php";                     
                break;
        case "listdm":
            $listdm=loadall_dm($keyw="",$type_id=0);
            include "danhmuc/listdm.php";
            break;
        case 'thongke':
            $listthongke=loadall_thongke();
            include "thongke/list.php";
            break;
        case 'bieudo':
            $listthongke=loadall_thongke();
            include "thongke/bieudo.php";
            break;
        case 'dsanh':
            $listphong=loadall_phong();
            $sql ="select * from room_image";
            $listanh= pdo_query($sql);
            include "anhphong/list.php";
            break;
        case 'addanh':
                $listphong=loadall_phong();
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $room_id=$_POST['room_id'];
                    $room_img=$_FILES['room_img']['name'];
                    $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["room_img"]["name"]);
                move_uploaded_file($_FILES["room_img"]["tmp_name"], $target_file);
                $sql ="INSERT INTO `room_image`(`room_id`, `room_img`) 
                VALUES ('$room_id','$room_img')";
                pdo_execute($sql);
               
                $thongbao="Thêm thành công";
                }
                
                include "anhphong/add.php";
                break;
                case "xoaanh":
                    if(isset($_GET['id'])&&($_GET['id']>0)){
                        $sql="DELETE FROM `room_image` WHERE room_image_id =".$_GET['id'];
                        pdo_execute($sql);
                    }
                    $sql ="select * from room_image";
                    $listanh= pdo_query($sql);
                    include "anhphong/list.php";
                    break;
                case "suaanh":
                        if(isset($_GET['id'])&&($_GET['id']>0)){
                            $sql="SELECT * FROM `room_image` WHERE room_image_id=".$_GET['id'];
                            $img=pdo_query_one($sql);
                        }
                        $sql="SELECT * FROM type_room WHERE 1";
                        $listphong=loadall_phong();
                        include "anhphong/update.php";
                        break;
                case "updateanh":
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Lấy giá trị từ form
                                $room_id = $_POST['room_id'];
                                $room_name = $_POST['room_name'];
                                $description = $_POST['description'];
                                $room_price = $_POST['room_price'];
                                $type_id = $_POST['type_id'];
                                $trangthai = $_POST['Trangthai'];
                                $oldimg = $_POST["oldimg"];
                                // Xử lý ảnh nếu có được chọn
                                if (!empty($_FILES['img']['tmp_name']))  {
                                    $upload_dir = "../upload/"; // Thư mục lưu trữ ảnh
                                    $img_path = $upload_dir . basename($_FILES['img']['name']);
                                    move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
                                    $img=$img_path;
                                }
                                else{
                                    $img=$oldimg;
                                }
                                $sql="UPDATE rooms SET 
                                room_name = '$room_name', 
                                img = '$img', 
                                description = '$description', 
                                room_price = '$room_price', 
                                type_id = '$type_id', 
                                Trangthai = '$trangthai' 
                                WHERE room_id = '$room_id'";
                                pdo_execute($sql);
                                $thongbao ="Cập nhật thành công";
                            
                            }
                            $listphong=loadall_phong($keyw="",$type_id=0);
                            include "phong/danhsachphong.php";
                            break;                                                   
        case 'adddm':
                // Kiểm tra khi nhấn vào submit
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $type_name=$_POST['type_name'];
                    $img=$_FILES['img']['name'];
                    $max_people=$_POST['max_people'];
                    $max_bed=$_POST['max_bed'];
                    $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
    
                } else {
    
                }
                insert_danhmuc($type_name,$img,$max_people,$max_bed);
                $thongbao="Thêm thành công";
                }
                include "danhmuc/add.php";
                break;

                case "suadm":
                    if(isset($_GET['id']) && ($_GET['id']>0))
                    {
                        $type_room = loadone_dm($_GET['id']);
                    }
                    $sql ="SELECT * FROM type_room WHERE id=".$_GET['id'];
                    include "danhmuc/update.php";

        case "updatedm":
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        $type_id=$_POST['type_id'];
                        $type_name=$_POST['type_name'];
                        $img=$_FILES['img']['name'];
                        $max_people=$_POST['max_people'];
                        $max_bed=$_POST['max_bed'];
                        $oldimg = $_POST["oldimg"];
                    // Xử lý ảnh nếu có được chọn
                    if (!empty($_FILES['img']['tmp_name']))  {
                        $upload_dir = "../upload/"; // Thư mục lưu trữ ảnh
                        $img_path = $upload_dir . basename($_FILES['img']['name']);
                        move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
                        $img=$img_path;
                    }
                    else{
                        $img=$oldimg;
                    }
                    
                    $sql="UPDATE type_room SET 
                    type_name = '$type_name', 
                    img = '$img',
                    max_people = '$max_people', 
                    -- max_bed = '$max_bed', 
                    WHERE type_id =".$type_id;
                        pdo_execute($sql);
                        $thongbao="Update thành công";
                    }
                   $listdm=loadall_dm();
                include "danhmuc/listdm.php";
                break;

                case "xoadm":
                    if(isset($_GET['id'])&&($_GET['id']>0)){
                        delete_dm($_GET['id']); 
                    }
                    $listdm=loadall_dm();
                    include "danhmuc/listdm.php";                     
                    break;

                case "detail":
                    $bookingId=$_POST['booking_id'];
                    $service_name=$_POST['service_name'];
                    $total=$_POST['total'];
                    $payment_method=$_POST['payment_method'];
                    $insertBookingDetail = "UPDATE  booking_detail SET user_service ='$service_name',
                    into_money= '$total',payment_methods= '$payment_method',PaymentStatus='0' where booking_id =".$bookingId;
                    pdo_execute($insertBookingDetail);
                    $sql="SELECT * FROM `booking_detail` WHERE booking_id =".$bookingId;
                    $list= pdo_query($sql);
                    include "dondat/chitietdon.php";
                    break;

                 case 'dsbl':
                        $listbinhluan = loadall_binhluan(0);
                        include "binhluan/list.php";
                            break;
                
                case 'xoabl':
                                if(isset($_GET['id']) && ($_GET['id']>0)){ 
                                    delete_binhluan($_GET['id']);
                            }
                            $listbinhluan = loadall_binhluan1();
                            include "binhluan/list.php";
                                break;

            }

     } else{
        include "home.php";
    }
    include "footer.php";
?>
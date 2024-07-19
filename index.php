<?php
 session_start(); // Bắt đầu phiên
include "view/header.php";
include "model/pdo.php";
include "model/danhmuc.php";
include "model/taikhoan.php";
include "model/phong.php";
$listphong=loadall_phong($keyw="",$type_id=0);
$dsdm=loadall_dm($keyw="",$type_id=0);
if(isset($_GET['pg'])&&($_GET['pg']!="")){
    $pg=$_GET['pg'];
    switch($pg){
        case "datphong":
            if (!isset($_SESSION['idPerson'])) {
                // Nếu người dùng chưa đăng nhập, chuyển hướng hoặc hiển thị thông báo
                // header('Location:view/taikhoan/dangnhap.php'); 
                echo '<script>window.location.replace("view/taikhoan/dangnhap.php");</script>';// Chuyển hướng đến trang đăng nhập
                exit;
            }
            else{
            $user=loadone_taikhoan($_SESSION["idPerson"]);
            $phong=loadone_phong($_GET['id']);
            $sql="SELECT * FROM type_room WHERE 1";
            $listdanhmuc=  pdo_query($sql);
           include "view/datphong/datphong.php";}
        break;
        case "booking":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // room_id
                $payment_method=$_POST['payment_method'];
                $customerName= $_POST['ten'];
                $id_number= $_POST['idNumber'];
                $email= $_POST['email'];
                $checkinDate= $_POST['ngay_den'];
                $checkoutDate=$_POST['ngay_di'];
                $note=$_POST['ghi_chu'];
                $gia=$_POST['tong_gia'];
                $room_id=$_POST['id'];
                $sqlktra=" SELECT 1 FROM datphong  INNER JOIN rooms ON rooms.room_id = datphong.room_id
                WHERE rooms.room_id = $room_id and Checked_in!=3
                    AND (
                      ('$checkinDate' BETWEEN datphong.checkin_date AND datphong.checkout_date)
                      OR ('$checkoutDate' BETWEEN datphong.checkin_date AND datphong.checkout_date)
                      OR (datphong.checkin_date IS NULL AND datphong.checkout_date IS NULL)
                    )";
                $ktra=pdo_query($sqlktra);
                // var_dump(!empty($ktra));
                if(!empty($ktra)){
                    $thongbao = "Phòng đã được đặt trong thời gian bạn chọn";
echo '<div style="background-color: #f44336; color: white; padding: 15px; text-align: center;">' . $thongbao . '</div>';

                    // include "view/datphong/datphong.php";
                }
                else{
                    $sql = "INSERT INTO datphong ( room_id,customer_name,id_number, email, checkin_date, checkout_date,note) 
                    VALUES ('$room_id','$customerName','$id_number','$email', '$checkinDate', '$checkoutDate','$note')";
                    pdo_execute($sql);
                    $ngayHienTai = date("Y-m-d");
                    if( $ngayHienTai == $checkinDate){
                        $sql1="UPDATE rooms
                        SET TrangThai = '2'
                        WHERE room_id =". $room_id;
                        pdo_execute($sql1);
                    }
                   if($payment_method==1){
                    $_SESSION['confirmation_info'] = array(
                        'customer_name' => $customerName,
                        'id_number' => $id_number,
                        'email' => $email,
                        'checkin_date' => $checkinDate,
                        'checkout_date' => $checkoutDate,
                        'note' => $note,
                        'gia'=> $gia
                    );
                    include "view/datphong/xacnhan.php";
                   }
                   
                  
                    
                }
                
              
                }
                break;
             
        // case "booked":
        //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //         // room_id
        //         $customerName= $_POST['ten'];
        //         $id_number= $_POST['idNumber'];
        //         $email= $_POST['email'];
        //         $checkinDate= $_POST['ngay_den'];
        //         $checkoutDate=$_POST['ngay_di'];
        //         $note=$_POST['ghi_chu'];
        //     $sql = "INSERT INTO datphong ( customer_name,id_number, email, checkin_date, checkout_date,note) 
        //     VALUES ( '$customerName','$id_number','$email', '$checkinDate', '$checkoutDate','$note')";
        //      pdo_execute($sql);
        //     $thongbao="đặt phòng thành công";
        //     }
        //     include "view/datphong/xacnhan.php";
        //     break; 
        case "danhsach":
            $iddm=$_GET['iddm'];
            $sql="select * from rooms where type_id=".$iddm;
            $phong=pdo_query($sql);
            include "view/danhsach.php";
            break;

       
        case 'chitietphong':
            // xem chi tiết sản phẩm
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $phong =loadone_phong($id);
            extract($phong);
            $listp = load_phong_cungdm($id,$type_id);
            $sql = "SELECT `checkin_date`, `checkout_date` FROM `datphong` where room_id=". $_GET['id'];;
            $ngay=pdo_query($sql);
            // var_dump($ngay);
            }
            include "view/chitietphong.php";
            break;
        case 'timphong':
            $danh_muc_phong= $_POST['roomType'];
            $so_nguoi=$_POST['guests'];
            $ngay_checkin=$_POST['checkin'];
            $ngay_checkout=$_POST['checkout'];
            $sql = "SELECT * FROM rooms
            INNER JOIN type_room ON rooms.type_id = type_room.type_id
            WHERE type_room.type_id= '$danh_muc_phong'
            AND type_room.max_people >= $so_nguoi
            AND NOT EXISTS (
            SELECT 1 FROM datphong
            WHERE rooms.room_id = datphong.room_id
               and checked_in!=3
        
                and(
                  ('$ngay_checkin' BETWEEN datphong.checkin_date AND datphong.checkout_date)
                  OR ('$ngay_checkout' BETWEEN datphong.checkin_date AND datphong.checkout_date)
                  OR (datphong.checkin_date IS NULL AND datphong.checkout_date IS NULL)
                )
          )
          ";
    // echo($sql);
// Thực hiện câu truy vấn...
           $phong=pdo_query($sql);
        include "view/danhsach.php";
        break;
    }
}
else{
include "view/home.php";
}
include "view/footer.php";
?>
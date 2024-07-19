<!DOCTYPE html>
<html lang="en">

    <title>Danh sách phòng</title>

    <!-- Custom fonts for this template -->
    <link href="templatefree/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="templatefree/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="templatefree/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body id="page-top">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Danh sách phòng</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách phòng</h6>
                            <a href="index.php?pg=themphong" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Thêm mới</a>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>room_id</th>
                                            <th>customer_name</th>
                                            <th>id_number</th>
                                            <th>email</th>
                                            <th>checkin_date</th>
                                            <th>checkout_date</th>
                                            <th>trạng thái</th>
                                            <th>note</th>
                                            <th>created_at</th>
                                            <th>button</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>room_id</th>
                                            <th>customer_name</th>
                                            <th>id_number</th>
                                            <th>email</th>
                                            <th>checkin_date</th>
                                            <th>checkout_date</th>
                                            <th>trạng thái</th>
                                            <th>note</th>
                                            <th>created_at</th>
                                            <th>button</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                   <?php                    
                foreach ($listdon as $don){
                extract($don);
                $suaphong="index.php?pg=suaphong&id=".$datphong_id;
                $xoaphong="index.php?pg=xoaphong&id=".$datphong_id;
                $cancel_booking="index.php?pg=cancel&id=".$datphong_id;
                $checkin="index.php?pg=checkin&id=".$datphong_id;
                $checkout="index.php?pg=checkout&id=".$datphong_id;
                $chitiet="index.php?pg=chitietdon&id=".$datphong_id;
                // $hinhpath= $img;
                //chỉnh sửa trạng thái
                if($checked_in==0){$trangthai='chưa check-in';}
                else{if($checked_in==1){$trangthai='Đã Check-in';}
                else{if($checked_in==3){$trangthai='đã hủy';}
                else{$trangthai='Đã check-out';}
                }}
                //hiển thị nút
                if ($checked_in == 1) {
                    $btn = '<a href="' . $checkout . '"><input type="button" value="Check-out" onclick="return confirm(\'Xác nhận check-out\')"></a>  ';
                } else if($checked_in == 0){
                    $btn = '<a href="' . $checkin . '"><input type="button" value="Check-in" onclick="return confirm(\'Xác nhận check-in\')"></a>  ';
                }
                else{
                    $btn ="";
                }
                if($checked_in!=0){$cancel="";}
                else{
                    $cancel=' <a href="' . $cancel_booking . '"><input type="button" value="Hủy đơn đặt"  onclick="return confirm(\'Xác nhận hủy\')"></a>';
                }
                echo '<tr>
                <td>' . $datphong_id . '</td>
                <td>'.$room_id.'</td>
                <td>' . $customer_name . '</td>
                <td>' . $id_number . '</td>
                <td>' . $email . '</td>
                <td>' . $checkin_date . '</td>
                <td>' . $checkout_date . '</td>
                <td>' . $trangthai . '</td>
                <td>' . $note . '</td>
                <td>' . $created_at . '</td>
               
                <td>
                '.$btn.'
               
                 <a href="' . $chitiet . '"><input type="button" value="xem chi tiết"  onclick="return confirm(\'Xác nhận hủy\')"></a>
                 <a href="'.$xoaphong.'"><input type="button" value="Xóa" onclick="return confirm(\'Bạn có chắc muốn xóa\')"></a>
                 '.$cancel.'
                </td>
            </tr>';
            }
            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
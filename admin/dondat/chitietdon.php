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
                        <th>bookingdetail_id</th>
                        <th>room_id</th>
                        <th>booking_id</th>
                        <th>start_date</th>
                        <th>end_date</th>
                        <th>into_money</th>
                        <th>user_service</th>
                        <th>payment_methods</th>
                        <!-- <th>PaymentStatus</th> -->
                      
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>bookingdetail_id</th>
                        <th>room_id</th>
                        <th>booking_id</th>
                        <th>start_date</th>
                        <th>end_date</th>
                        <th>into_money</th>
                        <th>user_service</th>
                        <th>payment_methods</th>
                        <!-- <th>PaymentStatus</th> -->
                    </tr>
                </tfoot>
                <tbody>
<?php     
echo gettype($list)       ;        
foreach ($list as $don){
extract($don);
if($payment_methods==1){$trangthai='chuyển khoản';}
else{if($payment_methods==2){$trangthai='thẻ tín dụng';}
else{if($payment_methods==3){$trangthai='tiền mặt';}
else{$trangthai='chưa thanh toán';}
}}
echo '<tr>
<td>' . $bookingdetail_id . '</td>
<td>'.$room_id.'</td>
<td>' . $booking_id . '</td>
<td>' . $start_date . '</td>
<td>' . $end_date . '</td>
<td>' . $into_money . '</td>
<td>' . $user_service . '</td>
<td>' . $trangthai . '</td>
<td>

</a>
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
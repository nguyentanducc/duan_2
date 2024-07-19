<div class="row">
            <div class="row formtitle">
                Danh sách bình luận
            </div>
            <div class="row formcontent">
                <div class="row mb10 formloai">
                    <table>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nội dung</th>
                            <th>Phòng</th>
                            <th>Khách hàng</th>
                            <th>Ngày bình luận</th>

                            <th></th>
                        </tr>
                        <?php
                        foreach($listbinhluan as $binhluan)
                        {
                            extract($binhluan);
                            $xoabl ="index.php?pg=xoabl&id=".$id;
                            echo' <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>'.$feedback_id.'</td>
                            <td>'.$content.'</td>
                            <td>'.$room_id.'</td>
                            <td>'.$user_id.'</td>
                            <td>'.$feedback_date.'</td>

                            <td><a href ="'.$xoabl.'"><input type="button" onclick="return confirm(\'Bạn có chắc chắn muốn xóa\')" value="Xóa"> </a></td>
                        </tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>

        </div>
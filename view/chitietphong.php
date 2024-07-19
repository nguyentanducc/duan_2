<div class="container mt-4">
    <div class="row">
        <!-- Bên trái - Chi tiết phòng -->
<div class="col-md-8">
            <div class="card">
            <?php
            if (is_array($phong)) {
    
} extract($phong);?>
                <?php
                $img_path ="upload/".$img;
                // $img=$img_path;
                
                echo '<div class="card-img-top"><img src="' . $img_path . '" style="width: 100%; height: 350px;""></div>';?>
                <div class="card-body">
               
                    <?php
                     $datphong="index.php?pg=datphong&id=".$id;
                      $btn='<a href="'.$datphong.'" style="display: inline-block; padding: 10px 20px; background-color: #3498db;
                      color: #ffffff; text-decoration: none; border-radius: 5px;
                      transition: background-color 0.3s ease;"><span style="margin-left: 5px;">Book Now</span></a>';
                    echo '<h5 class="card-img-top">'.$room_name.'</h5>';
                    echo '<h5 class="card-img-top">'.$description.'</h5>';
                    echo '<h5 class="card-img-top">'.$room_price.'</h5>';
            
                    echo '<p class="pt-1">'.$btn.'</p>'
                ?>
              
                  
                    </div>
            </div>
            <div>
                    <iframe src="view/binhluan/binhluan.php?room_id=<?=$id?>" frameborder="0" width="100%" height="300px"></iframe>
                </div>
        </div>

        <!-- Bên phải - Danh sách phòng -->
        <div class="col-md-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <!-- <img src="product1.jpg" alt="Product 1" class="img-fluid">
                    <h5 class="mt-2">Product 1</h5>
                    <p>Price: $100</p>
                    <p>Beds: 2</p>
                    <p>People: 4</p> -->
                    <?php
                    foreach ($listp as $p) {
                        extract($p);
                        $img_path="upload/".$img;
                        $linkp="index.php?pg=chitietphong&id=".$room_id;
                        echo '<li><a href="'.$linkp.'">'.$room_name.'</a></li>';
                        echo'<div class="card-img-top"><img src="' . $img_path . '" style="width: 100%; height: 70%x;""></div>';

                    }
                    ?>
                </a>
                <!-- Thêm các sản phẩm cùng loại khác tương tự -->
            </div>
          
</div>
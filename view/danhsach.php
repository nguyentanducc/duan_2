<div class="container mt-4">

<div class="dropdown" style="padding-bottom:30px;">

    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    Danh mục
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php 
                foreach ($dsdm as $dm) {
                    extract($dm);
                    
                    $linkdm = "index.php?pg=danhsach&iddm=".$type_id; 
                    
                    echo '
                        <li><a class="dropdown-item" href="'.$linkdm.'">'.$type_name.'</a></li>
                    ';
                }
            ?>
    <!-- <li><a class="dropdown-item" href="#">Mục 2</a></li>
    <li><a class="dropdown-item" href="#">Mục 3</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Mục khác</a></li> -->
    </ul>
    <div class="row">
<?php
                 foreach ($phong as $room){
                    extract($room);
                    $img_path="upload/".$img;
                    $ctphong="index.php?pg=chitietphong&id=".$room_id;
              echo'  <div style="text-align: center;" class="col-md-4">

                    <a href="'.$ctphong.'"><img src="'.$img_path.'"
                            style="width: 200px; height: 200px;" alt=""></a>
                    <div style="background-color: #d6c08a;" class="text p-3 text-center">
                        <h3 class="mb-3"><a style="color: black;" href="type_id">'.$room_name.'</a></h3>
                        <p><span class="price mr-2">'.$room_price.'</span> <span class="per">per night</span></p>
                        <hr>
                        <p class="pt-1"><a href="Book" class="btn-custom">Book Now<span
                                    class="icon-long-arrow-right"></span></a></p>
                    </div>
                </div>';
                 }
?>
</div>
</div>
</div>
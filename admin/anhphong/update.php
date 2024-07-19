<h1>sửa ảnh phòng</h1>

<form  action="index.php?pg=suaanh" method="post" enctype="multipart/form-data">
<div class="mb-3">
    <label class="form-label">room id</label>
    <select name="room_id" value="" class="form-control pro-edt-select form-control-primary">
    <option value="0" selected> Loại</option>
     <?php 
        foreach($listphong as $listanh){
        extract($listanh);
        $selected = ($room_id == $img['room_id']) ? 'selected' : '';
        echo '<option value="'. $room_id .'">'.$room_name.'</option>';
        }
      ?> 
		</select>
  </div>

  <div class="mb-3">
    <label class="form-label">Room image id</label>
    <input type="text" class="form-control" name="room_image_id" readonly value="<?=$img['room_image_id']?>">
  </div>

  <div class="mb-3">
    <label class="form-label">room image</label>
    <input type="file" class="form-control" name="room_img" accept="image/*" require value="<?=$img['room_img']?>">
  </div>

 
  


  <button type="submit" class="btn btn-primary">Submit</button>
  <?php
                    if(isset($thongbao)&&($thongbao!="")) echo '<span style="color: green; font-weight: bold;">' . $thongbao . '</span>';
                    ?>
</form>

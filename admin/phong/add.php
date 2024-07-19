<h1>Thêm mới phòng</h1>
<form  action="index.php?pg=themphong" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Room ID</label>
    <input type="text" class="form-control" name="room_id" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Room Name</label>
    <input type="text" class="form-control" name="room_name" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Image File</label>
    <input type="file" class="form-control" name="img" accept="image/*" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" name="description" required></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Room Price</label>
    <input type="text" class="form-control" name="room_price" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Type ID</label>
    <select name="type_id" value="" class="form-control pro-edt-select form-control-primary">
    <option value="0" selected> Loại</option>
     <?php 
        foreach($listdanhmuc as $danhmuc){
        extract($danhmuc);
        echo '<option value="'. $type_id .'">'.$type_name.'</option>';
        }
      ?> 
		</select>
  </div>


  <div class="mb-3">
    <label class="form-label">Trangthai</label>
    <select class="form-select" name="Trangthai" required>
      <option value="1">Available</option>
      <option value="2">Unavailable</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <?php
                    if(isset($thongbao)&&($thongbao!="")) echo '<span style="color: green; font-weight: bold;">' . $thongbao . '</span>';
                    ?>
</form>

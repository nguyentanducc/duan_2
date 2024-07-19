<h1>Thêm mới phòng</h1>
<form  action="index.php?pg=updatephong" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Room ID</label>
    <input type="text" class="form-control" name="room_id"  value="<?=$rooms['room_id']?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Room Name</label>
    <input type="text" class="form-control" name="room_name" value="<?=$rooms['room_name']?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Image File</label>
    <input type="file" class="form-control" name="img" accept="image/*">
    <input type="hidden" class="form-control" name="oldimg" accept="image/*"  value="<?=$rooms['img']?>" required>
   
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" name="description" required><?=$rooms['description']?></textarea>
</div>
  <div class="mb-3">
    <label class="form-label">Room Price</label>
    <input type="text" class="form-control" name="room_price"  value="<?=$rooms['room_price']?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Type ID</label>
    <select name="type_id" class="form-control pro-edt-select form-control-primary">
        <option value="0">Loại</option>
        <?php 
        foreach($listdanhmuc as $danhmuc) {
            extract($danhmuc);
            $selected = ($type_id == $rooms['type_id']) ? 'selected' : '';
            echo '<option value="' . $type_id . '" ' . $selected . '>' . $type_name . '</option>';
        }
        ?> 
    </select>
</div>


  <div class="mb-3">
    <label class="form-label">Trangthai</label>
    <select class="form-select" name="Trangthai" required>
        <option value="1" <?php echo ($rooms['Trangthai'] == 1) ? 'selected' : ''; ?>>Available</option>
        <option value="2" <?php echo ($rooms['Trangthai'] == 2) ? 'selected' : ''; ?>>Unavailable</option>
    </select>
</div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

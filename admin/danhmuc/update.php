<h1>Chỉnh sửa danh mục</h1>
<form action="index.php?pg=updatedm" method="post" enctype="multipart/form-data">
<div class="mb-3">
    <label class="form-label">Room ID</label>
    <input type="text" class="form-control" name="type_id"  value="<?=$type_room['type_id']?>" readonly>
  </div>
  
<div class="mb-3">
    <label  class="form-label">Tên phòng</label>
    <input type="text" class="form-control" name="type_name" aria-describedby="emailHelp" value="<?= $type_room['type_name'] ?>">

  </div>
  <div class="mb-3">
    <label  class="form-label">Hình ảnh</label>
    <input type="file" class="form-control" name="img" accept="image/*">
    <input type="hidden" class="form-control" name="oldimg" accept="image/*"  value="<?=$type_room['img']?>" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Số người</label>
    <input type="text" class="form-control" name="max_people" aria-describedby="emailHelp" value="<?=$type_room['max_people']?>" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Số giường</label>
    <input type="text" class="form-control" name="max_bed" aria-describedby="emailHelp" value="<?=$type_room['max_bed']?>" readonly>
  </div>

  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <div>
    <?php
    if(isset($thongbao)&&($thongbao!="")) echo $thongbao;
    ?>
  </div>
</form>
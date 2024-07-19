<h1>Thêm mới danh mục</h1>
<form action="index.php?pg=adddm"  method="post" enctype="multipart/form-data">
<div class="mb-3">
    <label  class="form-label">Mã danh mục</label>
    <input type="text" class="form-control" name="type_id" aria-describedby="emailHelp" disabled>
</div>
<div class="mb-3">
    <label  class="form-label">Tên phòng</label>
    <input type="text" class="form-control" name="type_name" aria-describedby="emailHelp"  required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Hình ảnh</label>
    <input type="file" class="form-control" name="img" accept="image/*" aria-describedby="emailHelp"  required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Số người</label>
    <input type="text" class="form-control" name="max_people" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Số giường</label>
    <input type="text" class="form-control" name="max_bed" aria-describedby="emailHelp"  required>
  </div>

  <button type="submit" name="themmoi" class="btn btn-primary">Thêm</button>
  <button type="button" class="btn btn-primary" href="index.php?pg=listdm">Danh mục</button>



  <div>
    <?php
    if(isset($thongbao)&&($thongbao!="")) echo $thongbao;
    ?>
  </div>
</form>
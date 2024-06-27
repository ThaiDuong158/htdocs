<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include '../TrangMau/link.php'; ?>
  <link rel="stylesheet" href="../css/AdminTK.css">
  <title>Tài Khoản</title>
</head>

<body>
  <div class="main container-fluid">
    <?php include '../TrangMau/header.php'; ?>

    <div class="row">
      <?php include '../TrangMau/sidebar.php'; ?>
      <div class="col bg-light d-flex flex-column justify-content-between">
        <div class="content row container-fluid" style="height: 100px;">
          <div class="div--set row">
            <div class="div--input col-9">
            <div class="input--add">
                <label for="inp--SV">Mã sinh viên:</label>
                <input type="text" class="input--type" name="Mã sinh viên" id="inp--SV">
              </div>
              <div class="input--add">
                <label for="inp--MM">Mã môn:</label>
                <input type="text" class="input--type" name="Mã Môn" id="inp--MM">
              </div>
              <div class="input--add">
                <label for="inp--TM">Tên môn:</label>
                <input type="text" class="input--type" name="Tên môn" id="inp--TM">
              </div>
              <div class="input--add">
                <label for="inp--TT">Trạng thái:</label>
                <input type="text" class="input--type" name="Trạng thái" id="inp--TT">
              </div>
              <div class="input--add">
                <label for="inp--HK">Học kỳ:</label>
                <input type="text" class="input--type" name="Học kỳ" id="inp--HK">
              </div>
              
            </div>
            <div class="col div-btn">
              <button class="btn btn-success btn--add">Thêm</button>
              <button class="btn btn-warning btn--edit">Sửa</button>
              <button class="btn btn-danger btn--del">Xóa</button>
            </div>
          </div>

          <div class="div--table">
            <?php 
            include '../TrangMau/connSql.php';
            include'../Admin/loadHP.php';
            $conn->close();
            ?>
          </div>
        </div>
        <?php include '../TrangMau/footer.php'; ?>
      </div>
    </div>
  </div>
  <?php include '../TrangMau/hideSidebar.php'; ?>
  <script src="../js/main.js"></script>
  <script src="../js/adminSelect.js"></script>
</body>

</html>
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
                <label for="inp--MM">Mã môn:</label>
                <input type="text" class="input--type" name="Mã Môn" id="inp--MM">
              </div>
              <div class="input--add">
                <label for="inp--LHP">Mã lớp học phần:</label>
                <input type="text" class="input--type" name="Mã lớp học phần" id="inp--LHP">
              </div>
              <div class="input--add">
                <label for="inp--SL">Số lượng:</label>
                <input type="text" class="input--type" name="Số lượng" id="inp--SL">
              </div>
              <div class="input--add">
                <label for="inp--GV">Giảng viên:</label>
                <input type="text" class="input--type" name="Giảng viên" id="inp--GV">
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
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Mã môn</th>
                  <th>Mã lớp học phần</th>
                  <th>Số lượng</th>
                  <th>Giảng viên</th>
                  <th>Học kỳ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../TrangMau/connSql.php';
                $i = 1;
                $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.*
                        FROM `lophp` 
                          LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
                          LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK`;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo'
                      <tr class="no-select">
                        <td>'.$i.'</td>
                        <td>'.$row["MaMon"].'</td>
                        <td>'.$row["MaLopHP"].'</td>
                        <td>'.$row["SoLuongSV"].'</td>
                        <td>'.$row["TenGV"].'</td>
                        <td>'.$row["TenHK"].', '.$row["NamHoc"].'</td>
                      </tr>
                    ';
                    $i++;
                  }
                }
                $conn->close();
                ?>
              </tbody>
            </table>
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
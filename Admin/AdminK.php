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
        <div class="content row container-fluid">
          <div class="div--set row">
            <div class="div--input col-9">
              <div class="input--add">
                <label for="inp--MK">Mã khoa:</label>
                <input type="text" class="input--type" name="Mã khoa" id="inp--MK">
              </div>
              <div class="input--add">
                <label for="inp--TK">Tên Khoa:</label>
                <input type="text" class="input--type" name="Tên Khoa" id="inp--TK">
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
                  <th>Mã khoa</th>
                  <th>Tên Khoa</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../TrangMau/connSql.php';
                $i = 1;
                $sql = "SELECT * FROM `khoa`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo'
                      <tr class="no-select">
                        <td>'.$i.'</td>
                        <td>'.$row["Makhoa"].'</td>
                        <td>'.$row["TenKhoa"].'</td>
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
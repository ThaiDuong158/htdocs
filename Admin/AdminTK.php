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
                <label for="inp--Name">Họ và Tên:</label>
                <input type="text" class="input--type" name="Tên" id="inp--Name">
              </div>
              <div class="input--add">
                <label for="inp--id">Mã Người dùng:</label>
                <input type="text" class="input--type" name="Mã Người dùng" id="inp--id">
              </div>
              <div class="input--add">
                <label for="inp--mail">Gmail:</label>
                <input type="text" class="input--type" name="Gmail" id="inp--mail">
              </div>
              <div class="input--add">
                <label for="inp--userName">Tên đăng nhập:</label>
                <input type="text" class="input--type" name="Tên đăng nhập" id="inp--userName">
              </div>
              <div class="input--add">
                <label for="inp--pass">Mật khẩu:</label>
                <input type="text" class="input--type" name="Mật khẩu" id="inp--pass">
              </div>
              <div class="input--add">
                <label for="inp--quyen">Quyền:</label>
                <select name="Quyền" class="input--type input--select" id="select--quyen">
                  <option value="1">Admin</option>
                  <option value="2">Giảng Viên</option>
                  <option value="3">Sinh Viên</option>
                </select>
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
                  <th>Họ và Tên</th>
                  <th>Mã Người dùng</th>
                  <th>Gmail</th>
                  <th>Tên đăng nhập</th>
                  <th>Mật khẩu</th>
                  <th>Quyền</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../TrangMau/connSql.php';
                $i = 1;
                $sql = "SELECT `admin`.*, `dangnhap`.*, `quyen`.`tenQuyen`
                        FROM `admin`, `dangnhap` 
                          LEFT JOIN `quyen` ON `dangnhap`.`idQuyen` = `quyen`.`idQuyen`
                          WHERE `admin`.`idUser` = `dangnhap`.`idUser`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <tr class="no-select">
                        <td>' . $i . '</td>
                        <td>' . $row["HoTen"] . '</td>
                        <td>' . $row["idUser"] . '</td>
                        <td>' . $row["Mail"] . '</td>
                        <td>' . $row["tenDangNhap"] . '</td>
                        <td>' . $row["matKhau"] . '</td>
                        <td>' . $row["tenQuyen"] . '</td>
                      </tr>
                    ';
                    $i++;
                  }
                }

                $sql = "SELECT `giangvien`.*, `dangnhap`.*, `quyen`.`tenQuyen`
                        FROM `giangvien`, `dangnhap` 
                          LEFT JOIN `quyen` ON `dangnhap`.`idQuyen` = `quyen`.`idQuyen`
                          WHERE `giangvien`.`MaGV` = `dangnhap`.`idUser`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <tr class="no-select">
                        <td>' . $i . '</td>
                        <td>' . $row["TenGV"] . '</td>
                        <td>' . $row["MaGV"] . '</td>
                        <td>' . $row["Mail"] . '</td>
                        <td>' . $row["tenDangNhap"] . '</td>
                        <td>' . $row["matKhau"] . '</td>
                        <td>' . $row["tenQuyen"] . '</td>
                      </tr>
                    ';
                    $i++;
                  }
                }

                $sql = "SELECT `sinhvien`.*,  `dangnhap`.*, `quyen`.`tenQuyen`
                        FROM `sinhvien`, `dangnhap` 
                          LEFT JOIN `quyen` ON `dangnhap`.`idQuyen` = `quyen`.`idQuyen`
                            WHERE `sinhvien`.`MaSV` = `dangnhap`.`idUser`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <tr class="no-select">
                        <td>' . $i . '</td>
                        <td>' . $row["TenSV"] . '</td>
                        <td>' . $row["idUser"] . '</td>
                        <td>' . $row["Email"] . '</td>
                        <td>' . $row["tenDangNhap"] . '</td>
                        <td>' . $row["matKhau"] . '</td>
                        <td>' . $row["tenQuyen"] . '</td>
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
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
                <label for="inp--MM">Mã môn:</label>
                <input type="text" class="input--type" name="Mã Môn" id="inp--MM">
              </div>
              <div class="input--add">
                <label for="inp--CH">Câu hỏi:</label>
                <input type="text" class="input--type" name="Câu hỏi" id="inp--CH">
              </div>
              <div class="input--add">
                <label for="inp--DA1">Đáp án 1:</label>
                <input type="text" class="input--type" name="Đáp án 1" id="inp--DA1">
              </div>
              <div class="input--add">
                <label for="inp--DA2">Đáp án 2:</label>
                <input type="text" class="input--type" name="Đáp án 2" id="inp--DA2">
              </div>
              <div class="input--add">
                <label for="inp--DA3">Đáp án 3:</label>
                <input type="text" class="input--type" name="Đáp án 3" id="inp--DA3">
              </div>
              <div class="input--add">
                <label for="inp--DA4">Đáp án 4:</label>
                <input type="text" class="input--type" name="Đáp án 4" id="inp--DA4">
              </div>
              <div class="input--add">
                <label for="inp--DA">Đáp án:</label>
                <input type="text" class="input--type" name="Đáp án" id="inp--DA">
              </div>
              <div class="input--add">
                <label for="inp--MD">Mức độ:</label>
                <input type="text" class="input--type" name="Mức độ" id="inp--MD">
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
                  <th>Câu hỏi</th>
                  <th>Đáp án 1</th>
                  <th>Đáp án 2</th>
                  <th>Đáp án 3</th>
                  <th>Đáp án 4</th>
                  <th>Đáp án</th>
                  <th>Mức độ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../TrangMau/connSql.php';
                $i = 1;
                $sql = "SELECT * FROM `cauhoi`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <tr class="no-select">
                        <td>' . $i . '</td>
                        <td>' . $row["MaMon"] . '</td>
                        <td>' . $row["CauHoi"] . '</td>
                        <td>' . $row["CauTraLoi1"] . '</td>
                        <td>' . $row["CauTraLoi2"] . '</td>
                        <td>' . $row["CauTraLoi3"] . '</td>
                        <td>' . $row["CauTraLoi4"] . '</td>
                        <td>' . $row["DapAn"] . '</td>
                        <td>' . $row["MucDo"] . '</td>
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
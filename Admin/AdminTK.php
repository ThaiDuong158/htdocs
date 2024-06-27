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
                  <?php
                  include '../TrangMau/connSql.php';
                  $sql = "SELECT * FROM `quyen`";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '
                        <option value="' . $row["idQuyen"] . '">' . $row["tenQuyen"] . '</option>
                      ';
                    }
                  }
                  $conn->close();
                  ?>
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
            <?php
              include '../TrangMau/connSql.php';
              include '../Admin/loadTK.php';
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
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      var btnAdd = document.querySelector('.btn--add');
      var btnEdit = document.querySelector('.btn--edit');
      var btnDel = document.querySelector('.btn--del');
      var mkc;
      var table = "dangnhap";

      var thongSo = (table, mkc) => {
        var ht = document.querySelector('#inp--Name').value;
        var usId = document.querySelector('#inp--id').value;
        var mail = document.querySelector('#inp--mail').value;
        var us = document.querySelector('#inp--userName').value;
        var pass = document.querySelector('#inp--pass').value;
        var quyen = document.querySelector('#select--quyen').value;
        return `?table=${encodeURIComponent(table)}&
                  ht=${encodeURIComponent(ht)}&
                  usId=${encodeURIComponent(usId)}&
                  mail=${encodeURIComponent(mail)}&
                  us=${encodeURIComponent(us)}&
                  pass=${encodeURIComponent(pass)}&
                  quyen=${encodeURIComponent(quyen)}&
                mkc=${encodeURIComponent(mkc)}`;
      }

      function ajax(btn, fileLoad) {
        btn.onclick = () => {
          const ts = thongSo(table, mkc)
          const xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
              alert("Cập nhật thành công!");
              document.querySelector('.div--table').innerHTML = this.responseText;
              initialize();
            } else if (this.readyState === 4) {
              alert("Có lỗi xảy ra khi cập nhật.");
            }
          };
          xhttp.open("GET", `${fileLoad}${ts}`, true);
          xhttp.send();
        };
      }

      function initialize() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            eval(this.responseText);
          }
        };
        xhttp.open("GET", "../js/adminSelect.js", true);
        xhttp.send();

        document.querySelectorAll(".div--table tbody tr").forEach(row => {
          row.addEventListener('click', () => {
            mkc = row.querySelectorAll("td")[2].innerText;
          });
        });
        ajax(btnAdd, "../Admin/Add.php");
        ajax(btnEdit, "../Admin/Edit.php");
        ajax(btnDel, "../Admin/Del.php");
      }

      initialize();
    });
  </script>
</body>

</html>
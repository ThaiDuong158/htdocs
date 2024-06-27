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
            <?php
            include '../TrangMau/connSql.php';
            include '../Admin/loadKhoa.php';
            $conn->close();
            ?>
          </div>
        </div>
        <?php include '../TrangMau/footer.php'; ?>
      </div>
    </div>
  </div>
  <?php include '../TrangMau/hideSidebar.php'; ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      var btnAdd = document.querySelector('.btn--add');
      var btnEdit = document.querySelector('.btn--edit');
      var btnDel = document.querySelector('.btn--del');
      var mkc;
      var table = "khoa"
      var thongSo = (table,mkc) => {
        var mk = document.querySelector('#inp--MK').value;
          var tk = document.querySelector('#inp--TK').value;
        return `?table=${encodeURIComponent(table)}&mk=${encodeURIComponent(mk)}&tk=${encodeURIComponent(tk)}&mkc=${encodeURIComponent(mkc)}`;
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
            mkc = row.querySelectorAll("td")[1].innerText;
          });
        });
        ajax(btnAdd,"../Admin/Add.php");
        ajax(btnEdit,"../Admin/Edit.php");
        ajax(btnDel,"../Admin/Del.php");

      }

      initialize();
    });
  </script>
  <script src="../js/main.js"></script>
</body>

</html>
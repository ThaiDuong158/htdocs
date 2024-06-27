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
                <label for="inp--TM">Tên Môn:</label>
                <input type="text" class="input--type" name="Tên Môn" id="inp--TM">
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
                <?php
                  include '../TrangMau/connSql.php';
                  include '../Admin/loadLHP.php';
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
      var table = "lophp";

      var thongSo = (table, mkc) => {
        var mm = document.querySelector('#inp--MM').value;
        var tm = document.querySelector('#inp--TM').value;
        var mlhp = document.querySelector('#inp--LHP').value;
        var sl = document.querySelector('#inp--SL').value;
        var gv = document.querySelector('#inp--GV').value;
        var hk = document.querySelector('#inp--HK').value;
        return `?table=${encodeURIComponent(table)}&
                  mm=${encodeURIComponent(mm)}&
                  tm=${encodeURIComponent(tm)}&
                  mlhp=${encodeURIComponent(mlhp)}&
                  sl=${encodeURIComponent(sl)}&
                  gv=${encodeURIComponent(gv)}&
                  hk=${encodeURIComponent(hk)}&
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
            mkc = row.querySelectorAll("td")[3].innerText;
            console.log(mkc);
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
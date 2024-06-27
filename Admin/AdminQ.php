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
            <?php
            include '../TrangMau/connSql.php';
            include '../Admin/loadQ.php';
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
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      var btnAdd = document.querySelector('.btn--add');
      var btnEdit = document.querySelector('.btn--edit');
      var btnDel = document.querySelector('.btn--del');
      var mkc;
      var table = "cauhoi";

      var thongSo = (table, mkc) => {
        var mm = document.querySelector('#inp--MM').value;
        var ch = document.querySelector('#inp--CH').value;
        var da1 = document.querySelector('#inp--DA1').value;
        var da2 = document.querySelector('#inp--DA2').value;
        var da3 = document.querySelector('#inp--DA3').value;
        var da4 = document.querySelector('#inp--DA4').value;
        var da = document.querySelector('#inp--DA').value;
        var md = document.querySelector('#inp--MD').value;
        return `?table=${encodeURIComponent(table)}&
                  mm=${encodeURIComponent(mm)}&
                  ch=${encodeURIComponent(ch)}&
                  da1=${encodeURIComponent(da1)}&
                  da2=${encodeURIComponent(da2)}&
                  da3=${encodeURIComponent(da3)}&
                  da4=${encodeURIComponent(da4)}&
                  da=${encodeURIComponent(da)}&
                  md=${encodeURIComponent(md)}&
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
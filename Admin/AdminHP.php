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
                <label for="inp--ST">Số tiền:</label>
                <input type="text" class="input--type" name="Số tiền" id="inp--ST">
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
            include '../Admin/loadHP.php';
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
      var mkc = [];
      var table = "hocphi"
      var thongSo = (table, mkc) => {
        var idSv = document.querySelector('#inp--SV').value;
        var mm = document.querySelector('#inp--MM').value;
        var tm = document.querySelector('#inp--TM').value;
        var st = document.querySelector('#inp--ST').value;
        var tt = document.querySelector('#inp--TT').value;
        var hk = document.querySelector('#inp--HK').value;
        return `?table=${encodeURIComponent(table)}
                  &idSv=${encodeURIComponent(idSv)}
                  &mm=${encodeURIComponent(mm)}
                  &tm=${encodeURIComponent(tm)}
                  &st=${encodeURIComponent(st)}
                  &tt=${encodeURIComponent(tt)}
                  &hk=${encodeURIComponent(hk)}
                  &msvc=${encodeURIComponent(mkc[0])}
                  &mmc=${encodeURIComponent(mkc[1])}
                `;
      };

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
            mkc[0] = row.querySelectorAll("td")[1].innerText;
            mkc[1] = row.querySelectorAll("td")[2].innerText;
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
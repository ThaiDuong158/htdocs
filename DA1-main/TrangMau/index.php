<?php
session_start();
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
  include "../connect.php";
?>

  <link rel="stylesheet" href="../chat/style.css">
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
  </head>

  <body>
    <div class="main container-fluid">
      <header class="header">
        <div class="row">
          <div class="sidebar-width col-2 bg-success d-flex">
            <a href="../TrangMau/index.php" class="container-fluid d-inline-flex justify-content-center align-items-center">
              <img src="../icon/iconVLUTE.png" class="header__icon" alt="">
              <p class="text-white sidebar-hide">VLUTE</p>
            </a>
          </div>
          <div class="col container-fluid d-inline-flex justify-content-between">
            <i class="fa-solid fa-bars sidebar-mini text-white align-content-center header__bar"></i>
            <div class="d-inline-flex no-select align-items-center text-white">
              <div class="header__login d-none align-items-center text-white">
                <i class="fa-solid fa-right-to-bracket"></i>
                <p>Đăng nhập</p>
              </div>
              <div class="header__login d-inline-flex  align-items-center text-white">
                <img src="../icon/basicUser.jpg" class="rounded-circle" alt="Cinque Terre" width="25" height="25">
                <p><?php $result = mysqli_query($conn, "SELECT TenSV from SinhVien Where MaSV = '" . $_SESSION['user_id'] . "'");
                    if (mysqli_num_rows($result) > 0) {
                      $row = mysqli_fetch_array($result);
                      echo $row['TenSV'];
                    } ?></p>
                <div class="dropdown-list" style="width: 280px;">
                  <div class="dropdown-info d-flex flex-column align-items-center">
                    <img src="../icon/basicUser.jpg" class="rounded-circle" alt="" width="90" height="90">
                    <div class="dropdown-text">
                      <?php
                      if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
                        include("../connect.php");
                        $sql = "SELECT TenSV, MaSV,MaLop from Sinhvien where MaSV = '" . $_SESSION['user_id'] . "'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          $Tensv = $row['TenSV'];
                          $Masv = $row['MaSV'];
                          $MaLop = $row['MaLop'];
                          echo   "<p>" . $Tensv . "</p>";
                          echo   "<p>" . $Masv . "</p>";
                          echo   "<p>" . $MaLop . "</p>";
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <div class="dropdown-setting d-flex justify-content-between">
                    <button class="dropdown-mk">Đổi mật khẩu</button>
                    <button class="dropdown-dx" id="btndangxuat">Đăng xuất</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="row">
        <div class="sidebar sidebar-width col-sm-2">
          <a href="../TrangMau/index.php" class="sidebar-item left-line no-select">
            <i class="sidebar-icon fa-solid fa-house"></i>
            <p class="sidebar-hide">Trang chủ</p>
          </a>
          <a href="../DiemDanh/DiemDanh.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-calendar-days"></i>
            <p class="sidebar-hide">Điểm danh</p>
          </a>
          <a href="../TKB/TKB.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-calendar-days"></i>
            <p class="sidebar-hide">Thời khóa biểu</p>
          </a>
          <a href="../TTCN/ttcn.php" class="sidebar-item no-select">
            <i class="fa fa-address-card"></i>
            <p class="sidebar-hide">Thông tin cá nhân</p>
          </a>
        </div>
        <div class="col bg-light d-flex flex-column justify-content-between">
          <div class="content row container-fluid" style="height: 100px;">

          </div>
          <div class="row">
            <footer class="footer text-primary d-inline-flex justify-content-between">
              <div class="footer__left">
                <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
                <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vĩnh Long, tỉnh Vĩnh Long</p>
                <p>Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
              </div>
              <div class="footer__right">
                <p>© 2017 Nguyễn Duy Phúc</p>
                <p>Email: duyphucit@live.com</p>
              </div>
            </footer>

          </div>
        </div>
      </div>
    </div>
    <script></script>
  </body>
  <script src="../js/main.js"></script>
  <script>
    // Add event listener to logout button (make sure it has an ID)
    document.getElementById('btndangxuat').addEventListener('click', function() {
      // Send AJAX request to logout.php
      fetch('dangxuat.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        })
        .then(response => {
          if (response.ok) {
            // Redirect to login page after successful logout
            window.location.href = '../login/dangnhap.php';
          } else {
            console.error('Logout failed');
          }
        })
        .catch(error => {
          console.error('Request failed:', error);
        });
    });
  </script>

  </html>
<?php
} else {
  header("location:../login/dangnhap.php");
}
?>
<?php
include("../connect.php");
?>
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
          echo $row['TenSV'];}?></p>
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
                    echo   "<p>".$Tensv."</p>";
                    echo   "<p>".$Masv."</p>";
                    echo   "<p>".$MaLop."</p>";
                  }
                }
                ?>
              </div>
            </div>
            <div class="dropdown-setting d-flex justify-content-between">
              <button class="dropdown-mk" id="btndoipass">Đổi mật khẩu</button>
              <button class="dropdown-dx" id="btndangxuat">Đăng xuất</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<script>
  // Add event listener to logout button (make sure it has an ID)
  document.getElementById('btndangxuat').addEventListener('click', function() {
    // Send AJAX request to logout.php
    fetch('../TrangMau/dangxuat.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
      .then(response => {
        if (response.ok) {
          // Redirect to login page after successful logout
          <?php
          unset($_SESSION["MaSV"]);
          ?>
          window.location.href = '../login/dangnhap.php';
        } else {
          console.error('Logout failed');
        }
      })
      .catch(error => {
        console.error('Request failed:', error);
      });
  });

  document.getElementById("btndoipass").addEventListener('click',function(){


});
</script>
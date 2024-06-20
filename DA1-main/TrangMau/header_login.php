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
                    <img src="../icon/basicUser.jpg"  id="dangnhap" class="rounded-circle" alt="Cinque Terre" width="25" height="25">
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    
    // Add event listener to logout button (make sure it has an ID)
    document.getElementById('dangnhap').addEventListener('click', function() {
        // Send AJAX request to logout.php
        fetch('../login/dangnhap.php', {
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
</script>
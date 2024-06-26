<div class="sidebar sidebar-width sidebar-transition col-sm-2">

    <a href="../TrangMau/index.php" class="sidebar-item no-select">
        <i class="sidebar-icon fa-solid fa-house"></i>
        <p class="sidebar-hide">Trang chủ</p>
    </a>

    <?php if (isset($_SESSION["idQuyen"]) && ($_SESSION["idQuyen"] == 2)) { ?>
        <a href="../TKB/TKB.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-calendar-days"></i>
            <p class="sidebar-hide">Thời Khóa Biểu</p>
        </a>
        <a href="../TTCN/ttcn.php" class="sidebar-item no-select">
            <i class="sidebar fa fa-address-card"></i>
            <p class="sidebar-hide">Thông tin cá nhân</p>
        </a>
        <a href="../LopHoc/searchLHP.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-magnifying-glass"></i>
            <p class="sidebar-hide">Lớp Học</p>
        </a>
        <a href="../chat/chat.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-comment"></i>
            <p class="sidebar-hide">Chat</p>
        </a>
    <?php } ?>

    <?php if (isset($_SESSION["idQuyen"]) && ($_SESSION["idQuyen"] == 3)) { ?>
        <!-- <a href="../DiemDanh/DiemDanh.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-calendar-days"></i>
            <p class="sidebar-hide">Điểm danh</p>
        </a> -->
        <a href="../TKB/TKB.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-calendar-days"></i>
            <p class="sidebar-hide">Thời Khóa Biểu</p>
        </a>
        <a href="../LopHoc/searchLHP.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-magnifying-glass"></i>
            <p class="sidebar-hide">Lớp Học</p>
        </a>
        <a href="../TTCN/ttcn.php" class="sidebar-item no-select">
            <i class="sidebar fa fa-address-card"></i>
            <p class="sidebar-hide">Thông tin cá nhân</p>
        </a>
        <a href="../chat/chat.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-comment"></i>
            <p class="sidebar-hide">Chat</p>
        </a>
    <?php } ?>

    <?php if (isset($_SESSION["idQuyen"]) && $_SESSION["idQuyen"] == 1) { ?>
        <a href="../Admin/AdminTK.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-user"></i>
            <p class="sidebar-hide">Tài Khoản</p>
        </a>
        <a href="../Admin/AdminK.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-briefcase"></i>
            <p class="sidebar-hide">Khoa</p>
        </a>
        <a href="../Admin/AdminLHP.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-graduation-cap"></i>
            <p class="sidebar-hide">Lớp học phần</p>
        </a>
        <a href="../Admin/AdminQ.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-clipboard-question"></i>
            <p class="sidebar-hide">Ngân hàng câu hỏi</p>
        </a>
        <a href="../Admin/AdminHP.php" class="sidebar-item no-select">
            <i class="sidebar fa-solid fa-money-bill-1-wave"></i>
            <p class="sidebar-hide">Học phí</p>
        </a>
    <?php } ?>

</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/lopHoc.css">
    <title>Lớp học</title>
</head>

<body>
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col bg-light d-flex flex-column justify-content-between">
                <?php
                include '../TrangMau/connSql.php';
                $id = isset($_GET["id"]) ? $_GET["id"] : '';
                $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.`TenHK`, `mon`.`MaMon`, `mon`.`TenMon`
                        FROM `lophp` 
                            LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
                            LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK` 
                            LEFT JOIN `mon` ON `lophp`.`MaMon` = `mon`.`MaMon`
                            WHERE `lophp`.`idLopHP` = '" . $id . "'
                        ;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="content row container-fluid d-flex flex-column">
                            <div class="title container-fluid">
                                <?php echo ' <h1>' . $row["MaLopHP"] . ' GV: ' . $row["TenGV"] . '</h1> '; ?>
                            </div>
                            <div class="content-main container-fluid">
                                <ul class="content--list__l1">
                                    <li class="section-1 content--item__l1">
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <?php include '../icon/svg/iconNotifi.php' ?>
                                                <p class="content--item__l2--title">Thông báo</p>
                                            </li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="section-2 content--item__l1">
                                        <h4 class="contect--item__title">1. THÔNG TIN HỌC PHẦN</h4>
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <i class="content--item__icon fa-solid fa-address-card"></i>
                                            </li>
                                            <li class="content--item__l2">
                                                <i class="content--item__icon fa-solid fa-eye-dropper"></i>
                                            </li>
                                            <li class="content--item__l2">
                                                <i class="content--item__icon fa-solid fa-anchor"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="section-3 content--item__l1">
                                        <h4 class="contect--item__title">2. KẾ HOẠCH GIẢNG DẠY</h4>
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <?php
                                                if (isset($_SESSION["idQuyen"]) && ($_SESSION["idQuyen"] == 2)) { ?>
                                                    <a href="../DiemDanh/DiemDanh.php<?php echo '?id=' . $_GET["id"]; ?>"
                                                        class="content--item__link">
                                                        <i class="content--item__icon fa-solid fa-align-justify"></i>
                                                        <p class="content--item__l2--title">Điểm danh</p>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="section-4 content--item__l1">
                                        <h4 class="contect--item__title">3. ĐỀ CƯƠNG HỌC PHẦN</h4>
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <img class="content--item__icon" src="../icon/pdf-24.png" alt="">
                                            </li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="section-5 content--item__l1">
                                        <h4 class="contect--item__title">4. GIÁO TRÌNH - BÀI GIẢNG - TÀI LIỆU THAM KHẢO</h4>
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <img class="content--item__icon" src="../icon/pdf-24.png" alt="">
                                            </li>
                                            <li class="content--item__l2">
                                                <i class="content--item__icon fa-solid fa-folder-open"></i>
                                            </li>
                                            <li class="content--item__l2">
                                                <i class="content--item__icon fa-solid fa-link"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="section-6 content--item__l1">
                                        <h4 class="contect--item__title">5. BÀI TẬP</h4>
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <a href="../NopBai/TrangThaiNopBai.php" class="content--item__link">
                                                    <i class="content--item__icon fa-solid fa-file"></i>
                                                    <p class="content--item__l2--title">Bài tập</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="section-7 content--item__l1">
                                        <h4 class="contect--item__title">6. KIỂM TRA ĐÁNH GIÁ</h4>
                                        <ul class="content--list__l2">
                                            <li class="content--item__l2">
                                                <a href="../BaiKiemTra/TrangThaiKiemTra.php" class="content--item__link">
                                                    <i class="content--item__icon fa-solid fa-file"></i>
                                                    <p class="content--item__l2--title">Kiểm Tra</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php include '../TrangMau/footer.php'; ?>
                        <script>
                            document.querySelectorAll('a[href="../NopBai/TrangThaiNopBai.php"]').forEach((a, i) => {
                                a.href = a.href + `<?php echo '?id=' . $id . '&num=' ?>${i + 1}`;
                            });
                            document.querySelectorAll('a[href="../BaiKiemTra/TrangThaiKiemTra.php"]').forEach((a, i) => {
                                a.href = a.href + `<?php echo '?id=' . $id . '&num=' ?>${i + 1}`;
                            });
                        </script>
                        <script>
                            document.querySelector('a[href = "../LopHoc/searchLHP.php"]').classList.add('left-line')
                        </script>
                    </div>
                </div>
                <?php
                    }
                }
                $conn->close();
                ?>
    </div>
    <?php include '../TrangMau/hideSidebar.php' ?>
</body>
<script src="../js/main.js"></script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/NopBai.css">
    <title>Document</title>
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
                            <div class="content-main container-fluid d-flex flex-column">
                                <h1 class="content--title">Bài tập</h1>
                                <h3>Submission status</h3>
                                <table class="table table-hover table-striped">
                                    <?php
                                    $date1 = "Saturday, 22 April 2024, 6:00 PM";
                                    $date2 = "Friday, 19 April 2024, 5:10 PM";
                                    $datetime1 = DateTime::createFromFormat('l, d F Y, h:i A', $date1);
                                    $datetime2 = DateTime::createFromFormat('l, d F Y, h:i A', $date2);
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->days;
                                    $hours = $interval->h;
                                    $minutes = $interval->i;
                                    $str = "";
                                    if ($days != 0)
                                        $str = $str . '' . $days . ' ngày';
                                    if ($hours != 0)
                                        $str = $str . ' ' . $hours . ' giờ';
                                    if ($minutes != 0)
                                        $str = $str . ' ' . $minutes . ' phút';
                                    if ($datetime1 < $datetime2)
                                        $str = $str . ' late ';
                                    else
                                        $str = $str . ' ago ';
                                    echo '
                                        <tr>
                                            <td>Hạn chót</td>
                                            <td>' . $date1 . '</td>
                                        </tr>
                                        <tr>
                                            <td>Time remaining</td>
                                            <td>Assignment was submitted ' . $str . ' </td>
                                        </tr>
                                        <tr>
                                            <td>Last modified</td>
                                            <td>' . $date2 . '</td>
                                        </tr>
                                        <tr>
                                            <td>File submissions</td>
                                            <td>21004277_PhanDangThaiDuong.docx</td>
                                        </tr>
                                    ';
                                    ?>
                                </table>
                                <button class="btn--change btn btn-success">
                                    <a href="../NopBai/NopBai.php<?php echo '?id=' . $id . '&num=' . $_GET["num"] . ''; ?>">
                                        SỬA BÀI NỘP
                                    </a>
                                </button>
                            </div>
                        </div>
                        <?php
                    }
                }
                $conn->close();
                ?>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('a[href = "../LopHoc/searchLHP.php"]').classList.add('left-line')
    </script>
    <?php include '../TrangMau/hideSidebar.php' ?>
</body>
<script src="../js/main.js"></script>

</html>
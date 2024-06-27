<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/diemDanh.css">
    <title>Document</title>
</head>

<body>
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid">
                    <form action="" method="POST">
                        <div class="">
                            <table class="table table-bordered">
                                <thead class="thead">
                                    <tr>
                                        <th rowspan="2">STT</th>
                                        <th rowspan="2">MSSV</th>
                                        <th rowspan="2">HỌ VÀ TÊN</th>
                                        <th rowspan="2">MÃ LỚP</th>
                                        <th colspan="15">ĐIỂM DANH</th>
                                    </tr>
                                    <tr>
                                        <?php include '../TrangMau/connSql.php'; ?>
                                        <?php
                                        $mssv = $_COOKIE[$cookie_name];
                                        $sql = "SELECT DATE_FORMAT(`diemdanh`.`NgayDiemDanh`, '%d/%m') AS `NgayThang`
                                                FROM `diemdanh` 
                                                    LEFT JOIN `lophp` ON `diemdanh`.`MaLopHP` = `lophp`.`idLopHP`
                                                    WHERE `lophp`.`idLopHP` = '".$_GET["id"]."'
                                                    GROUP BY `NgayThang`
                                                    ORDER BY `NgayThang` ASC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<td>" . $row["NgayThang"] . "</td>";
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include '../TrangMau/connSql.php'; ?>
                                    <?php
                                    $sql = "SELECT `sinhvien`.`TenSV`, `sinhvien`.`MaSV`, `lop`.`malop`
                                            FROM `sinhvien` 
                                                LEFT JOIN `lop` ON `sinhvien`.`MaLop` = `lop`.`malop`, `lophp`
                                                WHERE `lophp`.`idLopHP` = '".$_GET["id"]."'
                                                ORDER BY `sinhvien`.`MaSV` ASC;";
                                    $result = $conn->query($sql);
                                    $i = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td class="center">' . $i . '</td>
                                                <td>' . $row["TenSV"] . '</td>
                                                <td>' . $row["MaSV"] . '</td>
                                                <td>' . $row["malop"] . '</td>';
                                            $sql1 = "SELECT `diemdanh`.`NgayDiemDanh`, `sinhvien`.`MaSV`, `lophp`.`MaLopHP`, `diemdanh`.`TrangThai`
                                                    FROM `diemdanh` 
                                                        LEFT JOIN `sinhvien` ON `diemdanh`.`MaSV` = `sinhvien`.`MaSV` 
                                                        LEFT JOIN `lophp` ON `diemdanh`.`MaLopHP` = `lophp`.`idLopHP`
                                                        WHERE 	`sinhvien`.`MaSV` = '" . $row["MaSV"] . "' AND
                                                                `lophp`.`idLopHP` = '".$_GET["id"]."'
                                                        ORDER BY `diemdanh`.`NgayDiemDanh` ASC;";
                                            $result1 = $conn->query($sql1);
                                            $i1 = 1;
                                            if ($result1->num_rows > 0) {
                                                // output data of each row
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    $checkboxName = 'checkbox_' . $row["MaSV"] . '_' . $i1;
                                                    if ($row1["TrangThai"] == '0') {
                                                        echo '<td class="center"><input type="checkbox" name="' . $checkboxName . '" id="" value="0"></td>';
                                                    } else {
                                                        echo '<td class="center"><input type="checkbox" name="' . $checkboxName . '" id="" value="1" checked></td>';
                                                    }
                                                    $i1++;
                                                }
                                            }
                                            $i++;
                                            echo '</tr>';
                                        }
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                            <script>
                                document.querySelectorAll("input[type=checkbox]").forEach((checkbox) => {
                                    checkbox.addEventListener("change", function () {
                                        if (this.checked) {
                                            this.value = 1;
                                        } else {
                                            this.value = 0;
                                        }
                                    });
                                })
                            </script>
                        </div>
                        <div class="button">
                            <input type="submit" class="btn btn-success btn-Update" value="Lưu">
                        </div>
                    </form>
                </div>

                <?php
                // Xử lý sự kiện sau khi bấm nút "Lưu"
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include '../TrangMau/connSql.php';
                    $sqlt = "UPDATE `diemdanh` SET `TrangThai` = '0' 
                            WHERE 	`TrangThai` = '1' AND 
                                    `diemdanh`.`MaLopHP` = 
                                    (SELECT `lophp`.`idLopHP` 
                                    FROM lophp 
                                    WHERE `lophp`.`idLopHP` = '".$_GET["id"]."' )";
                    $conn->query($sqlt);
                    foreach ($_POST as $key => $value) {
                        if (strpos($key, 'checkbox_') === 0) {
                            $keyParts = explode('_', $key);
                            $maSV = $keyParts[1];
                            $buoiHoc = $keyParts[2];
                            $trangThai = $value;

                            // Lấy ngày điểm danh tương ứng với buổi học
                            $sqlDate = "SELECT `NgayDiemDanh`
                                        FROM `diemdanh`
                                            LEFT JOIN `lophp` ON `diemdanh`.`MaLopHP` = `lophp`.`idLopHP`
                                            WHERE   `MaSV` = '$maSV' AND 
                                                    `lophp`.`idLopHP` = '".$_GET["id"]."'
                                            ORDER BY `NgayDiemDanh` ASC
                                            LIMIT " . ($buoiHoc - 1) . ", 1;";
                            $resultDate = $conn->query($sqlDate);
                            $rowDate = $resultDate->fetch_assoc();
                            $ngayDiemDanh = $rowDate['NgayDiemDanh'];
                            $sql = "UPDATE `diemdanh` 
                                    SET `TrangThai` = '$trangThai' 
                                    WHERE `MaSV` = '$maSV' AND `NgayDiemDanh` = '$ngayDiemDanh'";

                            if ($conn->query($sql) !== TRUE) {
                                echo '<script>alert("Cập nhật thất bại! ' . $conn->error . '");</script>';
                                exit();
                            }
                        }
                    }
                    $conn->close();
                    echo '<script>alert("Cập nhật thành công!");</script>';
                    echo '<script>window.location.href = "../LopHoc/lopHoc.php?id=' . $_GET["id"] . '";</script>';
                }
                ?>

                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>

    <?php include '../TrangMau/hideSidebar.php'; ?>

</body>
<script src="../js/main.js"></script>
<script>
    document.querySelector('a[href = "../LopHoc/searchLHP.php"]').classList.add('left-line')
</script>

</html>
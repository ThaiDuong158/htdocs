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
                                                    WHERE `lophp`.`MaLopHP` = '232_1TH1507_KS3A_10_ngoaigio'
                                                    ORDER BY `diemdanh`.`NgayDiemDanh` ASC";
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
                                <tr>
                                    <?php include '../TrangMau/connSql.php'; ?>
                                    <?php
                                    $sql = "SELECT `sinhvien`.`TenSV`, `sinhvien`.`MaSV`, `lop`.`malop`
                                            FROM `sinhvien` 
                                                LEFT JOIN `lop` ON `sinhvien`.`MaLop` = `lop`.`malop`;";
                                    $result = $conn->query($sql);
                                    $i = 1;
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo'<td class="center">'.$i.'</td>
                                                <td>'.$row["TenSV"].'</td>
                                                <td>'.$row["MaSV"].'</td>
                                                <td>'.$row["malop"].'</td>';
                                            $sql1 = "SELECT `diemdanh`.`NgayDiemDanh`, `sinhvien`.`MaSV`, `lophp`.`MaLopHP`, `diemdanh`.`TrangThai`
                                                    FROM `diemdanh` 
                                                        LEFT JOIN `sinhvien` ON `diemdanh`.`MaSV` = `sinhvien`.`MaSV` 
                                                        LEFT JOIN `lophp` ON `diemdanh`.`MaLopHP` = `lophp`.`idLopHP`
                                                        WHERE 	`sinhvien`.`MaSV` = '".$row["MaSV"]."' AND
                                                                `lophp`.`MaLopHP` = '232_1TH1507_KS3A_10_ngoaigio'
                                                        ORDER BY `diemdanh`.`NgayDiemDanh` ASC;";
                                            $result1 = $conn->query($sql1);
                                            if ($result1->num_rows > 0) {
                                                // output data of each row
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    if ($row1["TrangThai"] == '0') {
                                                        echo'<td class="center"><input type="checkbox" name="" id=""></td>';
                                                    } else {
                                                        echo'<td class="center"><input type="checkbox" name="" id="" checked></td>';
                                                    }
                                                }
                                            }
                                            $i = $i + 1;
                                        }
                                    }
                                    $conn->close();
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="button">
                        <button class="btn btn-success">Lưu</button>
                    </div>
                </div>

                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <?php include '../TrangMau/hideSidebar.php'; ?>

</body>
<script src="../js/main.js"></script>

</html>
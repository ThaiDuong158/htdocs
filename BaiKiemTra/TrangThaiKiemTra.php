<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/kiemTra.css">
    <title>Document</title>
</head>

<body>
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid d-flex flex-column">
                    <div class="title container-fluid">
                        <h1>232_1TH1507_KS3A_10_ngoaigio GV: Nguyễn Vạn Năng</h1>
                    </div>
                    <div class="content-main container-fluid d-flex flex-column">
                        <h2 class="content--title">Kiểm tra giữ kỳ</h2>
                        <div class="content--align d-flex flex-column align-items-center">
                            <p>Attempts allowed: 1</p>
                            <p>Đề thi kết thúc. Wednesday, 23 August 2023, 9:35 PM</p>
                            <p>Để thử đề thi này bạn cần biết mật khẩu của đề thi đó</p>
                            <p>Thời gian làm bài: 30 phút</p>
                        </div>
                        <div>
                            <h2 class="content--title">Summary of your previous attempts</h2>
                            <?php
                            include '../TrangMau/connSql.php';
                            $mssv = $_COOKIE["user"];
                            $maLHP = "232_1TH1507_KS3A_10_ngoaigio";
                            $sql = 'SELECT `diemkt`.*,DATE_FORMAT(`thoiGian`, "%W, %e %M %Y, %h:%i %p") AS formatted_date
                                    FROM `diemkt` 
                                        LEFT JOIN `mon` ON `diemkt`.`MaMon` = `mon`.`MaMon` 
                                        LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
                                        WHERE 	`diemkt`.`mssv` = "' . $mssv . '" AND
                                                `lophp`.`MaLopHP` = "' . $maLHP . ' ";';
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $sql1 = 'SELECT `diemkt`.`soCau`
                                    FROM `diemkt` 
                                        LEFT JOIN `mon` ON `diemkt`.`MaMon` = `mon`.`MaMon` 
                                        LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
                                        WHERE 	`diemkt`.`mssv` = "' . $mssv . '" AND
                                                `lophp`.`MaLopHP` = "' . $maLHP . ' ";';
                                $result1 = $conn->query($sql1);
                                $row1 = $result1->fetch_assoc();
                                echo '
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="bg-success text-white">
                                            <th>State</th>
                                            <th class="text-center">Điểm /  ' . $row1["soCau"] . ',00</th>
                                            <th class="text-center">Điểm / 10,00</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                ';
                                while ($row = $result->fetch_assoc()) {
                                    $cau = round((float) $row["diemKTra"] / 10 * (float) $row["soCau"]);
                                    echo '
                                    <tr>
                                        <td>Finished <br> Submitted ' . $row["formatted_date"] . '</td>
                                        <td class="text-center">' . $cau . '</td>
                                        <td class="text-center">' . $row["diemKTra"] . '</td>
                                    </tr>
                                  ';
                                }
                                echo '
                                    </tbody>
                                </table>
                                ';
                            }
                            $conn->close();
                            ?>
                        </div>
                        <button class="btn--change btn btn-success">
                            <a href="../BaiKiemTra/KiemTra.php">
                                BẮT ĐẦU LÀM KIỂM TRA
                            </a>
                        </button>
                    </div>
                </div>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <?php include '../TrangMau/hideSidebar.php' ?>
    <script>
        document.querySelector('a[href = "../LopHoc/searchLHP.php"]').classList.add('left-line')
    </script>
</body>
<script src="../js/main.js"></script>

</html>
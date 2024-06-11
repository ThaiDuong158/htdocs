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
                    <div class="row container-fluid">
                        <div class="col-9 container-fluid ">
                            <div class="kiemTra">
                                <?php include '../TrangMau/connSql.php' ?>
                                <?php
                                $sql = "SELECT `cauhoi`.*
                                            FROM `cauhoi` 
                                                LEFT JOIN `mon` ON `cauhoi`.`MaMon` = `mon`.`MaMon` 
                                                LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
                                                WHERE `lophp`.`MaLopHP` = '232_1TH1507_KS3A_10_ngoaigio';";
                                $result = $conn->query($sql);
                                $i = 1;
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                            <div class="cau" id="cau-'.$i.'">
                                                <p>Câu '.$i.'. '.$row["CauHoi"].':</p>
                                                <div>
                                                    <input type="radio" name="cau-'.$i.'" id="cau'.$i.'A">
                                                    <label for="cau'.$i.'A">'.$row["CauTraLoi1"].'</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="cau-'.$i.'" id="cau'.$i.'B">
                                                    <label for="cau'.$i.'B">'.$row["CauTraLoi2"].'</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="cau-'.$i.'" id="cau'.$i.'C">
                                                    <label for="cau'.$i.'C">'.$row["CauTraLoi3"].'</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="cau-'.$i.'" id="cau'.$i.'D">
                                                    <label for="cau'.$i.'D">'.$row["CauTraLoi4"].'</label>
                                                </div>
                                            </div>
                                        ';
                                        $i++;
                                    }
                                }
                                $conn->close();
                                ?>
                            </div>
                            <button class="nopBai btn btn-primary">
                                Nộp bài và kết thúc
                            </button>
                        </div>
                        <div class="col-3">
                            <div class="kiemTra-list d-flex flex-wrap">
                                <?php 
                                    for($j = 1; $j < $i; $j++) {
                                        echo'<a href="#cau-'.$j.'">'.$j.'</a>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <?php
        include '../TrangMau/hideSidebar.php';
    ?>
</body>
<script src="../js/main.js"></script>

</html>
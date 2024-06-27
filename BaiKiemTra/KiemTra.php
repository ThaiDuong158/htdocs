<?php
include '../TrangMau/connSql.php';
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT `cauhoi`.*
            FROM `cauhoi` 
                LEFT JOIN `mon` ON `cauhoi`.`MaMon` = `mon`.`MaMon` 
                LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
                WHERE `lophp`.`idLopHP` = '".$id."';";
$result = $conn->query($sql);
$cauHoiArray = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cauHoiArray[] = $row;
    }
}
$conn->close();
?>

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

                                <?php
                                shuffle($cauHoiArray);
                                $maxQuestions = 2;
                                $displayedQuestions = 0;
                                $i = 1;
                                foreach ($cauHoiArray as $cauHoi) {
                                    if ($displayedQuestions >= $maxQuestions) {
                                        break;
                                    }
                                    echo '
                                        <div class="cau" id="cau-' . $i . '">
                                            <p>Câu ' . $i . '. <span class="cauHoi">' . $cauHoi["CauHoi"] . '</span>:</p>
                                            <div class="cau--Hoi d-flex align-items-start">
                                                <input type="radio" value="1" class="cau-TraLoi" name="cau-' . $i . '" id="cau' . $i . 'A">
                                                <label for="cau' . $i . 'A">' . $cauHoi["CauTraLoi1"] . '</label>
                                            </div>
                                            <div class="cau--Hoi d-flex align-items-start">
                                                <input type="radio" value="2" class="cau-TraLoi" name="cau-' . $i . '" id="cau' . $i . 'B">
                                                <label for="cau' . $i . 'B">' . $cauHoi["CauTraLoi2"] . '</label>
                                            </div>
                                            <div class="cau--Hoi d-flex align-items-start">
                                                <input type="radio" value="3" class="cau-TraLoi" name="cau-' . $i . '" id="cau' . $i . 'C">
                                                <label for="cau' . $i . 'C">' . $cauHoi["CauTraLoi3"] . '</label>
                                            </div>
                                            <div class="cau--Hoi d-flex align-items-start">
                                                <input type="radio" value="4" class="cau-TraLoi" name="cau-' . $i . '" id="cau' . $i . 'D">
                                                <label for="cau' . $i . 'D">' . $cauHoi["CauTraLoi4"] . '</label>
                                            </div>
                                        </div>
                                    ';
                                    $i++;
                                    $displayedQuestions++;
                                }
                                ?>
                            </div>
                            <button class="nopBai btn btn-primary">
                                Nộp bài và kết thúc
                            </button>
                        </div>
                        <div class="col-3 sticky">
                            <div class="row kiemTra-list d-flex flex-wrap">
                                <?php
                                for ($j = 1; $j < $i; $j++) {
                                    echo '<a href="#cau-' . $j . '">' . $j . '</a>';
                                }
                                ?>
                            </div>
                            <div class="row kiemTra-ThoiGian d-flex">
                                <h5 class="kiemTra-ThoiGian__title">Thời gian còn lại: </h5>
                                <h5 class="kiemTra-ThoiGian__Chay">00:20:00</h5>
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
    <script>
        document.querySelector('a[href = "../LopHoc/searchLHP.php"]').classList.add('left-line')
    </script>
</body>
<script src="../js/main.js"></script>
<script src="../js/kiemTra.js"></script>
</html>
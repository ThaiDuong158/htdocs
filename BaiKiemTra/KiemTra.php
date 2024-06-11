<?php
include '../TrangMau/connSql.php';
$sql = "SELECT `cauhoi`.*
            FROM `cauhoi` 
                LEFT JOIN `mon` ON `cauhoi`.`MaMon` = `mon`.`MaMon` 
                LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
                WHERE `lophp`.`MaLopHP` = '232_1TH1507_KS3A_10_ngoaigio';";
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
                            <script>
                                document.querySelector('.nopBai').addEventListener('click', () => {
                                    var ketQua = [];
                                    document.querySelectorAll('.cau').forEach((cau, i) => {
                                        var cauTraLoi = 0;
                                        var cauHoi = cau.querySelector('.cauHoi').innerHTML;
                                        cau.querySelectorAll('.cau-TraLoi').forEach((cauTL) => {
                                            if (cauTL.checked) {
                                                cauTraLoi = cauTL.value;
                                            }
                                        })
                                        ketQua.push({ cau: i + 1, question: cauHoi, dapAn: cauTraLoi });
                                    })
                                    var daXuatHienAlert = false;
                                    ketQua.forEach((item) => {
                                        if (item.dapAn == 0) {
                                            if (!daXuatHienAlert) { // Kiểm tra trước khi hiển thị hộp thoại cảnh báo
                                                alert('Bạn Chưa Trả Lời hết Câu Hỏi!');
                                                daXuatHienAlert = true; // Đánh dấu đã xuất hiện hộp thoại cảnh báo
                                            }
                                            return;
                                        }
                                    })
                                    if (!daXuatHienAlert) {
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("GET", "./ketQua.php", true);
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                var result = JSON.parse(xhr.responseText);
                                                var questions = result.questions;
                                                var answers = result.answers;
                                                var dung = 0;
                                                ketQua.forEach((traLoi, i) => {
                                                    var index = questions.indexOf(traLoi.question);
                                                    if (index !== -1 && traLoi.dapAn === answers[index]) {
                                                        dung++;
                                                    }
                                                });
                                                var diem = (dung / ketQua.length * 10).toFixed(2);
                                                var form = document.createElement('form');
                                                form.setAttribute('method', 'post');
                                                form.setAttribute('action', '../BaiKiemTra/TrangThaiKiemTra.php');

                                                // Tạo một input ẩn để chứa điểm
                                                var inputDiem = document.createElement('input');
                                                inputDiem.setAttribute('type', 'hidden');
                                                inputDiem.setAttribute('name', 'diem');
                                                inputDiem.setAttribute('value', diem);
                                                form.appendChild(inputDiem);
                                                // Gửi form đi
                                                document.body.appendChild(form);
                                                form.submit();
                                            }
                                        };
                                        xhr.send();

                                    }
                                })
                            </script>
                        </div>
                        <div class="col-3">
                            <div class="kiemTra-list d-flex flex-wrap">
                                <?php
                                for ($j = 1; $j < $i; $j++) {
                                    echo '<a href="#cau-' . $j . '">' . $j . '</a>';
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
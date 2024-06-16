<?php
include '../TrangMau/connSql.php';

$questions = array(); // Mảng lưu danh sách câu hỏi
$answers = array();   // Mảng lưu danh sách đáp án

$sql = "SELECT `CauHoi`, `DapAn` FROM `cauhoi` 
        LEFT JOIN `mon` ON `cauhoi`.`MaMon` = `mon`.`MaMon` 
        LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
        WHERE `lophp`.`MaLopHP`='232_1TH1507_KS3A_10_ngoaigio'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row["CauHoi"];
        $answers[] = $row["DapAn"];
    }
}

$conn->close();

// Trả về dữ liệu dưới dạng JSON
echo json_encode(array("questions" => $questions, "answers" => $answers));
?>
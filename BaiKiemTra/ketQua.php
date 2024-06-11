<?php
// // Include file containing database connection
// include '../TrangMau/connSql.php';

// // Initialize an array to store the answers
// $answers = array();

// // Perform SQL query to fetch answers
// $sql = "SELECT `cauhoi`.*, `mon`.`MaMon`, `lophp`.`MaLopHP`, `cauhoi`.`DapAn`
//         FROM `cauhoi` 
//             LEFT JOIN `mon` ON `cauhoi`.`MaMon` = `mon`.`MaMon` 
//             LEFT JOIN `lophp` ON `lophp`.`MaMon` = `mon`.`MaMon`
//             WHERE `lophp`.`MaLopHP`='232_1TH1507_KS3A_10_ngoaigio'";
// $result = $conn->query($sql);

// // If there are results, fetch them and store in the answers array
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $answers[] = $row["DapAn"];
//     }
// }

// // Close the database connection
// $conn->close();

// // Output the answers array as JSON
// echo json_encode($answers);
?>
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
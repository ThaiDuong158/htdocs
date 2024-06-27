<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['diem'])) {
        include '../TrangMau/connSql.php';
        $diem = $_POST['diem'];
        $mssv = $_COOKIE["user"];
        $maLopHP = '232_1TH1507_KS3A_10_ngoaigio';
        $soCau = $_POST["soCau"];
        $sql = "INSERT INTO `diemkt` (`idDiemKT`, `MaMon`, `mssv`, `diemKTra`, `thoiGian`, `soCau`) 
                VALUES 
                    (NULL, 'TH1507', '" . $mssv . "', '" . $diem . "', current_timestamp(), '" . $soCau . "');";
        $conn->query($sql);
        $conn->close();
    }
} else {
    echo "<script>alert('Phương Thức Không Hợp Lệ');</script>";
}
?>

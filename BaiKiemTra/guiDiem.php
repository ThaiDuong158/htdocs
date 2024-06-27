<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['diem'])) {
        include '../TrangMau/connSql.php';
        $mssv = $_COOKIE["user"];
        $diem = $_POST['diem'];
        $soCau = $_POST["soCau"];
        $id = $_POST['id'];
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

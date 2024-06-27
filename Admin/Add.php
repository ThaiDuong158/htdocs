<?php
include '../TrangMau/connSql.php';

if (isset($_GET["table"])) {
    $table = $_GET["table"];
    switch ($table) {
        case "khoa": {
            $mk = $conn->real_escape_string($_GET["mk"]);
            $tk = $conn->real_escape_string($_GET["tk"]);
            $sql = "INSERT INTO `" . $table . "` (`Makhoa`, `TenKhoa`, `MaVanPhongKhoa`) VALUES ('$mk', '$tk', NULL)";
            $conn->query($sql);
            include '../Admin/loadKhoa.php';
            break;
        }
            ;
        case "lophp": {
            $mm = $conn->real_escape_string($_GET["mm"]);
            $mlhp = $conn->real_escape_string($_GET["mlhp"]);
            $sl = $conn->real_escape_string($_GET["sl"]);
            $gv = $conn->real_escape_string($_GET["gv"]);
            $hk = $conn->real_escape_string($_GET["hk"]);

            $sql = "SELECT MaGV FROM `giangvien` WHERE TenGV = '" . $gv . "';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sql = "INSERT INTO `lophp` 
                                (`idLopHP`, `MaLopHP`, `SoLuongSV`, `MaMon`, `MaGV`, `phonghoc`, `MaHK`) 
                            VALUES 
                                (NULL, '" . $mlhp . "', '" . $sl . "', '" . $mm . "', '" . $row["MaGV"] . "', '0', '" . $hk . "');";

                    $conn->query($sql);
                }
            }
            include '../Admin/loadKhoa.php';
            break;
        }
            ;
    }
}

$conn->close();
?>
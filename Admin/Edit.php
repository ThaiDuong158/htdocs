<?php
include '../TrangMau/connSql.php';

if (isset($_GET["table"])) {
    $table = $_GET["table"];
    switch ($table) {
        case "khoa": {
            $mk = $conn->real_escape_string($_GET["mk"]);
            $tk = $conn->real_escape_string($_GET["tk"]);
            $mkc = $conn->real_escape_string($_GET["mkc"]);
            $sql = "UPDATE `".$table."` SET `TenKhoa` = '" . $tk . "', `Makhoa` = '" . $mk . "' WHERE `Makhoa` = '" . $mkc . "'";
            $conn->query($sql);
            include '../Admin/loadKhoa.php';
            break;
        };
    }
}

$conn->close();
?>
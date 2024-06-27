<?php
include '../TrangMau/connSql.php';

if (isset($_GET["table"])) {
    $table = $_GET["table"];
    switch ($table) {
        case "khoa": {
            $mk = $conn->real_escape_string($_GET["mk"]);
            $sql = "DELETE FROM `khoa` WHERE `khoa`.`Makhoa` = '" . $mk . "'";
            $conn->query($sql);
            include '../Admin/loadKhoa.php';
            break;
        };
    }
}
$conn->close();
?>
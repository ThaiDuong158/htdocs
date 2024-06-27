<?php
include '../TrangMau/connSql.php';

$sql = "";

if (isset($_GET["val"])) {
    $val = $conn->real_escape_string($_GET["val"]);
    $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.`TenHK`, `mon`.`TenMon`
            FROM `lophp` 
                LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
                LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK` 
                LEFT JOIN `mon` ON `lophp`.`MaMon` = `mon`.`MaMon`
            WHERE CONCAT(`lophp`.`MaLopHP`, ' (', `lophp`.`SoLuongSV`, ' sv) ', `lophp`.`MaMon`, ' - ', `mon`.`TenMon`, ' ', `giangvien`.`TenGV`) LIKE '%$val%'";
} else {
    $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.`TenHK`, `mon`.`TenMon`
            FROM `lophp` 
                LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
                LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK` 
                LEFT JOIN `mon` ON `lophp`.`MaMon` = `mon`.`MaMon`";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="div--cont__item row">
                <div class="row">
                    <a href="../LopHoc/lopHoc.php?id=' . $row["idLopHP"] . '" class="div--cont__link">
                        <h5>
                            <span>' . $row["MaLopHP"] . '</span>
                            <span>(' . $row["SoLuongSV"] . ' sv) ' . $row["MaMon"] . ' - ' . $row["TenMon"] . ' ' . $row["TenGV"] . '</span>
                        </h5>
                    </a>
                </div>
                <div class="row">
                    <p class="div--cont__HK">Mục <a href="" class="div--cont__link">' . $row["TenHK"] . '</a></p>
                </div>
            </div>
        ';
    }
} else {
}

$conn->close();
?>

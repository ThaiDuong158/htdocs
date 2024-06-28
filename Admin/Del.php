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
        }
            ;
        case "lophp": {
            $mlhp = $conn->real_escape_string($_GET["mlhp"]);
            $sql = "DELETE FROM `lophp` WHERE `lophp`.`MaLopHP` = '" . $mlhp . "'";
            $conn->query($sql);
            include '../Admin/loadLHP.php';
            break;
        }
            ;
        case "cauhoi": {
            $mkc = $conn->real_escape_string($_GET["mkc"]);
            $sql = "DELETE FROM `cauhoi` 
                WHERE `cauhoi`.`CauHoi` = '" . $mkc . "'";
            $conn->query($sql);
            include '../Admin/loadQ.php';
            break;
        }
            ;
        case "dangnhap": {
            $ht = $conn->real_escape_string($_GET["ht"]);
            $usId = $conn->real_escape_string($_GET["usId"]);
            $mail = $conn->real_escape_string($_GET["mail"]);
            $us = $conn->real_escape_string($_GET["us"]);
            $pass = $conn->real_escape_string($_GET["pass"]);
            $quyen = $conn->real_escape_string($_GET["quyen"]);
            $mkc = $conn->real_escape_string($_GET["mkc"]);

            $sql = "SELECT `tenQuyen` FROM `quyen` WHERE `idQuyen` =  '" . $quyen . "' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tenQuyen = $row["tenQuyen"];
                    $sql = "";
                    switch ($tenQuyen) {
                        case "Admin": {
                            $sql = "DELETE FROM `admin` 
                                    WHERE `admin`.`idUser` = '" . $usId . "';";
                            break;
                        }
                        case "Giảng Viên": {
                            $sql = "DELETE FROM `giangvien` 
                                    WHERE `giangvien`.`MaGV` = '" . $usId . "';";
                            break;
                        }
                        case "Sinh Viên": {
                            $sql = "DELETE FROM `sinhvien` 
                                    WHERE `sinhvien`.`MaSV` = '" . $usId . "';";
                            break;
                        }
                    }
                    $conn->query($sql);
                }
            }

            $sql = "DELETE FROM `dangnhap` 
                WHERE `dangnhap`.`idUser` = '" . $usId . "';";
            $conn->query($sql);
            include '../Admin/loadTK.php';
            break;
        }
            ;
        case "hocphi": {
            $idSv = $conn->real_escape_string($_GET["idSv"]);
            $mm = $conn->real_escape_string($_GET["mm"]);
            $sql = "DELETE FROM `hocphi` 
                    WHERE   `hocphi`.`MaSV` = '" . $idSv . "' AND
                            `hocphi`.`MaMon` = '" . $mm . "' ";
            $conn->query($sql);

            include '../Admin/loadHP.php';

            break;
        }
            ;
    }
}
$conn->close();
?>
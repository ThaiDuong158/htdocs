<?php
include '../TrangMau/connSql.php';

if (isset($_GET["table"])) {
    $table = $_GET["table"];
    switch ($table) {
        case "khoa": {
            $mk = $conn->real_escape_string($_GET["mk"]);
            $tk = $conn->real_escape_string($_GET["tk"]);
            $mkc = $conn->real_escape_string($_GET["mkc"]);
            $sql = "UPDATE `" . $table . "` SET `TenKhoa` = '" . $tk . "', `Makhoa` = '" . $mk . "' WHERE `Makhoa` = '" . $mkc . "'";
            $conn->query($sql);
            include '../Admin/loadKhoa.php';
            break;
        }
            ;
        case "lophp": {
            $mm = $conn->real_escape_string($_GET["mm"]);
            $tm = $conn->real_escape_string($_GET["tm"]);
            $mlhp = $conn->real_escape_string($_GET["mlhp"]);
            $sl = $conn->real_escape_string($_GET["sl"]);
            $gv = $conn->real_escape_string($_GET["gv"]);
            $hk = $conn->real_escape_string($_GET["hk"]);
            $mkc = $conn->real_escape_string($_GET["mkc"]);

            $sql = "SELECT * FROM `mon` WHERE `MaMon` = '$mm'";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO `mon` (`MaMon`, `TenMon`, `MaKhoa`)
                        VALUES ('$mm', '$tm', 'CTT')";
                $conn->query($sql);
            }

            $sql = "SELECT MaGV FROM `giangvien` WHERE `TenGV` = '$gv'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $input = $hk;
                    $parts = explode(", ", $input);
                    $hocKy = $parts[0];
                    $namHoc = $parts[1];
                    $sql = "SELECT MaHK FROM `hocki` 
                            WHERE `TenHK` = '" . $hocKy . "' AND
                                    `NamHoc` = '" . $namHoc . "'";
                    $result1 = $conn->query($sql);
                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $sql = "UPDATE `lophp` SET 
                                `MaLopHP` = '" . $mlhp . "', 
                                `SoLuongSV` = '" . $sl . "', 
                                `MaMon` = '" . $mm . "', 
                                `MaGV` = '" . $row["MaGV"] . "', 
                                `MaHK` = '" . $row1["MaHK"] . "'
                                WHERE `MaLopHP` = '" . $mkc . "';";
                            $conn->query($sql);
                        }
                    }
                }
            }
            include '../Admin/loadLHP.php';
            break;
        }
            ;
        case "cauhoi": {
            $mm = $conn->real_escape_string($_GET["mm"]);
            $ch = $conn->real_escape_string($_GET["ch"]);
            $da1 = $conn->real_escape_string($_GET["da1"]);
            $da2 = $conn->real_escape_string($_GET["da2"]);
            $da3 = $conn->real_escape_string($_GET["da3"]);
            $da4 = $conn->real_escape_string($_GET["da4"]);
            $da = $conn->real_escape_string($_GET["da"]);
            $md = $conn->real_escape_string($_GET["md"]);
            $mkc = $conn->real_escape_string($_GET["mkc"]);
            $sql = "UPDATE `cauhoi` SET 
                        `MaMon` = '" . $mm . "', 
                        `CauHoi` = '" . $ch . "', 
                        `CauTraLoi1` = '" . $mm . "', 
                        `CauTraLoi2` = '" . $da1 . "', 
                        `CauTraLoi3` = '" . $da2 . "',
                        `CauTraLoi4` = '" . $da3 . "', 
                        `DapAn` = '" . $da . "', 
                        `MucDo` = '" . $md . "'
                        WHERE `cauhoi`.`CauHoi` = '" . $mkc . "';";
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
                            $sql = "UPDATE `admin` SET 
                                `Mail` = '" . $mail . "' 
                            WHERE `admin`.`idUser` = '" . $mkc . "';";
                            break;
                        }
                        case "Giảng Viên": {
                            $sql = "UPDATE `giangvien` 
                            SET `Mail` = '" . $mail . "' 
                            WHERE `giangvien`.`MaGV` = '" . $mkc . "';";
                            break;
                        }
                        case "Sinh Viên": {
                            $sql = "UPDATE `sinhvien` SET 
                                `Email` = '" . $mail . "' 
                            WHERE
                                `sinhvien`.`MaSV` = '" . $mkc . "';";
                            break;
                        }
                    }
                    $conn->query($sql);
                }
            }

            $sql = "UPDATE `dangnhap` SET 
                        `tenDangNhap` = '" . $us . "',
                        `matKhau` = '" . $pass . "',
                        `idQuyen` = '" . $quyen . "',
                        `idUser`= '" . $usId . "'
                    WHERE 
                        `dangnhap`.`idUser` = '" . $mkc . "';";
            $conn->query($sql);
            include '../Admin/loadTK.php';
            break;
        }
            ;
    }
}

$conn->close();
?>
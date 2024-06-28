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
            $tm = $conn->real_escape_string($_GET["tm"]);
            $mlhp = $conn->real_escape_string($_GET["mlhp"]);
            $sl = $conn->real_escape_string($_GET["sl"]);
            $gv = $conn->real_escape_string($_GET["gv"]);
            $hk = $conn->real_escape_string($_GET["hk"]);

            $sql = "SELECT * FROM `mon` WHERE `MaMon` = '$mm'";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO `mon` (`MaMon`, `TenMon`, `MaKhoa`)
                        VALUES ('$mm', '$tm', 'CTT')";
                $conn->query($sql);
            }

            $sql = "SELECT MaGV FROM `giangvien` WHERE TenGV = '" . $gv . "';";
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
                            $sql = "INSERT INTO `lophp` 
                                        (`idLopHP`, `MaLopHP`, `SoLuongSV`, `MaMon`, `MaGV`, `phonghoc`, `MaHK`) 
                                    VALUES 
                                        (NULL, '" . $mlhp . "', '" . $sl . "', '" . $mm . "', '" . $row["MaGV"] . "', '0', '" . $row1["MaHK"] . "');";

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

            $sql = "INSERT INTO `cauhoi` 
                        (`idCauHoi`, `MaMon`, `CauHoi`, `CauTraLoi1`, `CauTraLoi2`, `CauTraLoi3`, `CauTraLoi4`, `DapAn`, `MucDo`) 
                    VALUES 
                        (NULL, '" . $mm . "', '" . $ch . "', '" . $da1 . "', '" . $da2 . "', '" . $da3 . "', '" . $da4 . "', '" . $da . "', '" . $md . "');";
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

            $sql = "SELECT `tenQuyen` FROM `quyen` WHERE `idQuyen` =  '" . $quyen . "' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tenQuyen = $row["tenQuyen"];
                    $sql = "";
                    switch ($tenQuyen) {
                        case "Admin": {
                            $sql = "INSERT INTO `admin` 
                                    (`Mail`, `SDT`, `HoTen`, `idUser`) 
                                VALUES 
                                    ('" . $mail . "', NULL, '" . $ht . "', '" . $usId . "');";
                            break;
                        }
                        case "Giảng Viên": {
                            $sql = "INSERT INTO `giangvien` 
                                    (`MaGV`, `TenGV`, `SoDienThoai`, `Mail`, `Chucvu`, `Makhoa`) 
                                VALUES 
                                    ('" . $usId . "', '" . $ht . "', NULL, '. $mail .', NULL, 'CTT');";
                            break;
                        }
                        case "Sinh Viên": {
                            $sql = "INSERT INTO `sinhvien` 
                                    (`MaSV`, `TenSV`, `NamSinh`, `CCCD_CMND`, `NamNhaphoc`, `NienKhoa`, `Email`, `MaLop`, `FileHinh`, `status`) 
                                VALUES 
                                    ('" . $usId . "', '" . $ht . "', NULL, NULL, '2021', '46', '" . $mail . "', '1CTT21A3', NULL, '');";
                            break;
                        }
                    }
                    $conn->query($sql);
                }
            }

            $sql = "INSERT INTO `dangnhap` 
                            (`idDangNhap`, `tenDangNhap`, `matKhau`, `idQuyen`, `idUser`) 
                        VALUES 
                            (NULL, '" . $us . "', '" . $pass . "', '" . $quyen . "', '" . $usId . "');";
            $conn->query($sql);
            include '../Admin/loadTK.php';
            break;
        }
            ;
        case "hocphi": {
            $idSv = $conn->real_escape_string($_GET["idSv"]);
            $mm = $conn->real_escape_string($_GET["mm"]);
            $tm = $conn->real_escape_string($_GET["tm"]);
            $st = $conn->real_escape_string($_GET["st"]);
            $tt = $conn->real_escape_string($_GET["tt"]);
            $hk = $conn->real_escape_string($_GET["hk"]);
            $msvc = $conn->real_escape_string($_GET["msvc"]);
            $mmc = $conn->real_escape_string($_GET["mmc"]);

            $input = $hk;
            $parts = explode(", ", $input);
            $hocKy = $parts[0];
            $namHoc = $parts[1];
            $sql = "SELECT `MaHK` FROM `hocki` 
                    WHERE `TenHK` = '" . $hocKy . "' AND
                            `NamHoc` = '" . $namHoc . "'
                    ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $maHK = $row["MaHK"];
                    $sql = "INSERT INTO `hocphi` (`idHocPhi `, `MaMon`, `SoTien`, `MaSV`, `TrangThai`, `MaHK`)
                            VALUES (NULL, '$mm', '$st', '$idSv', '$tt', '$maHK')";
                    $sql= "INSERT INTO `hocphi` 
                                (`idHocPhi`, `MaMon`, `SoTien`, `MaSV`, `TrangThai`, `MaHK`) 
                            VALUES 
                                (NULL, '".$mm."', '".$st."', '".$idSv."', '".$tt."', '".$row["MaHK"]."');";
                    $conn->query($sql);
                }
            }
            include '../Admin/loadHP.php';

            break;
        }
            ;
    }
}

$conn->close();
?>
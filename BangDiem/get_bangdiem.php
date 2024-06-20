<?php
include("../connect.php"); 
session_start();
if (isset($_POST['mahk'])) {
    $mahk = $_POST['mahk'];

    // Lấy mã sinh viên (Bạn cần thay thế bằng cách lấy mã sinh viên từ session hoặc database)
    $MaSV = '21004276'; 

    $sql = "SELECT m.MaMon, m.TenMon, m.SoChi,m.SoChiLT,m.SoChiTH,d.DiemCC,d.DiemGK,d.DiemCK,d.DiemTong,d.DiemChu,d.DiemHeSo 
            FROM diemkiemtra d 
            INNER JOIN Mon m ON m.MaMon = d.MaMon 
            WHERE d.MaSV='".$_SESSION['user_id']."' AND d.MaHK = '$mahk'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $MaMon = $row["MaMon"];
            $TenMon = $row["TenMon"];
            $SoChi = $row["SoChi"];
            $SoChiLT = $row["SoChiLT"];
            $SoChiTH = $row["SoChiTH"];
            $DiemCC = $row["DiemCC"];
            $DiemGK = $row["DiemGK"];
            $DiemCK = $row["DiemCK"];
            $DiemTong = $row["DiemTong"];
            $DiemChu = $row["DiemChu"];
            $DiemHeSo = $row["DiemHeSo"];

            echo "<tr>
                    <td>" . $i . "</td>
                    <td>" . $MaMon . "</td>
                    <td>" . $TenMon . "</td>
                    <td>" . $SoChi . ' (' . $SoChiLT . ' : ' . $SoChiTH . ').' . "</td>
                    <td>" . $DiemCC . "</td>
                    <td>" . $DiemGK . "</td>
                    <td>" . $DiemCK . "</td>
                    <td>" . $DiemTong . "</td>
                    <td>" . $DiemChu . "</td>
                    <td>" . $DiemHeSo . "</td>
                </tr>";

            $i++;
        }
    } else {
        echo "<tr><td colspan='10'>Không có dữ liệu cho học kỳ này</td></tr>";
    }
}

$conn->close();
?>
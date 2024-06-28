<table class="table">
    <thead>
        <tr>
            <th>Tiết</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
        </tr>
        <?php

        if (isset($_GET['maSV']) && isset($_GET['mahk'])) {
            $maSV = $_GET['maSV'];
            $mahk = $_GET['mahk'];
            // Câu truy vấn SQL với điều kiện MaH
            include("../connect.php");
            $sql = "SELECT l.MaLopHP, m.TenMon, g.TenGV, p.TenPhong ,p.MaPhong,t.Thu,t.TuanBatDau,t.TuanKetThuc,t.Tiet,T.TietBatDau
            FROM tkb t
            INNER JOIN lophp l ON t.MaLopHP = l.MaLopHP
            INNER JOIN mon m ON l.MaMon = m.MaMon
            INNER JOIN giangvien g ON l.MaGV = g.MaGV
            INNER JOIN phong p ON l.phonghoc = p.MaPhong
            WHERE t.MaSV = '$maSV' AND l.MaHK = '$mahk'";

            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Lỗi truy vấn: " . mysqli_error($conn));
            }

            $tkb = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $MaLopHP = $row['MaLopHP'];
                    $Mon = $row['TenMon'];
                    $GiangVien = $row["TenGV"];
                    $tenphong = $row["TenPhong"];
                    $MaPhong = $row["MaPhong"];
                    $thu = $row["Thu"];
                    $TBD = $row["TuanBatDau"];
                    $TKT = $row["TuanKetThuc"];
                    $Tiet = $row["Tiet"];
                    $TietBD = $row["TietBatDau"];


                    // Lưu thông tin vào mảng thời khóa biểu
                    $tkb[$MaLopHP] = array(
                        'TenMon' => $row['TenMon'],
                        'TenPhong' => $row['TenPhong'],
                        'Thu' =>  $row["Thu"],
                        'TuanBatDau' => $row["TuanBatDau"],
                        'TuanKetThuc' => $row["TuanKetThuc"],
                        'Tiet' => $row["Tiet"],
                        'TietBatDau' => $row["TietBatDau"],
                        'GiangVien' => $GiangVien
                    );
                }
            }
        }
        ?>
    </thead>
    <tbody>
        <?php
        if (isset($tkb)) {
            $thu_array = array(
                "Thứ 2" => array(),
                "Thứ 3" => array(),
                "Thứ 4" => array(),
                "Thứ 5" => array(),
                "Thứ 6" => array(),
                "Thứ 7" => array(),
                "Chủ nhật" => array()
            );
            // Sắp xếp mảng theo thu
            foreach ($tkb as $MaLopHP => $info) {
                $Mon = $info['TenMon'];
                $GiangVien = $info['GiangVien'];
                $tenphong = $info['TenPhong'];
                $thu = $info["Thu"];
                $TBD = $info["TuanBatDau"];
                $TKT = $info["TuanKetThuc"];
                $Tiet = $info["Tiet"];
                $TietBD = $info["TietBatDau"];
                $tuanhoc = range($TKT, $TBD);
                
                // Kiểm tra xem tiết đã có trong mảng hay chưa
                if (!isset($thu_array[$thu][$TietBD])) {
                    // Thêm thông tin vào mảng theo thứ
                    $thu_array[$thu][$TietBD] = array(
                        'Mon' => $Mon,
                        'TietBD' =>$TietBD,
                        'GiangVien' => $GiangVien,
                        'TenPhong' => $tenphong,
                        'TuanBatDau' => $TBD,
                        'TuanKetThuc' => $TKT,
                        'Tiet' => $Tiet,
                    );
                }
            }
            // Hiển thị thông tin lên bảng
            echo "<tr>";
            echo "<td>Tiết</td>";
            for ($i = 1; $i <= 13; $i++) {
                echo "<td>$i</td>";
            }
            echo "</tr>";
            foreach ($thu_array as $thu => $tiet_array) {
                echo "<tr>";
                echo "<td>$thu</td>";
                for ($i = 1; $i <= 13; $i++) {
                    if (isset($tiet_array[$i])) {
                        $Mon = $tiet_array[$i]['Mon'];
                        $TietBD = $tiet_array[$i]['TietBD'];
                        $GiangVien = $tiet_array[$i]['GiangVien'];
                        $TenPhong = $tiet_array[$i]['TenPhong'];
                        $TBD = $tiet_array[$i]['TuanBatDau'];
                        $TKT = $tiet_array[$i]['TuanKetThuc'];
                        $Tiet = $tiet_array[$i]['Tiet'];
                        if($i==$TietBD){
                            echo "<td colspan=".($Tiet-1).">
                            <div class='box'>
                                <p><strong>$Mon</strong></p>
                                <p>Giảng viên: $GiangVien</p>
                                <p>Phòng: $TenPhong</p>
                                <p>Tuần: $TBD - $TKT</p>
                                <p>Tiết: $TietBD - $Tiet</p>
                            </div>
                        </td>";
                        }
                        else{
                            echo"<td></td>";
                        }
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
<script>
    // Chuyển đổi giữa các tab
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            button.classList.add('active');
            document.getElementById(button.dataset.target).classList.add('active');
        });
    });
</script>
</div>
</body>

</html>

<table class="table">
    <thead>
        <tr>
            <th>Tiết</th>
            <th>Thứ 2</th>
            <th>Thứ 3</th>
            <th>Thứ 4</th>
            <th>Thứ 5</th>
            <th>Thứ 6</th>
            <th>Thứ 7</th>
            <th>Chủ Nhật</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rawData = file_get_contents("php://input");

        // Parse the data into an array
        parse_str($rawData, $postData);
    
        // Extract the MaSV and mahk values
        $maSV = $postData["maSV"];
        $mahk = $postData["mahk"];
        
        include("../connect.php");
        if  (isset($maSV) && !empty($mahk)) {
            $maSV =   $_POST['maSV'];
            $mahk = $_POST['mahk'];
            echo $maSV,$mahk;
            $tuanHoc = isset($_POST['tuanHoc']) ? $_POST['tuanHoc'] : date('W'); // Lấy tuần hiện tại
            $sql = "SELECT l.MaLopHP, m.TenMon, g.TenGV, p.TenPhong, p.MaPhong, t.Thu, t.TuanBatDau, t.TuanKetThuc, t.Tiet, T.TietBatDau
                    FROM tkb t
                    INNER JOIN lophp l ON t.MaLopHP = l.MaLopHP
                    INNER JOIN mon m ON l.MaMon = m.MaMon
                    INNER JOIN giangvien g ON m.MaGV = g.MaGV
                    INNER JOIN phong p ON l.phonghoc = p.MaPhong
                    WHERE t.MaSV = '$maSV' AND l.MaHK = '$mahk'
                    AND t.TuanBatDau <= '$tuanHoc' AND t.TuanKetThuc >= '$tuanHoc'
                    ORDER BY t.Thu, t.TietBatDau";

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

                    $tkb[$thu][$TietBD] = array(
                        'TenMon' => $row['TenMon'],
                        'MaLopHP' => $row['MaLopHP'],
                        'TenPhong' => $row['TenPhong'],
                        'TuanBatDau' => $row["TuanBatDau"],
                        'TuanKetThuc' => $row["TuanKetThuc"],
                        'SoTiet' => $row["Tiet"],
                        'GiangVien' => $GiangVien
                    );
                }

                // Tạo bảng thời khóa biểu
                $currentTiet = 1;
                $lastTiet = 1;
                for ($tiet = 1; $tiet <= 13; $tiet++) {
                    echo "<tr>";
                    echo "<td>$tiet</td>";

                    for ($thu = 1; $thu <= 7; $thu++) {
                        if (isset($tkb[$thu][$currentTiet])) {
                            $info = $tkb[$thu][$currentTiet];
                            $colspan = $info['SoTiet'];
                            $MaLopHP = $info['MaLopHP'];
                            $Mon = $info['TenMon'];
                            $GiangVien = $info['GiangVien'];
                            $tenphong = $info['TenPhong'];
                            $tuanHoc = $info['TuanBatDau'] . ' - ' . $info['TuanKetThuc'];

                            // Hiển thị thông tin môn học
                            echo "<td colspan='$colspan' style='text-align: center; vertical-align: middle;'>";
                            echo "Mã lớp HP: $MaLopHP<br>";
                            echo "Mã môn: $Mon<br>";
                            echo "Tên môn: $Mon<br>";
                            echo "Tên GV: $GiangVien<br>";
                            echo "Số phòng: $MaPhong - $tenphong<br>";
                            echo "Tuần học: $tuanHoc";
                            echo "</td>";

                            $thu += $colspan - 1;
                            $lastTiet = $currentTiet + $colspan - 1; // Cập nhật tiết học cuối cùng
                        } else {
                            echo "<td></td>";
                        }
                    }
                    $currentTiet = $lastTiet + 1; // Cập nhật tiết học hiện tại
                    echo "</tr>";
                }
                echo "</tbody>";
            } else {
                echo '</tbody>
            <tr><td colspan="14" style="text-align:center;">Không có thời khóa biểu.</td></tr>';
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
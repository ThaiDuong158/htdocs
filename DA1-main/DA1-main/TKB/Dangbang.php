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
            
            print_r($tkb);
        }   
        ?>
    </thead>
    <tbody>

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
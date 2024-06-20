<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .schedule-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .schedule-header {
            background-color: #4285f4;
            color: white;
            padding: 10px;
        }

        .schedule-content {
            padding: 10px;
        }

        .schedule-time {
            font-weight: bold;
            color: #f08000;
        }
    </style>
</head>

<body>
    <?php
    
    if (isset($_POST['maSV']) && isset($_POST['mahk'])) {
        $maSV = $_POST['maSV'];
        $mahk = $_POST['mahk'];
        // Câu truy vấn SQL với điều kiện MaH
        include("../connect.php");
        $sql = "SELECT l.MaLopHP, m.TenMon, g.TenGV, p.TenPhong ,p.MaPhong,t.Thu,t.TuanBatDau,t.TuanKetThuc,t.Tiet,T.TietBatDau
                FROM tkb t
                INNER JOIN lophp l ON t.MaLopHP = l.MaLopHP
                INNER JOIN mon m ON l.MaMon = m.MaMon
                INNER JOIN giangvien g ON m.MaGV = g.MaGV
                INNER JOIN phong p ON l.phonghoc = p.MaPhong
                WHERE t.MaSV = '$maSV' AND l.MaHK = '$mahk'"; // Thêm điều kiện MaHK ở đây

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
            $days = array(
                'Monday' => 'Thứ 2',
                'Tuesday' => 'Thứ 3',
                'Wednesday' => 'Thứ 4',
                'Thursday' => 'Thứ 5',
                'Friday' => 'Thứ 6',
                'Saturday' => 'Thứ 7',
                'Sunday' => 'Chủ nhật'
            );
            $flag=false;
            // Hiển thị thời khóa biểu
            foreach ($tkb as $MaLopHP => $info) {
                $Mon = $info['TenMon'];
                $GiangVien = $info['GiangVien'];
                $tenphong = $info['TenPhong'];
                $thu = $info["Thu"];
                $TBD = $info["TuanBatDau"];
                $TKT = $info["TuanKetThuc"];
                $Tiet = $info["Tiet"];
                $TietBD = $info["TietBatDau"];
                $tuanHoc = '';


                    echo '
                <div class="schedule-box">
                    <div class="schedule-header">
                    <i class="fas fa-calendar-alt"></i> Lịch học ' . $thu . '
                    </div>
                    <div class="schedule-content">
                    Tiết: ' . $TietBD . ' - ' . $TietBD + ($Tiet - 1) . '<br>
                    Môn: ' . $Mon . '<br>
                    Giảng viên: ' . $GiangVien . '<br>
                    Phòng: ' . $MaPhong . ' ( ' . $tenphong . ' )
                    <br>
                    Tuần học: ' . $tuanHoc . '
                    </div>
                </div>
                ';
                } 
            }
           
        } else {
            echo '
            <div class="schedule-box">
                <div class="schedule-header">
                <i class="fas fa-calendar-alt"></i> Lịch học
                </div>
                Không có thời khóa biểu.
                ';
        }
    ?>

</body>

</html>
<link rel="stylesheet" href="../css/danglich.css">
<?php

function draw_calendar($month, $year, $tkb)
{
    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật');
    $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year)) - 1;
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar .= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for ($x = 0; $x < $running_day; $x++) :
        $calendar .= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for ($list_day = 1; $list_day <= $days_in_month; $list_day++) :
        $calendar .= '<td class="calendar-day">';
        /* add in the day number */
        $calendar .= '<div class="day-number">' . $list_day . '</div>';

        /** Hiển thị thông tin tiết học **/
        $thu = $headings[$running_day]; // Lấy thứ trong tuần tương ứng với $running_day
        if (isset($tkb[$thu])) {
            foreach ($tkb[$thu] as $tietBD => $info) {
                $calendar .= '<div class="tiet-info">';
                $calendar .= '<strong>' . $info['TenMon'] . '</strong><br>';
                $calendar .= 'Mã môn: ' . $info['MaLopHP'] . '<br>';
                $calendar .= 'Tiết: ' . $info['Tiet'] . '<br>';
                $calendar .= 'Phòng: ' . $info['TenPhong'] . '<br>'; //Thêm thông tin phòng học
                $calendar .= '</div>';
            }
        }


        $calendar .= '</td>';
        if ($running_day == 6) :
            $calendar .= '</tr>';
            if (($day_counter + 1) != $days_in_month) :
                $calendar .= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++;
        $running_day++;
        $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if ($days_in_this_week < 8) :
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++) :
            $calendar .= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar .= '</tr>';

    /* end the table */
    $calendar .= '</table>';

    /* all done, return result */
    return $calendar;
}
?>

<?php
if (isset($_GET['maSV']) && isset($_GET['mahk'])) {
    $maSV = $_GET['maSV'];
    $mahk = $_GET['mahk'];

    // Câu truy vấn SQL với điều kiện MaH
    include("../connect.php");
    $sql = "SELECT l.MaLopHP, m.TenMon, g.TenGV, p.TenPhong, p.MaPhong, t.Thu, t.TuanBatDau, t.TuanKetThuc, t.Tiet, t.TietBatDau 
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

            // Lưu thông tin vào mảng thời khóa biểu, nhóm theo ngày
            if (!isset($tkb[$thu])) {
                $tkb[$thu] = array();
            }
            $tkb[$thu][$TietBD] = array(
                'MaLopHP' => $MaLopHP,
                'TenMon' => $Mon,
                'TenPhong' => $tenphong,
                'GiangVien' => $GiangVien,
                'TuanBatDau' => $TBD,
                'TuanKetThuc' => $TKT,
                'TietBatDau' => $TietBD,
                'Tiet' => $Tiet,
            );
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .calendar-row {
            height: 60px;
        }

        .calendar-day-head {
            background-color: #f0f0f0;
            text-align: center;
        }

        .calendar-day {
            border: 1px solid #ddd;
            text-align: center;
            position: relative;
        }

        .day-number {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .tiet-info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f0f0f0;
            padding: 5px 10px;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    if (isset($tkb)) {
        // Hiển thị lịch học
        echo draw_calendar(date('m'), date('Y'), $tkb);
    }
    ?>
</body>

</html>
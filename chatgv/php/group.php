<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['user_id'];

// Lấy số lượng lớp học phần mà giảng viên đang dạy
$sql = "SELECT COUNT(DISTINCT l.MaLopHP) AS SoLuongLopHP
        FROM lophp l
        WHERE l.MaGV = '{$outgoing_id}'";

$query_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query_result);
$soLuongLopHP = $row['SoLuongLopHP'];

$output = "";

if ($soLuongLopHP == 0) {
    $output .= "You haven't joined any group chat yet.";
} else {
    // Thực hiện truy vấn SQL để lấy thông tin các nhóm trò chuyện tại đây
    $sql = "SELECT l.MaLopHP, m.TenMon, l.MaHK 
            FROM lophp l
            JOIN mon m ON l.MaMon = m.MaMon
            WHERE l.MaGV = '{$outgoing_id}' 
            ORDER BY l.MaHK DESC, m.TenMon";
    $query_groups = mysqli_query($conn, $sql);
    // Truyền biến $query_groups vào file data_Group.php
    $_SESSION['query_groups'] = $query_groups;

    // Include file data_Group.php (không cần truyền tham số)
    include_once "data_Group.php";
}

echo $output;
?>

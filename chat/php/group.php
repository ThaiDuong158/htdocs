<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['user_id'];

// Fetch the course classes (groups) the student is enrolled in
$sql = "SELECT l.MaLopHP, m.TenMon, l.MaHK 
        FROM lophp l
        JOIN mon m ON l.MaMon = m.MaMon
        WHERE l.MaLopHP IN (SELECT MaLopHP FROM tkb WHERE MaSV = '{$outgoing_id}') 
        ORDER BY l.MaHK DESC, m.TenMon";

$query_groups = mysqli_query($conn, $sql);
$output = "";

if (mysqli_num_rows($query_groups) == 0) {
    $output .= "You haven't joined any group chat yet.";
} else {
    include_once "data_Group.php";
}
echo $output;
?>
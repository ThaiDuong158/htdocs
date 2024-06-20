<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']); 
    $output = "";
    echo $output;
    // Corrected SQL query:
    $sql = "SELECT g.*, s.TenSV, s.FileHinh 
            FROM group_message g
            JOIN SinhVien s ON g.outcoming_id = s.MaSV
            WHERE g.MaLopHP = '{$group_id}' 
            ORDER BY g.create_time ASC"; // Assuming create_time is your timestamp field

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outcoming_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['Message'] . '</p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="../TTCN/' . $row['FileHinh'] . '" alt="">
                                <div class="details">
                                    <span>' . $row['TenSV'] . '</span> 
                                    <p>' . $row['Message'] . '</p>
                                </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages available. Start the conversation!</div>';
    }
    echo $output;
} else {
    header("location: ../login.php"); 
    exit; // Important: Exit after redirect 
}
?>
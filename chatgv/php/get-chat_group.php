<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
    $output = "";

    $sql = "SELECT g.*, s.TenGv
            FROM group_message g
            JOIN GiangVien s ON g.outcoming_id = s.MaGV
            WHERE g.Malophp = '{$group_id}'
            ORDER BY g.create_time ASC";

    $query = mysqli_query($conn, $sql);

    // Kiểm tra lỗi truy vấn
    if (!$query) {
        echo "Lỗi truy vấn: " . mysqli_error($conn); 
        exit;
    }

    // In giá trị của $group_id và $outgoing_id để debug
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
                                <img src="../icon/basicUser.jpg" alt="">
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
    exit; 
}
?>
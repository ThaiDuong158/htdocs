<?php
// Nhận biến $query_groups từ tham số được truyền vào
$query_groups = $_SESSION['query_groups'];
while ($row = mysqli_fetch_assoc($query_groups)) {
    $group_id = $row['MaLopHP']; 
    $group_name = $row['TenMon'] . " - " . $row['MaHK']; // Assuming group name is course name + semester

    // Retrieve the last message for this group
    $sql2 = "SELECT * FROM Group_message 
             WHERE Malophp = '{$group_id}' OR outcoming_id = '{$group_id}' 
             ORDER BY id_group DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    $result = (mysqli_num_rows($query2) > 0) ? $row2['Message'] : "No messages yet";
    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

    // Assuming you'll handle message display details in chat.php
    $output .= '<a href="chat_group.php?group_id=' . $group_id . '">
                    <div class="content">
                        <div class="details">
                            <span>' . $group_name . '</span>
                            <p>' . $msg . '</p> 
                        </div>
                    </div>
                </a>';
}
?>
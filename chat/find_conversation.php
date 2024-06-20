<?php
// Kết nối cơ sở dữ liệu và các hàm chung
include 'main.php';

// Kiểm tra đăng nhập
if (!is_loggedin($pdo)) {
    exit('error');
}

// Cập nhật trạng thái người dùng thành Waiting
$stmt = $pdo->prepare('UPDATE accounts SET status = "Waiting" WHERE id = ?');
$stmt->execute([$_SESSION['account_id']]);

// Kiểm tra xem đã có cuộc trò chuyện nào được tạo trong vòng 1 phút qua hay chưa
$stmt = $pdo->prepare('
    SELECT id 
    FROM conversations 
    WHERE (account_sender_id = ? OR account_receiver_id = ?) 
    AND submit_date > DATE_SUB(NOW(), INTERVAL 1 MINUTE)
');
$stmt->execute([$_SESSION['account_id'], $_SESSION['account_id']]);
$existing_conversation = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing_conversation) {
    // Đã có cuộc trò chuyện, trả về ID cuộc trò chuyện
    exit($existing_conversation['id']);
}

// Tìm kiếm người dùng khác để tạo cuộc trò chuyện mới
if ($_SESSION['account_role'] == 'Operator') {
    // Operator tìm kiếm Guest
    $stmt = $pdo->prepare('
        SELECT id 
        FROM accounts 
        WHERE role = "Guest" 
        AND status = "Waiting" 
        AND last_seen > DATE_SUB(NOW(), INTERVAL 1 MINUTE) 
        AND id != ?
        LIMIT 1
    ');
} else {
    // Guest tìm kiếm Operator
    $stmt = $pdo->prepare('
        SELECT id 
        FROM accounts 
        WHERE role = "Operator" 
        AND status = "Waiting" 
        AND last_seen > DATE_SUB(NOW(), INTERVAL 1 MINUTE) 
        AND id != ?
        LIMIT 1
    ');
}
$stmt->execute([$_SESSION['account_id']]);
$other_user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($other_user) {
    // Tìm thấy người dùng khác, tạo cuộc trò chuyện mới
    $stmt = $pdo->prepare('
        INSERT INTO conversations (account_sender_id, account_receiver_id, submit_date) 
        VALUES (?, ?, NOW())
    ');
    $stmt->execute([$_SESSION['account_id'], $other_user['id']]);

    // Trả về ID cuộc trò chuyện mới
    echo $pdo->lastInsertId();
    exit;
}

// Không tìm thấy người dùng khác, trả về lỗi
exit('error');
?>
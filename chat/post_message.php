<?php
// Kết nối cơ sở dữ liệu và các hàm chung
include 'main.php';

// Kiểm tra đăng nhập
if (!is_loggedin($pdo)) {
    exit('error');
}

// Kiểm tra dữ liệu tin nhắn
if (!isset($_POST['conversation_id'], $_POST['msg']) || empty($_POST['msg'])) {
    exit('error');
}

$conversation_id = $_POST['conversation_id'];
$message = $_POST['msg'];

// Kiểm tra xem người dùng có quyền gửi tin nhắn trong cuộc trò chuyện này không
$stmt = $pdo->prepare('
    SELECT id 
    FROM conversations 
    WHERE id = ? 
    AND (account_sender_id = ? OR account_receiver_id = ?)
');
$stmt->execute([$conversation_id, $_SESSION['account_id'], $_SESSION['account_id']]);
$conversation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$conversation) {
    // Người dùng không có quyền gửi tin nhắn trong cuộc trò chuyện này
    exit('error');
}

// Lưu tin nhắn vào cơ sở dữ liệu
$stmt = $pdo->prepare('
    INSERT INTO messages (conversation_id, account_id, msg, submit_date) 
    VALUES (?, ?, ?, NOW())
');
$stmt->execute([$conversation_id, $_SESSION['account_id'], $message]);

// Trả về thành công
exit('success');
?>
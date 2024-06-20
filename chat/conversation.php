<?php
// Kết nối cơ sở dữ liệu và các hàm chung
include 'main.php';

// Kiểm tra đăng nhập
if (!is_loggedin($pdo)) {
    exit('error');
}

// Kiểm tra ID cuộc trò chuyện
if (!isset($_GET['id'])) {
    exit('error');
}

$conversation_id = $_GET['id'];

// Cập nhật trạng thái người dùng thành Occupied
$stmt = $pdo->prepare('UPDATE accounts SET status = "Occupied" WHERE id = ?');
$stmt->execute([$_SESSION['account_id']]);

// Lấy thông tin cuộc trò chuyện
$stmt = $pdo->prepare('
    SELECT 
        c.id AS conversation_id,
        c.submit_date AS conversation_start,
        a.full_name AS sender_name,
        a.id AS sender_id,
        a2.full_name AS receiver_name,
        a2.id AS receiver_id
    FROM conversations c
    JOIN accounts a ON a.id = c.account_sender_id
    JOIN accounts a2 ON a2.id = c.account_receiver_id
    WHERE c.id = ? AND (c.account_sender_id = ? OR c.account_receiver_id = ?)
');
$stmt->execute([$conversation_id, $_SESSION['account_id'], $_SESSION['account_id']]);
$conversation = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem người dùng có tham gia cuộc trò chuyện này không
if (!$conversation) {
    exit('error');
}

// Lấy danh sách tin nhắn
$stmt = $pdo->prepare('
    SELECT 
        m.id AS message_id,
        m.msg AS message_content,
        m.submit_date AS message_time,
        a.full_name AS sender_name,
        a.id AS sender_id
    FROM messages m
    JOIN accounts a ON a.id = m.account_id
    WHERE m.conversation_id = ?
    ORDER BY m.submit_date ASC
');
$stmt->execute([$conversation_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="chat-widget-messages">
    <p class="date">
        You're now chatting with <?= htmlspecialchars($_SESSION['account_id'] == $conversation['sender_id'] ? $conversation['receiver_name'] : $conversation['sender_name'], ENT_QUOTES) ?>!
    </p>
    <?php foreach ($messages as $message): ?>
        <div class="chat-widget-message<?= $_SESSION['account_id'] == $message['sender_id'] ? '' : ' alt' ?>" title="<?= date('H:i\p\m', strtotime($message['message_time'])) ?>">
            <?= htmlspecialchars($message['message_content'], ENT_QUOTES) ?>
        </div>
    <?php endforeach; ?>
</div>

<form action="post_message.php" method="post" class="chat-widget-input-message" autocomplete="off">
    <input type="hidden" name="conversation_id" value="<?= $conversation_id ?>">
    <input type="text" name="msg" placeholder="Message" required>
    <button type="submit">Send</button>
</form>
<?php
// Kết nối cơ sở dữ liệu và các hàm chung
include 'main.php';

// Kiểm tra đăng nhập
if (!is_loggedin($pdo)) {
    exit('error');
}

// Cập nhật trạng thái người dùng thành Idle
$stmt = $pdo->prepare('UPDATE accounts SET status = "Idle" WHERE id = ?');
$stmt->execute([$_SESSION['account_id']]);

// Lấy danh sách cuộc trò chuyện
$stmt = $pdo->prepare('
    SELECT 
        c.id AS conversation_id,
        c.submit_date AS conversation_start,
        a.full_name AS sender_name,
        a.id AS sender_id,
        a2.full_name AS receiver_name,
        a2.id AS receiver_id,
        m.msg AS last_message,
        m.submit_date AS last_message_time
    FROM conversations c
    JOIN accounts a ON a.id = c.account_sender_id
    JOIN accounts a2 ON a2.id = c.account_receiver_id
    LEFT JOIN messages m ON m.conversation_id = c.id AND m.id = (
        SELECT MAX(id) 
        FROM messages 
        WHERE conversation_id = c.id
    )
    WHERE c.account_sender_id = ? OR c.account_receiver_id = ?
');
$stmt->execute([$_SESSION['account_id'], $_SESSION['account_id']]);
$conversations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Sắp xếp danh sách cuộc trò chuyện theo thời gian tin nhắn mới nhất
usort($conversations, function ($a, $b) {
    return strtotime($b['last_message_time'] ?? $b['conversation_start']) - strtotime($a['last_message_time'] ?? $a['conversation_start']);
});
?>

<div class="chat-widget-conversations">
    <a href="#" class="chat-widget-new-conversation">+ New Chat</a>
    <?php foreach ($conversations as $conversation): ?>
        <a href="#" class="chat-widget-conversation" data-id="<?= $conversation['conversation_id'] ?>">
            <div class="icon" style="background-color: <?= color_from_string($_SESSION['account_id'] != $conversation['sender_id'] ? $conversation['sender_name'] : $conversation['receiver_name']) ?>;">
                <?= substr($_SESSION['account_id'] != $conversation['sender_id'] ? $conversation['sender_name'] : $conversation['receiver_name'], 0, 1) ?>
            </div>
            <div class="details">
                <div class="title">
                    <?= htmlspecialchars($_SESSION['account_id'] != $conversation['sender_id'] ? $conversation['sender_name'] : $conversation['receiver_name'], ENT_QUOTES) ?>
                </div>
                <div class="msg">
                    <?= htmlspecialchars($conversation['last_message'] ?? 'New conversation', ENT_QUOTES) ?>
                </div>
            </div>
            <div class="date">
                <?php if ($conversation['last_message_time']): ?>
                    <?= date('Y/m/d') == date('Y/m/d', strtotime($conversation['last_message_time'])) ? date('H:i', strtotime($conversation['last_message_time'])) : date('d/m/y', strtotime($conversation['last_message_time'])) ?>
                <?php else: ?>
                    <?= date('Y/m/d') == date('Y/m/d', strtotime($conversation['conversation_start'])) ? date('H:i', strtotime($conversation['conversation_start'])) : date('d/m/y', strtotime($conversation['conversation_start'])) ?>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>
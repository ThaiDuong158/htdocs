<?php
    // Kết nối database
    require_once 'chat.php';

    // Kiểm tra phương thức yêu cầu
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lưu tin nhắn mới
        if (isset($_POST['message'])) {
            $message = $_POST['message'];
            $timestamp = date('Y-m-d H:i:s');
            $sql = "INSERT INTO messages (message, timestamp) VALUES ('$message', '$timestamp')";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("success" => true, "message" => "Message sent successfully"));
            } else {
                echo json_encode(array("success" => false, "message" => "Error sending message: " . $conn->error));
            }
        }

        // Lấy tin nhắn mới nhất
        if (isset($_POST['last_id'])) {
            $last_id = $_POST['last_id'];
            $sql = "SELECT * FROM messages WHERE id > $last_id ORDER BY id ASC";
            $result = $conn->query($sql);
            $messages = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $messages[] = $row;
                }
                echo json_encode($messages);
            } else {
                echo json_encode(array());
            }
        }

        // Lấy tin nhắn cũ hơn
        if (isset($_POST['older_id'])) {
            $older_id = $_POST['older_id'];
            $sql = "SELECT * FROM messages WHERE id < $older_id ORDER BY id DESC LIMIT 10";
            $result = $conn->query($sql);
            $messages = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $messages[] = $row;
                }
                echo json_encode($messages);
            } else {
                echo json_encode(array());
            }
        }
    }
?>
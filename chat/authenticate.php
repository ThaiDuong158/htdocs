<?php
// Kết nối cơ sở dữ liệu và các hàm chung
include 'main.php';

// Kiểm tra dữ liệu từ form
if (isset($_POST['email'], $_POST['name'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Invalid email address!');
    }

    // Kiểm tra xem người dùng đã tồn tại hay chưa
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ?');
    $stmt->execute([$email]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($account) {
        // Người dùng đã tồn tại
        if (isset($_POST['password']) && $account['role'] === 'Operator') {
            // Kiểm tra mật khẩu cho Operator
            if (password_verify($_POST['password'], $account['password'])) {
                // Mật khẩu chính xác
                $_SESSION['account_loggedin'] = TRUE;
                $_SESSION['account_id'] = $account['id'];
                $_SESSION['account_role'] = $account['role'];
                update_secret($pdo, $account['id'], $account['email'], $account['secret']);
                exit('success');
            } else {
                exit('Invalid password!');
            }
        } elseif ($account['role'] === 'Operator') {
            // Yêu cầu nhập mật khẩu cho Operator
            exit('operator');
        } else {
            // Đăng nhập thành công cho Guest
            $_SESSION['account_loggedin'] = TRUE;
            $_SESSION['account_id'] = $account['id'];
            $_SESSION['account_role'] = $account['role'];
            update_secret($pdo, $account['id'], $account['email'], $account['secret']);
            exit('success');
        }
    } else {
        // Người dùng chưa tồn tại, tạo tài khoản mới
        $stmt = $pdo->prepare('INSERT INTO accounts (email, full_name, role, last_seen) VALUES (?, ?, "Guest", NOW())');
        $stmt->execute([$email, $name]);
        $id = $pdo->lastInsertId();

        // Đăng nhập thành công cho tài khoản mới
        $_SESSION['account_loggedin'] = TRUE;
        $_SESSION['account_id'] = $id;
        $_SESSION['account_role'] = 'Guest';
        update_secret($pdo, $id, $email);
        exit('success');
    }
} else {
    exit('Please enter your name and email!');
}
?>
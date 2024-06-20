<?php

// Database connection details
$server = "localhost";
$username = "root";
$password = "";
$dbname = "doan1";

// Connect to the database
try {
  $pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
  // Handle database connection errors
  echo "Database connection failed: " . $e->getMessage();
  exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve login data
  $username = $_POST['user'];
  $password = $_POST['pass'];

  // Prepare and execute the SQL query
  $stmt = $pdo->prepare("SELECT * FROM `dangnhap` WHERE `tenDangNhap` = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  // Fetch user data
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if user exists and password matches
  if ($user) {
    if ($password === $user['matKhau']) {
      // Successful login
      session_start(); // Start a new session
      $_SESSION['user_id'] = $user['idUser']; // Store user ID in the session
      header("Location: ../TrangMau/index.php"); // Redirect to the index page
      exit;
    } else {
      // Incorrect password
      echo "<div class='alert alert-danger'>Tên đăng nhập hoặc mật khẩu không chính xác!</div>";
      echo  "<button class ='btn btn-primary' onclick='history.back()'>Go Back</button>";
    }
  } else {
    // User not found
    echo "<div class='alert alert-danger'>không tìm thấy tài khoản!</div>";
    echo  "<button class ='btn btn-primary' onclick='history.back()'>Go Back</button>";
  }
}

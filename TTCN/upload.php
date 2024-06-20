<?php
include("../connect.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
  $MaSV = $_POST["MaSV"]; // Nhận MaSV từ form
  $hinh = $_FILES["image"]["name"];
  $target_dir = "uploads/"; // Thư mục lưu ảnh
  $target_file = $target_dir . basename($hinh);

  // Kiểm tra và upload file
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // Cập nhật đường dẫn ảnh vào database
    $sql = "UPDATE `SinhVien` SET `FileHinh` = ? WHERE `MaSV` = $MaSV"; // Sửa lỗi ở đây
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $target_file); // Sửa lỗi ở đây

    if ($stmt->execute()) {
      echo "Upload và cập nhật ảnh thành công.";
    } else {
      echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
  } else {
    echo "Lỗi upload ảnh.";
  }
} else {
  echo "Không nhận được dữ liệu ảnh.";
}

$conn->close(); 
?>
<?php
session_start();

// File: save_data.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST["maSV"];
    $mahk = $_POST["mahk"];

    // Lưu trữ thông tin vào session
    $_SESSION["maSV"] = $maSV;
    $_SESSION["mahk"] = $mahk;

    // Trả về phản hồi thành công
    echo json_encode(array("status" => "success"));
} else {
    // Trả về phản hồi lỗi
    echo json_encode(array("status" => "error"));
}

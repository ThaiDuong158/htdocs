<?php
session_start(); // Khởi tạo session

if (isset($_SESSION["maSV"]) && isset($_SESSION["mahk"])) {
    // Lấy thông tin từ session
    $maSV = $_SESSION["maSV"];
    $mahk = $_SESSION["mahk"];

    // Trả về thông tin dưới dạng JSON
    echo json_encode(array("maSV" => $maSV, "mahk" => $mahk));
} else {
    // Trả về phản hồi lỗi
    echo json_encode(array("status" => "error"));
}
?>
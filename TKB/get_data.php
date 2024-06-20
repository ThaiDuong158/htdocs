<?php
if (isset($_COOKIE["user"])) {
    // Lấy thông tin từ session
    $maSV = $_COOKIE["maSV"];
    $mahk = "HK12023";

    // Trả về thông tin dưới dạng JSON
    echo json_encode(array("maSV" => $maSV, "mahk" => $mahk));
} else {
    // Trả về phản hồi lỗi
    echo json_encode(array("status" => "error"));
}

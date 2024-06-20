<?php
$conn = mysqli_connect("localhost", "root", "", "doan1");
// Kiểm tra kết nối
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($conn,$_POST["query"]);
    $sql = "
        SELECT MaSV, TenSV FROM sinhvien 
        WHERE MaSV LIKE '%".$search."%' 
        OR TenSV LIKE '%".$search."%'
    ";
    $result = mysqli_query($conn, $sql);

    $output = '';
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $output .= '
                <button class="search-button student-item" data-masv="'.$row["MaSV"].'">
                    '.$row["MaSV"].' - '.$row["TenSV"].'
                </button>
            ';
        }
    } else {
        $output .= '<button class="search-button">Không tìm thấy kết quả</button>';
    }
    echo $output;
}
?>
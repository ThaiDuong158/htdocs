<?php
include("../css/head.php");
session_start();
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {

?>
<link rel="stylesheet" href="../css/bangdiem.css">

<body>
    <div class="main container-fluid">
        <?php
        include("../TrangMau/header.php");
        ?>
        <div class="row">
            <?php
            include("../TrangMau/sidebar.php");
            ?>
            <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid">
                    <div class="">
                        <div class="container">
                            <h3>Bảng điểm sinh viên</h3>
                            <div class="semester-container">
                                <select class="semester-select">
                                    <?php
                                    include("../connect.php");

                                    $sql = "SELECT * FROM `hocki`";
                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        die("Lỗi truy vấn: " . mysqli_error($conn));
                                    }

                                    // Kiểm tra xem có dữ liệu hay không
                                    if (mysqli_num_rows($result) > 0) {
                                        echo "<option value=''>-- Chọn học kỳ --</option>"; // Thêm dòng chọn mặc định

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $mahk = $row["MaHK"];
                                            $TenHk = $row["TenHK"];
                                            $Nam = $row["NamHoc"];

                                            // Tạo option cho dropdown
                                            echo "<option value='$mahk'>$mahk - $TenHk - $Nam</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Không có dữ liệu học kỳ</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <table class="table table-striped table-hover" id="bangdiem-table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>Mã môn học</td>
                                        <td>Tên Môn học</td>
                                        <td>Số TC</td>
                                        <td>Điểm Quá trình</td>
                                        <td>Điểm Giữa Kì</td>
                                        <td>Điểm Cuối Kì</td>
                                        <td>Điểm Thi</td>
                                        <td>Điểm Học Phần</td>
                                        <td>Điểm Chữ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dữ liệu bảng điểm sẽ được tải ở đây -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                include("../TrangMau/footer.php");
                ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.sidebar-mini').click();

            // Bắt sự kiện khi chọn học kỳ
            const semesterSelect = document.querySelector('.semester-select');
            semesterSelect.addEventListener('change', function() {
                const selectedSemester = this.value;
                // Gửi yêu cầu AJAX đến server để lấy dữ liệu bảng điểm theo học kỳ
                fetch('get_bangdiem.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'mahk=' + selectedSemester
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Cập nhật dữ liệu bảng điểm vào bảng
                        document.getElementById('bangdiem-table').getElementsByTagName('tbody')[0].innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Lỗi khi tải bảng điểm:', error);
                    });
            });
        });
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/main.js"></script>

</html>
<?php
}
else
header("location:../login/dangnhap.php")

?>
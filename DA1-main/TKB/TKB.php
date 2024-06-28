<?php
session_start();
include("../css/head.php");
?>
<link rel="stylesheet" href="../css/tkb.css">

<body>
    <div class="main container-fluid">
        <?php
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"])
            include("../TrangMau/header.php");
        else include("../TrangMau/header_login.php");
        ?>
        <div class="row">
            <?php
            include("../TrangMau/sidebar.php");
            ?>
            <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid">
                    <div class="">
                        <div class="container">
                            <h3>Thời khóa biểu của sinh viên</h3>

                            <div class="search-container">
                                <input type="text" id="search-box" class="search-box" placeholder="Mã SV / Họ tên. Ví dụ: 14001001, nguyenvăn, Nguyễn Văn, ...">

                                <div class="semester-container">
                                    <select class="semester-select" id="semesterSelect">
                                        <option value="">-- Chọn học kỳ --</option>
                                        <?php
                                        include("../connect.php");

                                        $sql = "SELECT * FROM `hocki`";
                                        $result = mysqli_query($conn, $sql);

                                        if (!$result) {
                                            die("Lỗi truy vấn: " . mysqli_error($conn));
                                        }

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $mahk = $row["MaHK"];
                                            $TenHk = $row["TenHK"];
                                            $Nam = $row["NamHoc"];
                                            echo "<option value='$mahk'>$mahk - $TenHk - $Nam</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div id="studentDropDown" class="btn" style="position: absolute;width: 75%;"></div>
                            <div class="semester-container">
                                <select id="displayTypeSelect" class="semester-select">
                                    <option value="TheoNgay">Theo ngày</option>
                                    <option value="DangBang">Dạng bảng</option>
                                    <option value="DangDS">Dạng danh sách</option>
                                    <option value="danglich">Dạng lịch</option>
                                </select>
                            </div>
                            <div id="tkbContent" style="display: none;">
                                <div class="row container-fluid">
                                    <div class="tab-content" id="TheoNgay">
                                        <p>Nội dung cho tab Theo ngày</p>
                                    </div>
                                    <div class="tab-content " id="DangBang">
                                        <p>Nội dung cho tab Dạng bảng</p>
                                    </div>
                                    <div class="tab-content active" id="DangDS">
                                        <p>Nội dung cho tab Dạng danh sách</p>
                                    </div>
                                    <div class="tab-content" id="danglich">
                                        <p>Nội dung cho tab Dạng lịch</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                include("../TrangMau/footer.php");
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.sidebar-mini').click();
        });

        const searchBox = document.getElementById('search-box');
        const studentDropDown = document.getElementById('studentDropDown');
        const tkbContent = document.getElementById('tkbContent');
        const semesterSelect = document.getElementById('semesterSelect');
        const displayTypeSelect = document.getElementById('displayTypeSelect');
        function loadTKB(maSV) {
            const selectedSemester = semesterSelect.value;
            const selectedDisplayType = displayTypeSelect.value;
            loadTabContent(selectedDisplayType, maSV, selectedSemester);
        }

        searchBox.addEventListener('keyup', function() {
            const query = this.value;
            if (query.length > 0) {
                fetch('xuly.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `query=${query}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        studentDropDown.innerHTML = data;
                        studentDropDown.style.display = 'block';
                    });
            } else {
                studentDropDown.style.display = 'none';
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('student-item')) {
                const maSV = event.target.dataset.masv;
                searchBox.value = maSV;
                studentDropDown.style.display = 'none';

                loadTKB(maSV);
            }
        });
        semesterSelect.addEventListener('change', function() {
            const maSV = searchBox.value;
            const selectedSemester = this.value;

            // Lưu thông tin maSV và mahk vào session hoặc database
            fetch('save_data.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `maSV=${maSV}&mahk=${selectedSemester}`
                })
                .then(response => {
                    if (response.ok) {
                        console.log("Gửi dữ liệu thành công!");
                        console.log(maSV);

                        loadTKB(maSV); // Gọi loadTKB sau khi lưu thành công
                    } else {
                        console.error("Gửi dữ liệu thất bại!");
                    }
                })
                .catch(error => {
                    console.error("Lỗi xảy ra:", error);
                });
        });

        displayTypeSelect.addEventListener('change', function() {
            const selectedDisplayType = this.value;

            loadTabContent(selectedDisplayType);
        });

        function loadTabContent(tabTarget, maSV = '', selectedSemester = '') {
            const targetTabContent = document.getElementById(tabTarget);

            // Kiểm tra xem targetTabContent có tồn tại không
            if (targetTabContent) {
                let url = '';

                // Lấy maSV và mahk từ session hoặc database
                fetch('get_data.php')
                    .then(response => response.json())
                    .then(data => {
                        const maSV = data.maSV;
                        const mahk = data.mahk;

                        switch (tabTarget) {
                            case 'TheoNgay':
                                url = `thoikhoabieu.php?maSV=${maSV}&mahk=${mahk}`;
                                break;
                            case 'DangBang':
                                url = `Dangbang.php?maSV=${maSV}&mahk=${mahk}`;
                                break;
                            case 'DangDS':
                                url = `dangds.php?maSV=${maSV}&mahk=${mahk}`;
                                break;
                            case 'danglich':
                                url = `danglich.php?maSV=${maSV}&mahk=${mahk}`;
                                break;
                            default:
                                return;
                        }

                        targetTabContent.innerHTML = 'Loading...';

                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                targetTabContent.innerHTML = data;
                                tkbContent.style.display = 'block';
                            });
                    });
            } else {
                console.error("Lỗi: Không tìm thấy tab content với ID:", tabTarget);
            }

            // Xử lý chuyển đổi tab
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tabContent => {
                if (tabContent.id === tabTarget) {
                    tabContent.classList.add('active');
                } else {
                    tabContent.classList.remove('active');
                }
            });
        }
    </script>
</body>

</html>
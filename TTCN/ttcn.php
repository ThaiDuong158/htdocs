<?php
session_start();
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {

    include ("../css/head.php");
    include ("../connect.php");

    $Masv = $_SESSION["user_id"];

    $sql = "SELECT * FROM SINHVIEN WHERE MaSV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    ?>

    <body>
        <div class="main container-fluid">
            <?php include ("../TrangMau/header.php"); ?>

            <div class="row">
                <?php include ("../TrangMau/sidebar.php"); ?>

                <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                    <div class="content row container-fluid">
                        <div class="">
                            <div class="container-lg-fluid ">
                                <h2 class="title p-2">Thông tin sinh viên</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card" width="30%">
                                            <div class="card-header">
                                                <h3 class="card-title"><i class="fa fa-id-card"></i>Thông tin cá nhân</h3>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped" width="75%">
                                                    <tbody>
                                                        <?php
                                                        include ("../connect.php");
                                                        $sql = "SELECT * FROM SINHVIEN WHERE MaSV ='" . $Masv . "'";
                                                        $result = mysqli_query($conn, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $MaSV = $row['MaSV'];
                                                                $hoten = $row['TenSV'];
                                                                $NamSinh = $row['NamSinh'];
                                                                $CCCD = $row['CCCD_CMND'];
                                                                $Nam = $row['NamNhaphoc'];
                                                                $NienKhoa = $row['NienKhoa'];
                                                                $Email = $row['Email'];
                                                                echo "<tr>
                                                                        <td width='30%'>Mã sinh viên</td>
                                                                       <td><span class='text-bold'>" . $MaSV . "</span></td>
                                                                 </tr>";
                                                                echo "<tr>
                                                                        <td width='30%'>Tên sinh viên</td>
                                                                       <td><span class='text-bold'>" . $hoten . "</span></td>
                                                                 </tr>";
                                                                echo "<tr>
                                                                        <td width='30%'>Năm Sinh</td>
                                                                       <td><span class='text-bold'>" . $NamSinh . "</span></td>
                                                                 </tr>";
                                                                echo "<tr>
                                                                        <td width='30%'>CCCD/CMND</td>
                                                                       <td><span class='text-bold'>" . $CCCD . "</span></td>
                                                                 </tr>";
                                                                echo "<tr>
                                                                        <td width='30%'>Năm nhập học</td>
                                                                       <td><span class='text-bold'>" . $Nam . "</span></td>
                                                                 </tr>";
                                                                echo "<tr>
                                                                        <td width='30%'>khóa</td>
                                                                       <td><span class='text-bold'>" . $NienKhoa . "</span></td>
                                                                 </tr>";
                                                                echo "<tr>
                                                                        <td width='30%'>Email</td>
                                                                       <td><span class='text-bold'>" . $Email . "</span></td>
                                                                 </tr>";
                                                            }
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h3><i class="fa fa-user"></i> Ảnh sinh viên</h3>
                                            </div>
                                            <div class="card-body">
                                                <form action="upload.php" method="post" enctype="multipart/form-data"
                                                    id="upload-form" style="text-align: center;">
                                                    <div class="box">
                                                        <?php
                                                        $sql = "SELECT FileHinh FROM SinhVien WHERE MaSV = '" . $Masv . "'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $Filehinh = ""; // Khởi tạo biến $Filehinh
                                                    
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result); // Lấy một dòng dữ liệu
                                                            $Filehinh = $row["FileHinh"];
                                                            if ($Filehinh == NULL) {
                                                                $Filehinh = "../icon/basicUser.jpg";
                                                            }
                                                        }
                                                        ?>
                                                        <img src="<?php echo $Filehinh; ?>" alt="ảnh sinh viên"
                                                            id="student-image">
                                                    </div>
                                                    <input type="hidden" name="MaSV" value="<?php echo $MaSV; ?>">
                                                    <input type="file" style="display: none;" id="image-upload"
                                                        name="image">
                                                    <button type="button" class="btn btn-primary" id="upload-btn">Chọn
                                                        ảnh</button>
                                                    <button type="submit" class="btn btn-primary" name="guithongtin">Lưu
                                                        ảnh</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-md-10">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i class="fa fa-tags"> </i>Lớp Ngành Học
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-md-10">
                                                        <div class="box box-info box-solid">
                                                        </div>
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <?php
                                                                $sql = "SELECT 
                                                        L.MaLop,
                                                        L.TenLop,
                                                        K.TenKhoa,
                                                        -- N.TenChuyenNganh AS TenNganh, 
                                                        G1.TenGV AS TenGV_GVQL, 
                                                        G1.Mail AS Mail_GVQL,
                                                        G2.TenGV AS TenGV_CVHT, 
                                                        G2.Mail AS Mail_CVHT
                                                    FROM 
                                                        SinhVien SV
                                                    JOIN 
                                                        Lop L ON SV.MaLop = L.MaLop
                                                    JOIN 
                                                        Khoa K ON L.MaKhoa = K.MaKhoa
                                                    -- JOIN
                                                    --     Nganh N ON SV.MaChuyenNganh = N.MaChuyenNganh 
                                                    LEFT JOIN
                                                        GiangVien G1 ON L.GVQL = G1.MaGV
                                                    LEFT JOIN
                                                        GiangVien G2 ON L.CVHT = G2.MaGV
                                                    WHERE 
                                                        SV.MaSV = '21004276'";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    $row = $result->fetch_assoc();
                                                                    $malop = $row["MaLop"];
                                                                    $tenlop = $row["TenLop"];
                                                                    $tenkhoa = $row["TenKhoa"];
                                                                    // $TenNganh = $row["TenNganh"];
                                                                    $TenGV_GVQL = $row["TenGV_GVQL"];
                                                                    $Mail_GVQL = $row["Mail_GVQL"];
                                                                    $TenGV_CVHT = $row["TenGV_CVHT"];
                                                                    $Mail_CVHT = $row["Mail_CVHT"];

                                                                    echo "<tr>
                                                            <td width='30%'>Mã Lớp</td>
                                                           <td><span class='text-bold'>" . $malop . "</span></td>
                                                     </tr>";
                                                                    echo "<tr>
                                                            <td width='30%'>Tên lớp</td>
                                                           <td><span class='text-bold'>" . $tenlop . "</span></td>
                                                     </tr>";
                                                                    echo "<tr>
                                                            <td width='30%'>Tên khoa</td>
                                                           <td><span class='text-bold'>" . $tenkhoa . "</span></td>
                                                     </tr>";
                                                                    //             echo "<tr>
                                                                    //         <td width='30%'>Tên chuyên ngành</td>
                                                                    //        <td><span class='text-bold'>" . $TenNganh . "</span></td>
                                                                    //  </tr>";
                                                                    echo "<tr>
                                                            <td width='30%'>Tên Giáo viên quản lý </td>
                                                           <td><span class='text-bold'>" . $TenGV_GVQL . "</span></td>
                                                     </tr>";
                                                                    echo "<tr>
                                                            <td width='30%'>Email Giáo viên quản lý</td>
                                                           <td><span class='text-bold'>" . $Mail_GVQL . "</span></td>
                                                     </tr>";
                                                                    echo "<tr>
                                                            <td width='30%'>Cố vấn học tập</td>
                                                           <td><span class='text-bold'>" . $TenGV_CVHT . "</span></td>
                                                     </tr>";
                                                                    echo "<tr>
                                                            <td width='30%'>Email cố vấn học tập</td>
                                                           <td><span class='text-bold'>" . $Mail_CVHT . "</span></td>
                                                     </tr>";
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    include ("../TrangMau/footer.php");
                    ?>
                </div>
            </div>
        </div>
        <?php include '../TrangMau/hideSidebar.php'; ?>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        const uploadForm = document.getElementById('upload-form');
        const uploadBtn = document.getElementById('upload-btn');
        const imageUpload = document.getElementById('image-upload');
        const studentImage = document.getElementById('student-image');

        uploadBtn.addEventListener('click', () => {
            imageUpload.click();
        });

        imageUpload.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = (e) => {
                studentImage.src = e.target.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        });

        uploadForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(uploadForm);

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    return response.text();
                })
                .then(data => {
                    console.log('Upload thành công:', data);
                    // Thêm xử lý sau khi upload thành công (ví dụ: hiển thị thông báo, làm mới trang...)
                })
                .catch(error => {
                    console.error('Lỗi upload:', error);
                });
        });
    </script>

    </html>
    <?php
} else
    header("location:../DangNhap/dangnhap.php")

        ?>
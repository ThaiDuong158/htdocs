<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ và Tên</th>
            <th>Mã Người dùng</th>
            <th>Gmail</th>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Quyền</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $sql = "SELECT `admin`.*, `dangnhap`.*, `quyen`.`tenQuyen`
                FROM `admin`, `dangnhap` 
                    LEFT JOIN `quyen` ON `dangnhap`.`idQuyen` = `quyen`.`idQuyen`
                    WHERE `admin`.`idUser` = `dangnhap`.`idUser`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                    <tr class="no-select">
                    <td>' . $i . '</td>
                    <td>' . $row["HoTen"] . '</td>
                    <td>' . $row["idUser"] . '</td>
                    <td>' . $row["Mail"] . '</td>
                    <td>' . $row["tenDangNhap"] . '</td>
                    <td>' . $row["matKhau"] . '</td>
                    <td>' . $row["tenQuyen"] . '</td>
                    </tr>
                ';
                $i++;
            }
        }

        $sql = "SELECT `giangvien`.*, `dangnhap`.*, `quyen`.`tenQuyen`
                        FROM `giangvien`, `dangnhap` 
                          LEFT JOIN `quyen` ON `dangnhap`.`idQuyen` = `quyen`.`idQuyen`
                          WHERE `giangvien`.`MaGV` = `dangnhap`.`idUser`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                    <tr class="no-select">
                    <td>' . $i . '</td>
                    <td>' . $row["TenGV"] . '</td>
                    <td>' . $row["MaGV"] . '</td>
                    <td>' . $row["Mail"] . '</td>
                    <td>' . $row["tenDangNhap"] . '</td>
                    <td>' . $row["matKhau"] . '</td>
                    <td>' . $row["tenQuyen"] . '</td>
                    </tr>
                ';
                $i++;
            }
        }

        $sql = "SELECT `sinhvien`.*,  `dangnhap`.*, `quyen`.`tenQuyen`
                        FROM `sinhvien`, `dangnhap` 
                          LEFT JOIN `quyen` ON `dangnhap`.`idQuyen` = `quyen`.`idQuyen`
                            WHERE `sinhvien`.`MaSV` = `dangnhap`.`idUser`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                    <tr class="no-select">
                    <td>' . $i . '</td>
                    <td>' . $row["TenSV"] . '</td>
                    <td>' . $row["idUser"] . '</td>
                    <td>' . $row["Email"] . '</td>
                    <td>' . $row["tenDangNhap"] . '</td>
                    <td>' . $row["matKhau"] . '</td>
                    <td>' . $row["tenQuyen"] . '</td>
                    </tr>
                    ';
                $i++;
            }
        }
        ?>
    </tbody>
</table>
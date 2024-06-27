<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Mã môn</th>
            <th>Tên môn</th>
            <th>Số tiền</th>
            <th>Trạng thái</th>
            <th>Học kỳ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $sql = "SELECT `hocphi`.*, `mon`.`TenMon`, `hocki`.*
        FROM `hocphi` 
            LEFT JOIN `mon` ON `hocphi`.`MaMon` = `mon`.`MaMon` 
            LEFT JOIN `hocki` ON `hocphi`.`MaHK` = `hocki`.`MaHK`;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                      <tr class="no-select">
                        <td>' . $i . '</td>
                        <td>' . $row["MaSV"] . '</td>
                        <td>' . $row["MaMon"] . '</td>
                        <td>' . $row["TenMon"] . '</td>
                        <td>' . $row["SoTien"] . '</td>
                        <td>' . $row["TrangThai"] . '</td>
                        <td>' . $row["TenHK"] . ', ' . $row["NamHoc"] . '</td>
                      </tr>
                    ';
                $i++;
            }
        }
        ?>
    </tbody>
</table>
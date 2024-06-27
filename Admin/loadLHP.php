<table class="table table-hover">
  <thead>
    <tr>
      <th>STT</th>
      <th>Mã môn</th>
      <th>Mã lớp học phần</th>
      <th>Số lượng</th>
      <th>Giảng viên</th>
      <th>Học kỳ</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.*
            FROM `lophp` 
              LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
              LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK`;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
          <tr class="no-select">
            <td>' . $i . '</td>
            <td>' . $row["MaMon"] . '</td>
            <td>' . $row["MaLopHP"] . '</td>
            <td>' . $row["SoLuongSV"] . '</td>
            <td>' . $row["TenGV"] . '</td>
            <td>' . $row["TenHK"] . ', ' . $row["NamHoc"] . '</td>
          </tr>
        ';
        $i++;
      }
    }
    ?>
  </tbody>
</table>
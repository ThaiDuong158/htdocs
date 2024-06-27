<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã môn</th>
            <th>Câu hỏi</th>
            <th>Đáp án 1</th>
            <th>Đáp án 2</th>
            <th>Đáp án 3</th>
            <th>Đáp án 4</th>
            <th>Đáp án</th>
            <th>Mức độ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $sql = "SELECT * FROM `cauhoi`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                      <tr class="no-select">
                        <td>' . $i . '</td>
                        <td>' . $row["MaMon"] . '</td>
                        <td>' . $row["CauHoi"] . '</td>
                        <td>' . $row["CauTraLoi1"] . '</td>
                        <td>' . $row["CauTraLoi2"] . '</td>
                        <td>' . $row["CauTraLoi3"] . '</td>
                        <td>' . $row["CauTraLoi4"] . '</td>
                        <td>' . $row["DapAn"] . '</td>
                        <td>' . $row["MucDo"] . '</td>
                      </tr>
                    ';
                $i++;
            }
        }
        ?>
    </tbody>
</table>
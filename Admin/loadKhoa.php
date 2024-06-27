<?php
$sql = "SELECT * FROM `khoa`";
$result = $conn->query($sql);
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã khoa</th>
            <th>Tên Khoa</th>
        </tr>
    </thead>
    <tbody>'
        <?php if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                echo '
                    <tr class="no-select">
                    <td>' . $i . '</td>
                    <td>' . $row["Makhoa"] . '</td>
                    <td>' . $row["TenKhoa"] . '</td>
                    </tr>';
                $i++;
            }
        }
        ?>

    </tbody>
</table>
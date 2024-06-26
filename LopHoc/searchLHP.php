<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/searchLHP.css">
    <title>Document</title>
</head>

<body>
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid d-flex flex-column">
                    <div class="div--search">
                        <input type="text" name="" id="">
                        <button class="btn btn-success btn--search">Tìm kiếm</button>
                    </div>
                    <div class="div--cont">
                        <div class="div--result__count row">
                            <h3>Kết quả tìm kiếm: 0</h3>
                        </div>
                        <?php
                        include '../TrangMau/connSql.php';
                        $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.`TenHK`,`mon`.`TenMon`
                                FROM `lophp` 
                                    LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
                                    LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK` 
                                    LEFT JOIN `mon` ON `lophp`.`MaMon` = `mon`.`MaMon`;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo'
                                    <div class="div--cont__item row">
                                        <div class="row">
                                            <a href="../LopHoc/lopHoc.php?id='.$row["idLopHP"].'" class="div--cont__link">
                                                <h5>
                                                    <span>
                                                        '.$row["MaLopHP"].'
                                                    </span>
                                                    <span>
                                                        ('.$row["SoLuongSV"].' sv) '.$row["MaMon"].' - '.$row["TenMon"].' '.$row["TenGV"].'
                                                    </span>
                                                </h5>
                                            </a>
                                        </div>
                                        <div class="row">
                                            <p class="div--cont__HK">Mục <a href="" class="div--cont__link">'.$row["TenHK"].'</a></p>
                                        </div>
                                    </div>
                                ';
                            }
                            echo'
                                <script>
                                    var num =document.querySelectorAll(".div--cont__item").length
                                    document.querySelector(".div--result__count").innerHTML = `<h3>Kết quả tìm kiếm: ${num}</h3>`;
                                </script>
                            ';
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <?php include '../TrangMau/hideSidebar.php' ?>
</body>
<script src="../js/main.js"></script>

</html>
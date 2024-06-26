<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/NopBai.css">
    <title>Document</title>
</head>

<body>
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col bg-light d-flex flex-column justify-content-between">
                <?php
                include '../TrangMau/connSql.php';
                $id = isset($_GET["id"]) ? $_GET["id"] : '';
                $sql = "SELECT `lophp`.*, `giangvien`.`TenGV`, `hocki`.`TenHK`, `mon`.`MaMon`, `mon`.`TenMon`
                        FROM `lophp` 
                            LEFT JOIN `giangvien` ON `lophp`.`MaGV` = `giangvien`.`MaGV` 
                            LEFT JOIN `hocki` ON `lophp`.`MaHK` = `hocki`.`MaHK` 
                            LEFT JOIN `mon` ON `lophp`.`MaMon` = `mon`.`MaMon`
                            WHERE `lophp`.`idLopHP` = '" . $id . "'
                        ;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="content row container-fluid d-flex flex-column">
                            <div class="title container-fluid">
                                <h1>232_1TH1507_KS3A_10_ngoaigio GV: Nguyễn Vạn Năng</h1>
                            </div>
                            <div class="content-main container-fluid d-flex flex-column">
                                <h1 class="content--title">Bài tập</h1>
                                <p>File submissions</p>
                                <div class="container-fluid">
                                    <div class="row content--row">
                                        <div class="col-3"></div>
                                        <div class="col d-flex justify-content-end"></div>
                                    </div>
                                    <div class="row content--row">
                                        <div class="col-3"></div>
                                        <div class="col">
                                            <button id="file_input_button" class="btn btn-secondary">Chọn tệp</button>
                                            <input type="file" id="file_input" style="display: none;" multiple>
                                            <div id="drop_zone" class="no-select">
                                                <p id="drop_zone_text" class="container-fluid">Drag one or more files to this
                                                    <i>drop zone</i>.
                                                </p>
                                                <div id="file_list" class="container-fluid"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row content--row">
                                        <div class="col-3"></div>
                                        <div class="col">
                                            <button class="btn--back btn btn-success btn--save">LƯU NHƯNG THAY ĐỔI</button>
                                            <button class="btn--back btn btn-danger btn--cancel">HỦY BỎ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            const btnSave = document.querySelector('.btn--save');
                            const btnCancel = document.querySelector('.btn--cancel');

                            btnCancel.onclick = () => {
                                alert("Những thay đổi của bạn sẽ không được lưu!");
                                window.location.href = '../NopBai/TrangThaiNopBai.php<?php echo'?id='.$id.'&num='.$_GET["num"].'';?>';
                            }

                            btnSave.onclick = () => {
                                alert("Cập nhật thành công!");
                                window.location.href = '../NopBai/TrangThaiNopBai.php<?php echo'?id='.$id.'&num='.$_GET["num"].'';?>';
                            }
                        </script>
                        <?php
                    }
                }
                $conn->close();
                ?>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
        <script>
            document.querySelector('a[href = "../LopHoc/searchLHP.php"]').classList.add('left-line')
        </script>
    </div>
    <?php include '../TrangMau/hideSidebar.php' ?>
</body>
<script src="../js/main.js"></script>
<script src="../js/dnd.js"></script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/kiemTra.css">
    <title>Document</title>
</head>

<body>
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid d-flex flex-column">
                    <div class="title container-fluid">
                        <h1>232_1TH1507_KS3A_10_ngoaigio GV: Nguyễn Vạn Năng</h1>
                    </div>
                    <div class="content-main container-fluid d-flex flex-column">
                        <h2 class="content--title">Kiểm tra giữ kỳ</h2>
                        <div class="content--align d-flex flex-column align-items-center">
                            <p>Attempts allowed: 1</p>
                            <p>Đề thi kết thúc. Wednesday, 23 August 2023, 9:35 PM</p>
                            <p>Để thử đề thi này bạn cần biết mật khẩu của đề thi đó</p>
                            <p>Thời gian làm bài: 30 phút</p>
                        </div>
                        <h2 class="content--title">Summary of your previous attempts</h2>
                        <button class="btn--change btn btn-success">
                            <a href="../BaiKiemTra/KiemTra.php">
                                BẮT ĐẦU LÀM KIỂM TRA
                            </a>
                        </button>
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
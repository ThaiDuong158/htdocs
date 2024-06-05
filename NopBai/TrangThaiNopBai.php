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
                <div class="content row container-fluid d-flex flex-column">
                    <div class="title container-fluid">
                        <h1>232_1TH1507_KS3A_10_ngoaigio GV: Nguyễn Vạn Năng</h1>
                    </div>
                    <div class="content-main container-fluid d-flex flex-column">
                        <h1 class="content--title">Bài tập</h1>
                        <h3>Submission status</h3>
                        <table class="table table-hover table-striped">
                            <tr>
                                <td>Hạn chót</td>
                                <td>Saturday, 22 April 2023, 6:00 PM</td>
                            </tr>
                            <tr>
                                <td>Time remaining</td>
                                <td>Assignment was submitted 362 ngày 23 giờ late</td>
                            </tr>
                            <tr>
                                <td>Last modified</td>
                                <td>Friday, 19 April 2024, 5:10 PM</td>
                            </tr>
                            <tr>
                                <td>File submissions</td>
                                <td>21004277_PhanDangThaiDuong.docx April 2024, 5:10 PM</td>
                            </tr>
                        </table>
                        <button class="btn--change btn btn-success">SỬA BÀI NỘP</button>
                    </div>
                </div>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.sidebar-mini').click();
        });
        const button = document.querySelector('.btn--change');
        button.addEventListener('click', function() {
            window.location.href = '../NopBai/NopBai.php';
        });

    </script>
</body>
<script src="../js/main.js"></script>

</html>
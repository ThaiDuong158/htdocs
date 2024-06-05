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
                    <div class="row container-fluid">
                        <div class="col-9 container-fluid ">
                            <div class="kiemTra">
                                <div class="cau" id="cau-1">
                                    <p>Câu 1: câu này có nội dung:</p>
                                    <div>
                                        <input type="radio" name="cau-1" id="cau1A">
                                        <label for="cau1A">Câu 1</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="cau-1" id="cau1B">
                                        <label for="cau1B">Câu 2</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="cau-1" id="cau1C">
                                        <label for="cau1C">Câu 3</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="cau-1" id="cau1D">
                                        <label for="cau1D">Câu 4</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="cau" id="cau-2">
                                    <p>Câu 2: câu này có nội dung:</p>
                                    <div>
                                        <input type="radio" name="cau-2" id="cau2A">
                                        <label for="cau2A">Câu 1</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="cau-2" id="cau2B">
                                        <label for="cau2B">Câu 2</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="cau-2" id="cau2C">
                                        <label for="cau2C">Câu 3</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="cau-2" id="cau2D">
                                        <label for="cau2D">Câu 4</label>
                                    </div>
                                </div>
                            </div>
                            <button class="nopBai btn btn-primary">
                                Nộp bài và kết thúc
                            </button>
                        </div>
                        <div class="col">
                            <div class="kiemTra-list">
                                <a href="#cau-1">1</a>
                                <a href="#cau-2">2</a>
                            </div>
                        </div>
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
    </script>
</body>
<script src="../js/main.js"></script>

</html>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../TrangMau/link.php'; ?>
    <link rel="stylesheet" href="../css/diemDanh.css">
    <title>Document</title>
</head>

<body>
    <!-- Làm Web         OK
    Làm Database
    Kết nối Database -->
    <div class="main container-fluid">
        <?php include '../TrangMau/header.php'; ?>
        <div class="row">
            <?php include '../TrangMau/sidebar.php'; ?>
            <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid">
                    <div class="">
                        <table class="table table-bordered">
                            <thead class="thead">
                                <tr>
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2">MSSV</th>
                                    <th rowspan="2">HỌ VÀ TÊN</th>
                                    <th rowspan="2">MÃ LỚP</th>
                                    <th colspan="15">ĐIỂM DANH</th>
                                </tr>
                                <tr>
                                    <td>11/03</td>
                                    <td>18/03</td>
                                    <td>25/03</td>
                                    <td>01/04</td>
                                    <td>08/04</td>
                                    <td>15/04</td>
                                    <td>22/04</td>
                                    <td>06/05</td>
                                    <td>13/05</td>
                                    <td>20/05</td>
                                    <td>27/05</td>
                                    <td>03/06</td>
                                    <td>10/06</td>
                                    <td>17/06</td>
                                    <td>24/06</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    <td>21004277</td>
                                    <td>Phan Đặng Thái Dương</td>
                                    <td>1CTT21A3</td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                    <td class="center"><input type="checkbox" name="" id=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="button">
                        <button class="btn btn-success">Lưu</button>
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
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
                        <input type="text" name="" id="inp--search">
                        <button class="btn btn-success btn--search">Tìm kiếm</button>
                    </div>
                    <div class="div--cont">
                        <div class="div--result__count row">
                            <h3>Kết quả tìm kiếm: 0</h3>
                        </div>
                        <div class="div-search">
                            <?php include '../LopHoc/loadSearch.php'; ?>
                        </div>
                    </div>
                </div>
                <?php include '../TrangMau/footer.php'; ?>
            </div>
        </div>
    </div>
    <script>
        function loadSearch() {
            var num = document.querySelectorAll(".div--cont__item").length;
            document.querySelector(".div--result__count").innerHTML = `<h3>Kết quả tìm kiếm: ${num}</h3>`;
        }
        loadSearch()
    </script>
    <script>
        const btnSearch = document.querySelector('.btn--search')
        btnSearch.addEventListener('click', () => {
            var value = document.querySelector('#inp--search').value
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.querySelector('.div-search').innerHTML = this.responseText;
                    loadSearch()
                } else {
                    loadSearch()
                }
            };
            xhttp.open("GET", `../LopHoc/loadSearch.php?val=${value}`, true);
            xhttp.send();
        })
    </script>
    <?php include '../TrangMau/hideSidebar.php' ?>
</body>
<script src="../js/main.js"></script>

</html>
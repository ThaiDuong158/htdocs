<?php include_once "header.php"; ?>

<?php include "../css/head.php"; ?>
<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['user_id'])) {
    header("location: ../login/dangnhap.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="main container-fluid">
        <?php
        include("../TrangMau/header.php");
        ?>
        <div class="row">
            <?php
            include("../TrangMau/sidebar.php");
            ?>
            <div class="col table-responsive bg-light d-flex flex-column justify-content-between">
                <div class="content row container-fluid">
                    <div class="">
                        <div class="container-lg">

                            <body>
                                <div class="wrapper">
                                    <section class="users">
                                        <header>
                                            <div class="content">
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV = {$_SESSION['user_id']}");
                                                if (mysqli_num_rows($sql) > 0) {
                                                    $row = mysqli_fetch_assoc($sql);
                                                }
                                                ?>
                                                <img src="../TTCN/<?php echo $row['FileHinh']; ?>" alt="">
                                                <div class="details">
                                                    <span><?php echo $row['TenSV'] ?></span>
                                                    <p><?php echo $row['status']; ?></p>
                                                </div>
                                            </div>
                                        </header>
                                        <div class="search">
                                            <span class="text">Select an user to start chat</span>
                                            <input type="text" placeholder="Enter name to search...">
                                            <button><i class="fas fa-search"></i></button>
                                        </div>
                                        <div class="users-list">

                                        </div>
                                    </section>
                                </div>

                                <script src="javascript/users.js"></script>

                            </body>

                            </html>
                        </div>

                    </div>
                </div>

                <?php
                include("../TrangMau/footer.php");
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.sidebar-mini').click();
        });
    </script>
</body>

</html>
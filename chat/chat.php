<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['user_id'])) {
    header("location:../DangNhap/dangnhap.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                $user_id = $_SESSION['user_id'];
                $sql = mysqli_query($conn, "SELECT * FROM sinhvien WHERE `MaSV` = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header("location: users.php");
                }
                ?>
                <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="../icon/basicUser.jpg" alt="">
                <?php echo $row['FileHinh']; ?>
                <div class="details">
                    <span><?php echo $row['TenSV'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
                
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>

</html>
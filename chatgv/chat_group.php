<?php 
// index.php 
session_start();
include_once "php/config.php"; // Database connection
if (!isset($_SESSION['user_id'])) {
    header("location: ../login/dangnhap.php"); // Redirect if not logged in
}
?>

<?php include_once "header.php"; ?> 

<body>
    <div class="wrapper">
        <?php
        $group_id = mysqli_real_escape_string($conn, $_GET['group_id']); // Sanitize input!

        // Fetch group information
        $sql_group = mysqli_query($conn, "SELECT m.TenMon, l.MaLopHP, l.Magv 
                                           FROM lophp l 
                                           INNER JOIN mon m ON m.MaMon = l.Mamon 
                                           WHERE MaLopHP = '{$group_id}'"); 

        if (mysqli_num_rows($sql_group) > 0) {
            $row_group = mysqli_fetch_assoc($sql_group);
            $group_name = $row_group['TenMon']; 
        } else {
            header("location: index.php");  
        }
        ?>

        <section class="chat-area">
            <header>
                <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <div class="details">
                    <span><?php echo $group_name; ?></span>
                    <p>Group Chat</p>
                </div>
            </header>

            <div class="chat-box">
                <?php
                // Fetch and display messages 
                $sql_messages = mysqli_query($conn, "SELECT m.*, s.TenSV, s.FileHinh
                                                      FROM messages m
                                                      JOIN SinhVien s ON m.outgoing_msg_id = s.MaSV
                                                      WHERE (m.incoming_msg_id = '{$group_id}' OR 
                                                             m.outgoing_msg_id = '{$group_id}')
                                                      ORDER BY msg_id ASC"); 

                if (mysqli_num_rows($sql_messages) > 0) {
                    while ($row_message = mysqli_fetch_assoc($sql_messages)) {
                        if ($row_message['outgoing_msg_id'] === $_SESSION['user_id']) {
                            echo '<div class="chat outgoing">
                                      <div class="details">
                                          <p>' . $row_message['msg'] . '</p>
                                      </div>
                                  </div>';
                        } else {
                            echo '<div class="chat incoming">
                                      <img src="../icon/basicUser.jpg" alt="">
                                      <div class="details">
                                          <span>' . $row_message['TenSV'] . '</span>
                                          <p>' . $row_message['msg'] . '</p>
                                      </div>
                                  </div>';
                        }
                    }
                } else {
                    echo '<div class="text">No messages available. Start the conversation!</div>';
                }
                ?>
            </div>

            <form action="#" class="typing-area">
                <input type="text" class="group_id" name="group_id" value="<?php echo $group_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat_group.js"></script>
</body>
</html>
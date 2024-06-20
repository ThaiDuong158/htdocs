<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['group_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (!empty($message)) {
        // Use the correct table and column names:
        $sql = mysqli_query($conn, "INSERT INTO group_message (MaLopHP, Message, outcoming_id) 
                                        VALUES ('{$incoming_id}', '{$message}', '{$outgoing_id}')") 
               or die(mysqli_error($conn)); // Helpful for debugging
    }
} else {
    header("location: ../login.php");
    exit; // Important: Exit after redirect 
}
?>
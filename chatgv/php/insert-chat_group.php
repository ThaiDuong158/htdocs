<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id =  $_POST["group_id"];
    $message =  $_POST["message"];
    if (!empty($message)) {
        // Use the correct table and column names:
        $sql = mysqli_query($conn, "INSERT INTO group_message (id_group, MaLopHP, Message, outcoming_id) 
                                        VALUES (".random_int(00000000,99999999).",'{$incoming_id}', '{$message}', '{$outgoing_id}')") 
               or die(mysqli_error($conn)); // Helpful for debugging
    }
} else {
    header("location: ../login.php");
    exit; // Important: Exit after redirect 
}
?>
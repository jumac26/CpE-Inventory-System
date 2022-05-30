<?php
    session_start();

    unset($_SESSION['userName']);
    unset($_SESSION['user_id']);
    header("location:index.php");
?>
<?php
    session_start();
    include('../db.php');

    if(isset($_POST['submit'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $email_safe = mysqli_real_escape_string($conn, $email);

        $sql = "SELECT * FROM tblbuyers WHERE email = '$email_safe'";
        $result = mysqli_query($conn, $sql);
    }
?>
<?php
    session_start();
    include('../db.php');

    if(isset($_POST['submit'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $email_safe = mysqli_real_escape_string($conn, $email);

        $sql = "SELECT * FROM tblbuyers WHERE email = '$email_safe'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $buyer = mysqli_fetch_assoc($result);

            if(password_verify($password, $buyer['password'])) {

            } else {
                $_SESSION['error'] = "Incorrect email or password. Please try again.";
                mysqli_close($conn);
                header('Location: ../login.php');
                exit();
            }

        } else {
            $_SESSION['error'] = "Incorrect email or password. Please try again.";
            mysqli_close($conn);
            header('Location: ../login.php');
            exit();
        }
    }
?>
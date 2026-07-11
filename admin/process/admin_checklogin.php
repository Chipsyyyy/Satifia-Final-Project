<?php
    session_start();

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // TODO: Replace with real DB query + password_verify()
        if($username == "admin" && $password == "admin123") {
            $_SESSION['admin_id']   = 1;
            $_SESSION['admin_name'] = "Super Admin";
            $_SESSION['admin_role'] = "Admin";
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['admin_error'] = "Invalid username or password.";
            header('Location: ../login.php');
            exit();
        }
    }
?>
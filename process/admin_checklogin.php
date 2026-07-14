<?php
    session_start();
    include('../../db.php');

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username_safe = mysqli_real_escape_string($conn, $username);
        $sql = "SELECT * FROM tbladmins WHERE username = '$username_safe'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);

            if(password_verify($password, $admin['password'])) {
                $_SESSION['admin_id']   = $admin['id'];
                $_SESSION['admin_name'] = $admin['fullname'];
                $_SESSION['admin_role'] = $admin['role'];

                // Log this action in the audit log
                $admin_id_safe   = $admin['id'];
                $admin_name_safe = mysqli_real_escape_string($conn, $admin['fullname']);
                $log_sql = "INSERT INTO tblaudit_log (admin_id, admin_name, action)
                            VALUES ('$admin_id_safe', '$admin_name_safe', 'Logged in')";
                mysqli_query($conn, $log_sql);

                mysqli_close($conn);
                header('Location: ../index.php');
                exit();
            } else {
                $_SESSION['admin_error'] = "Invalid username or password.";
                mysqli_close($conn);
                header('Location: ../login.php');
                exit();
            }
        } else {
            $_SESSION['admin_error'] = "Invalid username or password.";
            mysqli_close($conn);
            header('Location: ../login.php');
            exit();
        }
    }
?>

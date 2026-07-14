<?php
    session_start();
    include('../../db.php');

    if(!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit();
    }

    if(isset($_POST['submit'])) {
        $user_id = (int) $_POST['user_id'];

        if($user_id == $_SESSION['admin_id']) {
            $_SESSION['admin_error'] = "You cannot delete your own account.";
            mysqli_close($conn);
            header('Location: ../users.php');
            exit();
        }

        $name_sql = "SELECT fullname FROM tbladmins WHERE id = '$user_id'";
        $name_result = mysqli_query($conn, $name_sql);
        $deleted_fullname = "";
        if($name_row = mysqli_fetch_assoc($name_result)) {
            $deleted_fullname = $name_row['fullname'];
        }

        $sql = "DELETE FROM tbladmins WHERE id = '$user_id'";

        if(mysqli_query($conn, $sql)) {
            $_SESSION['admin_success'] = "User deleted successfully.";

            $admin_id_safe   = (int) $_SESSION['admin_id'];
            $admin_name_safe = mysqli_real_escape_string($conn, $_SESSION['admin_name']);
            $log_action_safe = mysqli_real_escape_string($conn, "Deleted admin user: $deleted_fullname");
            $log_sql = "INSERT INTO tblaudit_log (admin_id, admin_name, action) VALUES ('$admin_id_safe', '$admin_name_safe', '$log_action_safe')";
            mysqli_query($conn, $log_sql);
        } else {
            $_SESSION['admin_error'] = "Could not delete user.";
        }
    }

    mysqli_close($conn);
    header('Location: ../users.php');
    exit();
?>




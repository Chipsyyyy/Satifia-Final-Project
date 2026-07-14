<?php
    session_start();
    include('../../db.php');

    if(!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit();
    }

    if(isset($_POST['submit'])) {
        $user_id  = $_POST['user_id'];
        $fullname = trim($_POST['fullname']);
        $username = trim($_POST['username']);
        $role     = $_POST['role'];
        $password = $_POST['password'];
        $confirm  = $_POST['confirmpassword'];

        $errors = array();
        $is_edit = !empty($user_id);

        if(empty($fullname)) { $errors[] = "Full name is required."; }
        if(empty($username)) { $errors[] = "Username is required."; }

        if(!$is_edit && empty($password)) {
            $errors[] = "Password is required for new users.";
        }
        if(!empty($password) && strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        }
        if(!empty($password) && $password !== $confirm) {
            $errors[] = "Passwords do not match.";
        }

        // Check if username is already taken (by a different user)
        if(empty($errors) && !empty($username)) {
            $username_safe = mysqli_real_escape_string($conn, $username);
            $check_sql = $is_edit
                ? "SELECT id FROM tbladmins WHERE username = '$username_safe' AND id != '" . (int)$user_id . "'"
                : "SELECT id FROM tbladmins WHERE username = '$username_safe'";
            $check_result = mysqli_query($conn, $check_sql);

            if(mysqli_num_rows($check_result) > 0) {
                $errors[] = "This username is already taken.";
            }
        }

        if(!empty($errors)) {
            $_SESSION['admin_errors'] = $errors;
            $redirect = $is_edit ? '../user_form.php?id=' . $user_id : '../user_form.php';
            mysqli_close($conn);
            header('Location: ' . $redirect);
            exit();
        }

        $fullname_safe = mysqli_real_escape_string($conn, $fullname);
        $username_safe = mysqli_real_escape_string($conn, $username);
        $role_safe     = mysqli_real_escape_string($conn, $role);

        if($is_edit) {
            $user_id_safe = (int) $user_id;

            if(!empty($password)) {
                // Update with new password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE tbladmins
                        SET fullname = '$fullname_safe', username = '$username_safe', role = '$role_safe', password = '$hashed_password'
                        WHERE id = '$user_id_safe'";
            } else {
                // Keep existing password
                $sql = "UPDATE tbladmins
                        SET fullname = '$fullname_safe', username = '$username_safe', role = '$role_safe'
                        WHERE id = '$user_id_safe'";
            }
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tbladmins (fullname, username, password, role)
                    VALUES ('$fullname_safe', '$username_safe', '$hashed_password', '$role_safe')";
        }

        if(mysqli_query($conn, $sql)) {
            $_SESSION['admin_success'] = $is_edit
                ? "User \"$fullname\" updated successfully."
                : "User \"$fullname\" added successfully.";

            // Log this action
            $admin_id_safe   = (int) $_SESSION['admin_id'];
            $admin_name_safe = mysqli_real_escape_string($conn, $_SESSION['admin_name']);
            $log_action      = $is_edit ? "Updated admin user: $fullname" : "Added new admin user: $fullname";
            $log_action_safe = mysqli_real_escape_string($conn, $log_action);
            $log_sql = "INSERT INTO tblaudit_log (admin_id, admin_name, action) VALUES ('$admin_id_safe', '$admin_name_safe', '$log_action_safe')";
            mysqli_query($conn, $log_sql);
        } else {
            $_SESSION['admin_error'] = "Something went wrong. Please try again.";
        }

        mysqli_close($conn);
        header('Location: ../users.php');
        exit();
    }
?>




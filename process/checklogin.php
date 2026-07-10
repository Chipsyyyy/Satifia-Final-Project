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

                // Check if email is confirmed
                if($buyer['is_confirmed'] == 0) {
                    $_SESSION['error'] = "Please confirm your email address before logging in. Check your inbox for the confirmation link.";
                    mysqli_close($conn);
                    header('Location: ../login.php');
                    exit();
                }

                $_SESSION['buyer_id']      = $buyer['id'];
                $_SESSION['buyer_name']    = $buyer['fullname'];
                $_SESSION['buyer_email']   = $buyer['email'];
                $_SESSION['buyer_address'] = $buyer['address'];
                $_SESSION['buyer_contact'] = $buyer['contact'];

                mysqli_close($conn);
                header('Location: ../store.php');
                exit();
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
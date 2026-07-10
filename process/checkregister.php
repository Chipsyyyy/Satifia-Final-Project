<?php
    session_start();
    include('../db.php')

    if(isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $confirm  = $_POST['confirmpassword'];
        $address  = $_POST['address'];
        $contact  = $_POST['contact'];

        $errors = array();

        if(!checkname($fullname)) {
            $errors[] = "Full name must only contain letters, spaces, and periods.";
        }
        if(!checkemail($email)) {
            $errors[] = "Please enter a valid email address.";
        }
        if(!checkpassword($password)) {
            $errors[] = "Password must be at least 8 characters.";
        }
        if(!checkconfirmpassword($password, $confirm)) {
            $errors[] = "Passwords do not match.";
        }
        if(empty(trim($address))) {
            $errors[] = "Please enter your complete address.";
        }
        if(!checkcontact($contact)) {
            $errors[] = "Contact number must be 11 digits starting with 09.";
        }

        // Check if email already exists
        if(checkemail($email)) {
            $email_safe = mysqli_real_escape_string($conn, $email);

            $check_sql = "SELECT id FROM tblbuyers
                          WHERE email = '$email_safe'";

            $check_result = mysqli_query($conn, $check_sql);

            if(mysqli_num_rows($check_result) > 0) {
                $errors[] = "This email is already registered. Please use a different email or log in.";
            }
        }

        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $_SESSION['form_data'] = array(
                'fullname' => $fullname,
                'email'    => $email,
                'address'  => $address,
                'contact'  => $contact
            );

            header('Location: ../register.php');
            exit();
        } else {
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $fullname_safe = mysqli_real_escape_string(
                $conn,
                $fullname
            );

            $email_safe = mysqli_real_escape_string(
                $conn,
                $email
            );

            $address_safe = mysqli_real_escape_string(
                $conn,
                $address
            );

            $contact_safe = mysqli_real_escape_string(
                $conn,
                $contact
            );

            $token = bin2hex(random_bytes(32));

            $insert_sql = "INSERT INTO tblbuyers
                           (fullname, email, password, address, contact, confirm_token)
                           VALUES
                           ('$fullname_safe', '$email_safe', '$hashed_password',
                           '$address_safe', '$contact_safe', '$token')";

            if(mysqli_query($conn, $insert_sql)) {
                $_SESSION['success'] = "Registration successful!";

                mysqli_close($conn);

                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['errors'] = array(
                    "Something went wrong. Please try again."
                );

                mysqli_close($conn);

                header('Location: ../register.php');
                exit();
            }
        }
    }

    function checkname($name) {
        $pattern = "/^[A-Za-z\.\s\-]+$/";
        return preg_match($pattern, $name);
    }

    function checkemail($email) {
        $pattern = "/^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        return preg_match($pattern, $email);
    }

    function checkpassword($password) {
        return strlen($password) >= 8;
    }

    function checkconfirmpassword($password, $confirm) {
        return $password === $confirm;
    }

    function checkcontact($contact) {
        $pattern = "/^09[0-9]{9}$/";
        return preg_match($pattern, $contact);
    }
?>
<?php
session_start();
include('../db.php');

if(!isset($_SESSION['buyer_id'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $recv_name = $_POST['recv_name'];
    $recv_address = $_POST['recv_address'];
    $recv_contact = $_POST['recv_contact'];
    $recv_email = $_POST['recv_email'];
    $payment_method = $_POST['payment_method'];
    
    $errors = array();

    if(isset($_POST['submit'])) {
        $recv_name = $_POST['recv_name'];
        $recv_address = $_POST['recv_address'];
        $recv_contact = $_POST['recv_contact'];
        $recv_email = $_POST['recv_email'];
        $payment_method = $_POST['payment_method'];

        $errors = array();

        if(empty(trim($recv_name))) {
            $errors[] = "Please enter the recipient's name.";
        }

        if(empty(trim($recv_address))) {
            $errors[] = "Please enter a delivery address.";
        }

        if(empty(trim($recv_contact))) {
            $errors[] = "Please enter the recipient's contact information.";
        }

        if(empty(trim($recv_email))) {
            $errors[] = "Please enter the recipient's email address for confirmation.";
        }

        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ../checkout.php');
            exit();
        } 

        $cart = $_SESSION['cart'];

        if(empty($cart)) {
            header('Location: ../cart.php');
            exit();
        }

        $subtotal = 0;

        foreach($cart as $item) {
            $price = (float) str_replace(',','', $item['price']);
            $subtotal += $price * $item['qty'];
        }

        $shipping = ($subtotal >= 1500) ? 0 : 150;
        $total = $subtotal + $shipping;

        $method_labels = array(
            'cod' => 'Cash On Delivery (COD)',
            'gcash' => 'Gcash',
            'bank' => 'Bank Transfer',
        );

        $payment_label = isset($method_labels[$payment_method])
        ? $method_labels[$payment_method]
        : $payment_method;

        $buyer_id_safe = (int) $_SESSION['buyer_id'];

        $recv_name_safe = mysqli_real_escape_string(
            $conn,
            $recv_name
        );

        $recv_address_safe = mysqli_real_escape_string(
            $conn,
            $recv_address
        );

        $recv_contact_safe = mysqli_real_escape_string(
            $conn,
            $recv_contact
        );

        $recv_email_safe = mysqli_real_escape_string(
            $conn,
            $recv_email
        );

        $payment_label_safe = mysqli_real_escape_string(
            $conn,
            $payment_label
        );

        $total_safe = (float) $total;


    



        }
    }
}
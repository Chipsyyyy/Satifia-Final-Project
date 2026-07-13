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

        



        }
    }
}
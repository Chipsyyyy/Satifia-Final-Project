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

    if
}
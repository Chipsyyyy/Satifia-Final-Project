<?php
    session_start();
    include('../db.php');
    require('../mailer.php');

    if(isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $confirm  = $_POST['confirmpassword'];
        $address  = $_POST['address'];
        $contact  = $_POST['contact'];

    }
?>
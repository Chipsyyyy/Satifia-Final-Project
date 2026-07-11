<?php
session_start();

if(!isset($_SESSION['buyer_id'])) {
    header('Location: login.php');
    exit();
}


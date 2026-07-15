<?php
$host = "sql309.infinityfree.com";
$username = "if0_42410940";
$password = "sksqk8xaB1ul8m";
$database = "if0_42410940_satifia_db";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
<?php

$host = "sql104.infinityfree.com";
$user = "if0_42080828";
$password = "Y6lclS7S2PkI";
$dbname = "if0_42080828_elderly_care_system";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
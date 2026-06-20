<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$dosage = $_POST['dosage'];
$time = $_POST['time'];
$notes = $_POST['notes'];

$sql = "INSERT INTO medications (user_id, name, dosage, time, notes)
        VALUES ('$user_id', '$name', '$dosage', '$time', '$notes')";

if (mysqli_query($conn, $sql)) {
    header("Location: family.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
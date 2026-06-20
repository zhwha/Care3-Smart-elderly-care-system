<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$doctor_name = $_POST['doctor_name'];
$date = $_POST['date'];
$time = $_POST['time'];
$notes = $_POST['notes'];

$sql = "INSERT INTO doctor_appointments (user_id, doctor_name, date, time, notes)
        VALUES ('$user_id', '$doctor_name', '$date', '$time', '$notes')";

if (mysqli_query($conn, $sql)) {
    header("Location: family.php");
} else {
    echo "Error: " . mysqli_error($conn);
}

$user_id = $_SESSION['user_id'];

mysqli_query($conn, "
INSERT INTO notifications (user_id, message, type)
VALUES ('$user_id', '📅 New Doctor Appointment Added', 'appointment')
");
?>
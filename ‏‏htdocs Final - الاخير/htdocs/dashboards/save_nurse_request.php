<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$date = $_POST['date'];
$time = $_POST['time'];
$duration = $_POST['duration'];
$notes = $_POST['notes'];

$sql = "INSERT INTO nurse_requests (user_id, date, time, duration, notes)
        VALUES ('$user_id', '$date', '$time', '$duration', '$notes')";

if (mysqli_query($conn, $sql)) {

    echo "<script>
        alert('Nurse request sent successfully!');
        window.location.href='family.php';
    </script>";

} else {
    echo "Error: " . mysqli_error($conn);
}
 

mysqli_query($conn, "
INSERT INTO notifications (user_id, message, type)
VALUES ('$user_id', ' Nurse Request Sent', 'nurse')
");
?>
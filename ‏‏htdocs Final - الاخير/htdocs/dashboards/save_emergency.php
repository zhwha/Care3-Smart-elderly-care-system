<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

mysqli_query($conn, "
INSERT INTO emergency_alerts
(user_id, message, latitude, longitude)

VALUES
('$user_id', '🚨 Emergency triggered', '$latitude', '$longitude')
");

echo "
<script>
alert('Emergency sent successfully!');
window.location.href='elderly.php';
</script>
";
?>
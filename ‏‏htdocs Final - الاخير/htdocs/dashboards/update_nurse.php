<?php
session_start();
include "../config/db.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "
UPDATE nurse_requests 
SET status='$status'
WHERE id='$id'
");

header("Location: nurse.php");
exit();
?>
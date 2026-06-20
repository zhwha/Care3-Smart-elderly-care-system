<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/db.php";

/* =========================
   PROTECTION
========================= */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$nurse_id = $_SESSION['user_id'];

/* =========================
   GET NURSE INFO SAFELY
========================= */
$sql = "SELECT id, name, email, role 
        FROM users 
        WHERE id = '$nurse_id'
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$nurse = mysqli_fetch_assoc($result);

if (!$nurse || $nurse['role'] !== 'nurse') {
    die("Access denied: not a nurse account.");
}

/* =========================
   NOTIFICATIONS
========================= */
$notif_sql = "SELECT * FROM notifications 
              WHERE user_id='$nurse_id' 
              ORDER BY id DESC 
              LIMIT 5";

$notif_result = mysqli_query($conn, $notif_sql);

$count_sql = "SELECT COUNT(*) as c 
              FROM notifications 
              WHERE user_id='$nurse_id' AND is_read=0";

$count_result = mysqli_query($conn,$count_sql);
$notif_count = mysqli_fetch_assoc($count_result)['c'] ?? 0;

/* =========================
   NURSE REQUESTS (FILTERED BY FAMILY ONLY)
========================= */
$sql_req = "SELECT n.*, u.name AS requester_name
            FROM nurse_requests n
            JOIN users u ON n.user_id = u.id
            WHERE n.user_id IN (
                SELECT family_id FROM family_links
            )
            ORDER BY n.id DESC";

$result_req = mysqli_query($conn, $sql_req);

if (!$result_req) {
    die("SQL ERROR: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Nurse Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:#f4fdfc;
}

.header{
    background:linear-gradient(90deg,#14b8a6,#38bdf8);
    color:white;
    padding:18px;
    text-align:center;
    font-size:20px;
    font-weight:bold;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 20px;
    background:white;
    margin:15px;
    border-radius:12px;
    box-shadow:0 5px 10px rgba(0,0,0,0.05);
}

.profile-card{
    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white;
    padding:20px;
    border-radius:15px;
    display:flex;
    align-items:center;
    gap:15px;
    margin:15px;
}

.avatar i{
    font-size:50px;
    background:white;
    color:#14b8a6;
    padding:15px;
    border-radius:50%;
}

.container{
    padding:20px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:15px;
}

.card{
    background:white;
    border-radius:15px;
    padding:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    border-left:5px solid #14b8a6;
}

.btn{
    padding:8px 10px;
    border:none;
    border-radius:8px;
    color:white;
    cursor:pointer;
    font-size:13px;
    text-decoration:none;
}

.accept{background:#16a34a;}
.reject{background:#dc2626;}
.done{background:#14b8a6;}

.logout{
    position:fixed;
    bottom:20px;
    right:20px;
    background:#dc2626;
    color:white;
    padding:12px 15px;
    border-radius:50px;
    text-decoration:none;
}

.badge{
    background:red;
    color:white;
    font-size:11px;
    padding:2px 6px;
    border-radius:50%;
}
</style>
</head>

<body>

<div class="header">
    Nurse Dashboard
</div>

<!-- TOPBAR -->
<div class="topbar">
    <h3 style="margin:0;color:#0f766e;">👩‍⚕️ Nurse Panel</h3>
</div>

<!-- PROFILE -->
<div class="profile-card">
    <div class="avatar">
        <i class="fa-solid fa-user-nurse"></i>
    </div>

    <div>
        <h2><?php echo $nurse['name']; ?></h2>
        <p><?php echo $nurse['email']; ?></p>
        <span style="background:white;color:#14b8a6;padding:5px 10px;border-radius:8px;">
            Nurse Active
        </span>
    </div>
</div>

<!-- REQUESTS -->
<div class="container">
<div class="grid">

<?php while($row = mysqli_fetch_assoc($result_req)) { ?>

<div class="card">

    <div style="margin-bottom:10px;">
        <b style="color:#0f766e;">
            <?php echo $row['requester_name']; ?>
        </b>
        <br>
        <small style="color:gray;">Family Request</small>
    </div>

    <p><b>Date:</b> <?php echo $row['date']; ?></p>
    <p><b>Time:</b> <?php echo $row['time']; ?></p>
    <p><b>Duration:</b> <?php echo $row['duration']; ?> hours</p>

    <p><b>Status:</b> <?php echo strtoupper($row['status']); ?></p>

    <div style="display:flex;gap:8px;margin-top:10px;flex-wrap:wrap;">

        <a class="btn accept"
           href="update_nurse.php?id=<?php echo $row['id']; ?>&status=accepted">
            Accept
        </a>

        <a class="btn reject"
           href="update_nurse.php?id=<?php echo $row['id']; ?>&status=rejected">
            Reject
        </a>

        <a class="btn done"
           href="update_nurse.php?id=<?php echo $row['id']; ?>&status=completed">
            Done
        </a>

    </div>

</div>

<?php } ?>

</div>
</div>

<!-- LOGOUT -->
<a href="logout.php" class="logout">
    Logout
</a>

</body>
</html>
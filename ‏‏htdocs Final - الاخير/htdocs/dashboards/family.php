<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* عدد الإشعارات (خاص بالمستخدم فقط) */
$notif_count = 0;
$emergency_notif = mysqli_query($conn,"
    SELECT COUNT(*) as c
    FROM emergency_alerts e
    WHERE e.user_id IN (
        SELECT elderly_id
        FROM family_links
        WHERE family_id = '$user_id'
    )
");

$notif_count = mysqli_fetch_assoc($emergency_notif)['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Family Dashboard</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- FONT AWESOME ICONS -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#f4f7fb;
    overflow-x:hidden;
}

/* ================= NAVBAR ================= */

.navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:80px;
    background:rgba(255,255,255,0.9);
    backdrop-filter:blur(12px);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 25px;
    z-index:1000;
    box-shadow:0 5px 25px rgba(0,0,0,0.08);
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo-icon{
    width:50px;
    height:50px;
    border-radius:16px;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:22px;
    box-shadow:0 8px 20px rgba(20,184,166,0.4);
}

.logo h2{
    color:#0f172a;
    font-size:22px;
}

.nav-right{
    display:flex;
    align-items:center;
    gap:20px;
}

.search-box{
    position:relative;
}

.search-box input{
    width:260px;
    padding:12px 18px 12px 45px;
    border:none;
    border-radius:50px;
    background:#f1f5f9;
    outline:none;
    font-size:14px;
}

.search-box i{
    position:absolute;
    left:16px;
    top:50%;
    transform:translateY(-50%);
    color:#64748b;
}

/* NOTIFICATION */

.notif-btn{
    position:relative;
    width:50px;
    height:50px;
    border-radius:50%;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:20px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 8px 20px rgba(14,165,233,0.3);
}

.notif-btn:hover{
    transform:translateY(-3px);
}

.notif-count{
    position:absolute;
    top:-3px;
    right:-3px;
    background:#ef4444;
    color:white;
    width:22px;
    height:22px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:bold;
}

/* NOTIFICATION BOX */

.notif-box{
    position:absolute;
    top:75px;
    right:20px;
    width:320px;
    background:white;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(0,0,0,0.15);
    display:none;
    z-index:1000;
}

.notif-header{
    padding:18px;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    font-weight:600;
}

.notif-item{
    padding:16px;
    display:flex;
    gap:14px;
    border-bottom:1px solid #f1f5f9;
    transition:0.3s;
}

.notif-item:hover{
    background:#f8fafc;
}

.notif-icon{
    width:45px;
    height:45px;
    border-radius:12px;
    background:#fee2e2;
    color:#dc2626;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

/* ================= LAYOUT ================= */

.container{
    display:flex;
    margin-top:80px;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:270px;
    min-height:100vh;
    background:linear-gradient(180deg,#0f172a,#1e293b);
    padding:30px 20px;
    position:fixed;
    left:0;
    top:80px;
}

.sidebar-menu{
    margin-top:25px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:14px;
    text-decoration:none;
    color:#cbd5e1;
    padding:16px;
    border-radius:18px;
    margin-bottom:12px;
    transition:0.3s;
    font-weight:500;
}

.sidebar a:hover{
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    transform:translateX(5px);
}

.sidebar a i{
    font-size:18px;
}

/* ================= MAIN ================= */

.main{
    flex:1;
    margin-left:270px;
    padding:30px;
}

/* HERO */

.hero{
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    border-radius:30px;
    padding:40px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 20px 50px rgba(20,184,166,0.25);
    margin-bottom:30px;
}

.hero h1{
    font-size:36px;
    margin-bottom:10px;
}

.hero p{
    opacity:0.9;
}

.hero-icon{
    font-size:90px;
    opacity:0.2;
}

/* ================= CARDS ================= */

.card{
    background:white;
    border-radius:24px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 10px 40px rgba(0,0,0,0.06);
}

/* TITLE */

.section-title{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:22px;
}

.section-title i{
    width:45px;
    height:45px;
    border-radius:14px;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
}

.section-title h3{
    color:#0f172a;
}

/* MEDICATION */

.med-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:20px;
}

.med-card{
    background:linear-gradient(145deg,#ffffff,#f8fafc);
    border-radius:24px;
    padding:22px;
    border:1px solid #e2e8f0;
    transition:0.3s;
    position:relative;
    overflow:hidden;
}

.med-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

.med-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:6px;
    height:100%;
    background:linear-gradient(#14b8a6,#0ea5e9);
}

.med-top{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:15px;
}

.med-icon{
    width:55px;
    height:55px;
    border-radius:18px;
    background:#d1fae5;
    color:#059669;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.med-card h4{
    color:#0f172a;
}

.med-card p{
    margin:8px 0;
    color:#475569;
    font-size:14px;
}

/* TABLE */

.table-container{
    overflow-x:auto;
}

.styled-table{
    width:100%;
    border-collapse:collapse;
}

.styled-table thead{
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
}

.styled-table th{
    padding:16px;
    text-align:left;
}

.styled-table td{
    padding:16px;
    border-bottom:1px solid #f1f5f9;
}

.styled-table tbody tr:hover{
    background:#f8fafc;
}

/* STATUS */

.status{
    padding:8px 14px;
    border-radius:50px;
    font-size:13px;
    font-weight:600;
}

.pending{
    background:#fef3c7;
    color:#d97706;
}

.accepted{
    background:#dcfce7;
    color:#16a34a;
}

.rejected{
    background:#fee2e2;
    color:#dc2626;
}

/* EMERGENCY */

.emergency-card{
    border:2px solid #fecaca;
    background:#fff5f5;
}

.emergency-item{
    background:white;
    padding:20px;
    border-radius:20px;
    margin-top:18px;
    border-left:5px solid #ef4444;
}

.emergency-top{
    display:flex;
    gap:15px;
    align-items:center;
}

.emergency-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    background:#fee2e2;
    color:#dc2626;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.map-container{
    margin-top:18px;
    border-radius:20px;
    overflow:hidden;
}

/* MOBILE */

.menu-btn{
    display:none;
    font-size:22px;
    cursor:pointer;
}

@media(max-width:991px){

    .sidebar{
        left:-100%;
        transition:0.4s;
        z-index:999;
    }

    .sidebar.active{
        left:0;
    }

    .main{
        margin-left:0;
    }

    .menu-btn{
        display:block;
    }

    .search-box{
        display:none;
    }

    .hero{
        flex-direction:column;
        text-align:center;
        gap:20px;
    }

    .hero h1{
        font-size:28px;
    }
}

@media(max-width:600px){

    .navbar{
        padding:0 15px;
    }

    .main{
        padding:18px;
    }

    .card{
        padding:18px;
    }

    .hero{
        padding:30px 20px;
    }

    .hero h1{
        font-size:24px;
    }
}

</style>
</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">

        <div class="menu-btn" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="logo-icon">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>

        <h2>Elderly Care</h2>

    </div>

    <div class="nav-right">

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search here...">
        </div>

        <div class="notif-btn" onclick="toggleNotif()">

            <i class="fa-solid fa-bell"></i>

            <?php if($notif_count > 0){ ?>
                <div class="notif-count">
                    <?php echo $notif_count; ?>
                </div>
            <?php } ?>

        </div>

    </div>

</div>

<!-- NOTIFICATION BOX -->

<div class="notif-box" id="notifBox">

    <div class="notif-header">
        Notifications
    </div>

    <div class="notif-item">

        <div class="notif-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <div>
            <b>Emergency Alert</b>
            <p style="font-size:13px;color:gray;">
                A new emergency alert has arrived.
            </p>
        </div>

    </div>

</div>

<!-- CONTAINER -->

<div class="container">

    <!-- SIDEBAR -->

    <div class="sidebar" id="sidebar">

        <div class="sidebar-menu">

            <a href="#">
                <i class="fa-solid fa-house"></i>
                Home
            </a>

            <a href="add_medication.php">
                <i class="fa-solid fa-pills"></i>
                Add Medication
            </a>

            <a href="add_appointment.php">
                <i class="fa-solid fa-calendar-check"></i>
                Appointments
            </a>

            <a href="nurse_request.php">
                <i class="fa-solid fa-user-nurse"></i>
                Request Nurse
            </a>

            <a href="#">
                <i class="fa-solid fa-lock"></i>
                Change Password
            </a>

            <a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </div>

    <!-- MAIN -->

    <div class="main">

        <!-- HERO -->

        <div class="hero">

            <div>
                <h1>Family Care Dashboard</h1>
                <p>
                    Monitor medications, appointments,
                    nurse requests and emergency alerts easily.
                </p>
            </div>

            <div class="hero-icon">
                <i class="fa-solid fa-user-group"></i>
            </div>

        </div>

        <!-- EMERGENCY -->

        <div class="card emergency-card">

            <div class="section-title">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h3>Emergency Alerts</h3>
            </div>

<?php
$sql = "SELECT e.*, u.name
        FROM emergency_alerts e
        JOIN users u ON e.user_id = u.id
        WHERE e.user_id IN (
            SELECT elderly_id
            FROM family_links
            WHERE family_id = '$user_id'
        )
        ORDER BY e.id DESC";

$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

<div class="emergency-item">

    <div class="emergency-top">

        <div class="emergency-icon">
            <i class="fa-solid fa-siren-on"></i>
        </div>

        <div>
            <h4><?php echo $row['name']; ?></h4>
            <p><?php echo $row['message']; ?></p>
            <small style="color:gray;">
                <?php echo $row['created_at']; ?>
            </small>
        </div>

    </div>

    <div class="map-container">

        <iframe
        width="100%"
        height="250"
        style="border:0;"
        loading="lazy"
        allowfullscreen
        src="https://maps.google.com/maps?q=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>&z=15&output=embed">
        </iframe>

    </div>

</div>

<?php
    }

}else{

    echo "<p>No emergency alerts.</p>";
}
?>

        </div>

        <!-- MEDICATION -->

        <div class="card">

            <div class="section-title">
                <i class="fa-solid fa-pills"></i>
                <h3>Medication List</h3>
            </div>

<?php

$sql = "SELECT * FROM medications
        WHERE user_id='$user_id'
        ORDER BY id DESC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

    echo "<div class='med-grid'>";

    while($row = mysqli_fetch_assoc($result)){

        echo "

        <div class='med-card'>

            <div class='med-top'>

                <div class='med-icon'>
                    <i class='fa-solid fa-capsules'></i>
                </div>

                <div>
                    <h4>{$row['name']}</h4>
                    <small style='color:gray;'>Medication</small>
                </div>

            </div>

            <p><b>Dosage:</b> {$row['dosage']}</p>
            <p><b>Time:</b> {$row['time']}</p>
            <p><b>Notes:</b> {$row['notes']}</p>

        </div>

        ";
    }

    echo "</div>";

}else{

    echo "<p>No medications added yet.</p>";
}
?>

        </div>

        <!-- APPOINTMENTS -->

        <div class="card">

            <div class="section-title">
                <i class="fa-solid fa-calendar-check"></i>
                <h3>Doctor Appointments</h3>
            </div>

<?php

$sql = "SELECT * FROM doctor_appointments
        WHERE user_id='$user_id'
        ORDER BY date ASC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
?>

<div class="table-container">

<table class="styled-table">

<thead>
<tr>
    <th>Doctor</th>
    <th>Date</th>
    <th>Time</th>
    <th>Notes</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?php echo $row['doctor_name']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo $row['time']; ?></td>
    <td><?php echo $row['notes']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php
}else{
    echo "<p>No appointments available.</p>";
}
?>

        </div>

        <!-- NURSE REQUESTS -->

        <div class="card">

            <div class="section-title">
                <i class="fa-solid fa-user-nurse"></i>
                <h3>Nurse Requests</h3>
            </div>

<?php

$sql = "SELECT * FROM nurse_requests
        WHERE user_id='$user_id'
        ORDER BY id DESC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
?>

<div class="table-container">

<table class="styled-table">

<thead>
<tr>
    <th>Date</th>
    <th>Time</th>
    <th>Duration</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?php echo $row['date']; ?></td>
    <td><?php echo $row['time']; ?></td>
    <td><?php echo $row['duration']; ?></td>

    <td>

<?php
if($row['status']=="pending"){
    echo "<span class='status pending'>Pending</span>";
}
elseif($row['status']=="accepted"){
    echo "<span class='status accepted'>Accepted</span>";
}
else{
    echo "<span class='status rejected'>Rejected</span>";
}
?>

    </td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php
}else{
    echo "<p>No nurse requests yet.</p>";
}
?>

        </div>

    </div>

</div>

<script>

function toggleNotif(){

    let box = document.getElementById("notifBox");

    if(box.style.display === "block"){
        box.style.display = "none";
    }else{
        box.style.display = "block";
    }
}

function toggleSidebar(){

    document.getElementById("sidebar")
    .classList.toggle("active");
}

</script>

</body>
</html>
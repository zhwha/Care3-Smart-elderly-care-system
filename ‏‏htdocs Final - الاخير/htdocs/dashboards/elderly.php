<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];

include "../config/db.php";

/* profile */
$sql = "SELECT * FROM elderly_profiles WHERE user_id='$user_id'";
$result = mysqli_query($conn,$sql);
$profile = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Elderly Dashboard</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- FONT AWESOME -->
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
    background:rgba(255,255,255,0.92);
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
    gap:14px;
}

.logo-icon{
    width:52px;
    height:52px;
    border-radius:18px;
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
    font-weight:700;
}

/* RIGHT NAV */

.nav-right{
    display:flex;
    align-items:center;
    gap:18px;
}

.notif-btn{
    width:50px;
    height:50px;
    border-radius:50%;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 8px 20px rgba(14,165,233,0.3);
}

.notif-btn:hover{
    transform:translateY(-3px);
}

.user-avatar{
    width:48px;
    height:48px;
    border-radius:50%;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
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

.sidebar-title{
    color:white;
    font-size:14px;
    opacity:0.6;
    margin-bottom:18px;
    letter-spacing:1px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:15px;
    color:#cbd5e1;
    text-decoration:none;
    padding:16px;
    margin-bottom:14px;
    border-radius:18px;
    transition:0.3s;
    font-weight:500;
}

.sidebar a:hover{
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    transform:translateX(6px);
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

/* ================= HERO ================= */

.hero{
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    border-radius:32px;
    padding:45px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    overflow:hidden;
    position:relative;
    box-shadow:0 20px 50px rgba(20,184,166,0.25);
}

.hero::before{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    background:rgba(255,255,255,0.1);
    border-radius:50%;
    top:-80px;
    right:-80px;
}

.hero h1{
    font-size:38px;
    margin-bottom:10px;
}

.hero p{
    font-size:15px;
    opacity:0.9;
    max-width:500px;
}

.hero-icon{
    font-size:110px;
    opacity:0.2;
}

/* ================= GRID ================= */

.dashboard-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
    margin-top:30px;
}

/* ================= CARD ================= */

.card{
    background:white;
    border-radius:28px;
    padding:28px;
    box-shadow:0 12px 35px rgba(0,0,0,0.06);
}

/* TITLE */

.section-title{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:25px;
}

.section-title i{
    width:48px;
    height:48px;
    border-radius:16px;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.section-title h3{
    color:#0f172a;
    font-size:22px;
}

/* PROFILE */

.profile-info{
    display:flex;
    flex-direction:column;
    gap:18px;
}

.profile-item{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
    border:1px solid #e2e8f0;
}

.profile-item span{
    display:block;
    color:#64748b;
    font-size:13px;
    margin-bottom:5px;
}

.profile-item b{
    color:#0f172a;
    font-size:15px;
}

/* EMERGENCY */

.emergency-section{
    text-align:center;
}

.emergency-circle{
    width:220px;
    height:220px;
    border-radius:50%;
    margin:auto;
    background:linear-gradient(135deg,#ef4444,#dc2626);
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:0.4s;
    box-shadow:
    0 0 0 18px rgba(239,68,68,0.12),
    0 20px 50px rgba(239,68,68,0.4);
    animation:pulse 2s infinite;
}

.emergency-circle:hover{
    transform:scale(1.08);
}

.emergency-circle i{
    font-size:70px;
    color:white;
}

.emergency-text{
    margin-top:25px;
}

.emergency-text h2{
    color:#dc2626;
    margin-bottom:10px;
}

.emergency-text p{
    color:#64748b;
    font-size:14px;
}

/* ANIMATION */

@keyframes pulse{

    0%{
        box-shadow:
        0 0 0 0 rgba(239,68,68,0.35),
        0 20px 50px rgba(239,68,68,0.4);
    }

    70%{
        box-shadow:
        0 0 0 30px rgba(239,68,68,0),
        0 20px 50px rgba(239,68,68,0.4);
    }

    100%{
        box-shadow:
        0 0 0 0 rgba(239,68,68,0),
        0 20px 50px rgba(239,68,68,0.4);
    }
}

/* QUICK STATS */

.stats{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
    margin-top:25px;
}

.stat-box{
    background:white;
    padding:22px;
    border-radius:22px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
    text-align:center;
}

.stat-icon{
    width:60px;
    height:60px;
    margin:auto;
    border-radius:18px;
    background:linear-gradient(135deg,#14b8a6,#0ea5e9);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    margin-bottom:15px;
}

.stat-box h2{
    color:#0f172a;
    margin-bottom:5px;
}

.stat-box p{
    color:#64748b;
    font-size:14px;
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
        color:#0f172a;
    }

    .dashboard-grid{
        grid-template-columns:1fr;
    }

    .hero{
        flex-direction:column;
        text-align:center;
        gap:20px;
    }

    .hero h1{
        font-size:30px;
    }
}

@media(max-width:600px){

    .navbar{
        padding:0 16px;
    }

    .main{
        padding:18px;
    }

    .hero{
        padding:35px 25px;
    }

    .hero h1{
        font-size:24px;
    }

    .card{
        padding:20px;
    }

    .emergency-circle{
        width:180px;
        height:180px;
    }

    .emergency-circle i{
        font-size:55px;
    }

    .stats{
        grid-template-columns:1fr;
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

        <div class="notif-btn">
            <i class="fa-solid fa-bell"></i>
        </div>

        <div class="user-avatar">
            <?php echo strtoupper(substr($name,0,1)); ?>
        </div>

    </div>

</div>

<!-- CONTAINER -->

<div class="container">

    <!-- SIDEBAR -->

    <div class="sidebar" id="sidebar">

        <div class="sidebar-title">
            MAIN MENU
        </div>

        <a href="#">
            <i class="fa-solid fa-house"></i>
            Home
        </a>

        <a href="#">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Emergency
        </a>

        <a href="#">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

        <a href="logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

    <!-- MAIN -->

    <div class="main">

        <!-- HERO -->

        <div class="hero">

            <div>

                <h1>
                    Welcome Back,
                    <?php echo $name; ?> 
                </h1>

                <p>
                    Your health and safety are our priority.
                    Easily access emergency help and manage
                    your personal information anytime.
                </p>

            </div>

            <div class="hero-icon">
                <i class="fa-solid fa-user-shield"></i>
            </div>

        </div>

        <!-- GRID -->

        <div class="dashboard-grid">

            <!-- LEFT -->

            <div>

                <!-- EMERGENCY -->

                <div class="card emergency-section">

                    <div class="section-title">

                        <i class="fa-solid fa-triangle-exclamation"></i>

                        <h3>Emergency Assistance</h3>

                    </div>

                    <div class="emergency-circle"
                    onclick="sendEmergency()">

                        <i class="fa-solid fa-siren-on"></i>

                    </div>

                    <div class="emergency-text">

                        <h2>SEND EMERGENCY ALERT</h2>

                        <p>
                            Press the button immediately if you
                            need urgent assistance.
                        </p>

                    </div>

                </div>

                <!-- STATS -->

                <div class="stats">

                    <div class="stat-box">

                        <div class="stat-icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>

                        <h2>24/7</h2>

                        <p>Medical Monitoring</p>

                    </div>

                    <div class="stat-box">

                        <div class="stat-icon">
                            <i class="fa-solid fa-user-nurse"></i>
                        </div>

                        <h2>Care</h2>

                        <p>Professional Support</p>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div>

                <div class="card">

                    <div class="section-title">

                        <i class="fa-solid fa-user"></i>

                        <h3>Profile Information</h3>

                    </div>

                    <div class="profile-info">

                        <div class="profile-item">

                            <span>FULL NAME</span>

                            <b>
                                <?php echo $name; ?>
                            </b>

                        </div>

                        <div class="profile-item">

                            <span>AGE</span>

                            <b>
                                <?php echo $profile['age'] ?? 'Not set'; ?>
                            </b>

                        </div>

                        <div class="profile-item">

                            <span>MEDICAL NOTES</span>

                            <b>
                                <?php echo $profile['medical_notes'] ?? 'No notes'; ?>
                            </b>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function toggleSidebar(){

    document.getElementById("sidebar")
    .classList.toggle("active");
}

function sendEmergency(){

    navigator.geolocation.getCurrentPosition(

        function(pos){

            let lat = pos.coords.latitude;
            let lng = pos.coords.longitude;

            window.location.href =
            "save_emergency.php?latitude="+lat+
            "&longitude="+lng;

        },

        function(){

            alert("Please enable location access");

        }

    );
}

</script>

</body>
</html>
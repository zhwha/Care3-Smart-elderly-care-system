 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Elderly Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f4fdfc;
    color:#1f3b3a;
}
/* NAVBAR WRAPPER */
.navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:1000;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:16px 60px;

    background:rgba(255,255,255,0.7);
    backdrop-filter:blur(18px);

    border-bottom:1px solid rgba(0,0,0,0.06);

    transition:0.3s;
}

/* LEFT SIDE */
.nav-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.nav-logo{
    width:46px;
    height:46px;
    border-radius:14px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white;
    font-size:20px;

    box-shadow:0 10px 25px rgba(20,184,166,0.25);
}

.nav-text h2{
    margin:0;
    font-size:18px;
    color:#0f766e;
    font-weight:700;
}

.nav-text span{
    font-size:12px;
    color:#6b7280;
}

/* RIGHT SIDE */
.nav-right{
    display:flex;
    align-items:center;
    gap:22px;
}

.nav-right a{
    text-decoration:none;
    color:#0f766e;
    font-weight:500;
    font-size:15px;
    position:relative;
    transition:0.3s;
}

/* hover underline effect */
.nav-right a:not(.nav-btn)::after{
    content:"";
    position:absolute;
    left:0;
    bottom:-5px;
    width:0%;
    height:2px;
    background:#14b8a6;
    transition:0.3s;
}

.nav-right a:not(.nav-btn):hover::after{
    width:100%;
}

.nav-right a:hover{
    color:#14b8a6;
}

/* BUTTON */
.nav-btn{
    display:flex;
    align-items:center;
    gap:8px;

    padding:10px 16px;
    border-radius:12px;

    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white !important;

    font-weight:600;

    box-shadow:0 10px 25px rgba(20,184,166,0.25);

    transition:0.3s;
}

.nav-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 15px 30px rgba(20,184,166,0.35);
}

/* RESPONSIVE */
@media(max-width:900px){

    .navbar{
        padding:14px 20px;
    }

    .nav-text span{
        display:none;
    }

    .nav-right a:not(.nav-btn){
        display:none;
    }
}
/* HERO */
.hero{
    margin-top:120px;
    padding:60px 10%;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:40px;
}

.hero-text{
    flex:1;
}

.hero-text h1{
    font-size:42px;
    color:#0f766e;
}

.hero-text p{
    margin-top:15px;
    font-size:16px;
    color:#555;
    line-height:1.7;
}

.hero-buttons{
    margin-top:25px;
}

.hero-buttons a{
    display:inline-block;
    margin-right:10px;
    padding:12px 20px;
    border-radius:12px;
    text-decoration:none;
    font-weight:500;
}

.primary{
    background:#14b8a6;
    color:white;
}

.secondary{
    background:#38bdf8;
    color:white;
}

/* HERO IMAGE BOX (فارغ) */
.hero-image{
    flex:1;
    height:380px;
    border-radius:24px;
    overflow:hidden;
    position:relative;

    background:linear-gradient(135deg, rgba(20,184,166,0.15), rgba(56,189,248,0.15));
    border:1px solid rgba(20,184,166,0.2);

    box-shadow:0 25px 60px rgba(0,0,0,0.12);

    display:flex;
    align-items:center;
    justify-content:center;
}

/* IMAGE INSIDE */
.hero-image img{
    width:100%;
    height:100%;
    object-fit:cover;

    transition:0.5s ease;
}

/* HOVER EFFECT */
.hero-image:hover img{
    transform:scale(1.05);
}

/* LIGHT OVERLAY FOR MODERN LOOK */
.hero-image::after{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(15,118,110,0.15),
        transparent
    );
    pointer-events:none;
}

/* RESPONSIVE */
@media(max-width:900px){
    .hero-image{
        height:280px;
    }
}

/* ABOUT */
.about{
    padding:80px 10%;
    display:flex;
    gap:40px;
    align-items:center;
}

.about-box{
    flex:1;
    height:290px;
    border-radius:24px;
    overflow:hidden;
    position:relative;

    background:linear-gradient(135deg, rgba(20,184,166,0.15), rgba(56,189,248,0.15));
    border:1px solid rgba(20,184,166,0.2);

    box-shadow:0 25px 60px rgba(0,0,0,0.12);

    display:flex;
    align-items:center;
    justify-content:center;
}
/* IMAGE INSIDE */
.about-box img{
    width:100%;
    height:100%;
    object-fit:cover;

    transition:0.5s ease;
}

/* HOVER EFFECT */
.about-box:hover img{
    transform:scale(1.05);
}

/* LIGHT OVERLAY FOR MODERN LOOK */
.about-box::after{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(15,118,110,0.15),
        transparent
    );
    pointer-events:none;
}

.about-text{
    flex:1;
}

.about-text h2{
    color:#0f766e;
    font-size:32px;
}

.about-text p{
    margin-top:15px;
    line-height:1.8;
    color:#555;
}

/* FEATURES */
/* FEATURES SECTION */
.features{
    padding:90px 10%;
    text-align:center;
    background:#f4fdfc;
}

/* TITLE */
.section-title{
    font-size:32px;
    color:#0f766e;
    font-weight:700;
}

.section-subtitle{
    margin-top:10px;
    color:#6b7280;
    font-size:15px;
}

/* GRID */
.features-grid{
    margin-top:40px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:25px;
}

/* CARD */
.feature-card{
    background:rgba(255,255,255,0.7);
    backdrop-filter:blur(15px);

    border:1px solid rgba(0,0,0,0.05);

    padding:25px;
    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,0.2);

    transition:0.3s;
    position:relative;
    overflow:hidden;
}

/* hover effect */
.feature-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

/* ICON */
.icon{
    width:60px;
    height:60px;
    margin:0 auto 15px;

    border-radius:18px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white;
    font-size:22px;

    box-shadow:0 10px 25px rgba(20,184,166,0.25);
}

/* TEXT */
.feature-card h3{
    color:#0f766e;
    margin-bottom:10px;
    font-size:18px;
}

.feature-card p{
    color:#6b7280;
    font-size:14px;
    line-height:1.6;
}
/* FOOTER */
footer{
    background:#0f766e;
    color:white;
    padding:40px 10%;
    margin-top:60px;
}

.footer-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
}

footer h3{
    margin-bottom:10px;
}

footer p, footer a{
    color:#d1fae5;
    font-size:14px;
    text-decoration:none;
    display:block;
    margin:5px 0;
}

/* RESPONSIVE */
@media(max-width:900px){

    .hero,
    .about{
        flex-direction:column;
        text-align:center;
    }

    .navbar{
        padding:15px 20px;
    }

}
</style>

</head>

<body>
<!-- NAVBAR -->
<nav class="navbar">

    <div class="nav-left">

        <div class="nav-logo">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>

        <div class="nav-text">
            <h2>Elderly Care</h2>
            <span>Healthcare & Safety Platform</span>
        </div>

    </div>

    <div class="nav-right">

        <a href="index.php">Home</a>
        <a href="#services">Services</a>
        <a href="#about">About</a>

        <a href="register.php" class="nav-btn">
            <i class="fa-solid fa-user-plus"></i>
            Register
        </a>

    </div>

</nav>

<!-- HERO -->
<section class="hero">

    <div class="hero-text">
        <h1>Smart Care for Elderly People</h1>
        <p>
            A modern platform that connects families, elderly people and nurses
            to ensure safety, health monitoring and instant emergency alerts.
        </p>

        <div class="hero-buttons">
            <a href="login.php" class="primary">Login</a>
            <a href="register.php" class="secondary">Create Account</a>
        </div>
    </div>

  <div class="hero-image">
    <img src="elderly-care.png" alt="Elderly Care System">
</div>

</section>

<!-- ABOUT -->
<section class="about" id="about">

    <div class="about-box">
         <img src="about-section.png" alt="">
    </div>

    <div class="about-text">
        <h2>About Our Platform</h2>
        <p>
            We provide a smart healthcare system designed to support elderly people
            with emergency alerts, medication tracking, nurse requests and family monitoring.
            Our goal is to make life safer, easier and more connected.
        </p>
    </div>

</section>
<!-- FEATURES -->
<section class="features" id="services">

    <h2 class="section-title">Our Features</h2>
    <p class="section-subtitle">
        Everything you need to ensure safety, care, and connection in one smart platform.
    </p>

    <div class="features-grid">

        <div class="feature-card">
            <div class="icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3>Emergency Alerts</h3>
            <p>Instant alerts sent to family members when help is needed.</p>
        </div>

        <div class="feature-card">
            <div class="icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <h3>Live Tracking</h3>
            <p>Track elderly location in real-time for maximum safety.</p>
        </div>

        <div class="feature-card">
            <div class="icon">
                <i class="fa-solid fa-pills"></i>
            </div>
            <h3>Medication System</h3>
            <p>Manage and remind medications on time easily.</p>
        </div>

        <div class="feature-card">
            <div class="icon">
                <i class="fa-solid fa-user-nurse"></i>
            </div>
            <h3>Nurse Requests</h3>
            <p>Request professional nurses anytime with one click.</p>
        </div>

    </div>

</section>
<!-- FOOTER -->
<footer>

    <div class="footer-grid">

        <div>
            <h3>Elderly Care</h3>
            <p>Smart healthcare platform for elderly safety and monitoring.</p>
        </div>

        <div>
            <h3>Links</h3>
            <a href="index.php">Home</a>
            <a href="#about">About</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>

        <div>
            <h3>Contact</h3>
            <p>Email: support@elderlycare.com</p>
            <p>Phone: +968 XXX XXX XXX</p>
        </div>

    </div>

    <p style="text-align:center;margin-top:30px;color:#a7f3d0;">
        © 2026 Elderly Care System
    </p>

</footer>

</body>
</html>
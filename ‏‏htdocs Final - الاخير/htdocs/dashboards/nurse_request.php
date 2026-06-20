<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Request Nurse</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    min-height:100vh;
    background:#ffffff;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:30px;
    overflow-x:hidden;
    position:relative;
}

/* BACKGROUND SHAPES */
.circle{
    position:absolute;
    border-radius:50%;
    z-index:1;
}

.circle1{
    width:320px;
    height:320px;
    background:rgba(20,184,166,0.08);
    top:-120px;
    left:-100px;
}

.circle2{
    width:360px;
    height:360px;
    background:rgba(56,189,248,0.08);
    bottom:-150px;
    right:-120px;
}

/* CARD */
.form-box{
    width:100%;
    max-width:520px;
    background:white;
    border:1px solid #e5e7eb;
    padding:42px;
    border-radius:30px;
    box-shadow:0 20px 50px rgba(0,0,0,0.08);
    position:relative;
    z-index:10;
}

/* HEADER */
.form-header{
    text-align:center;
    margin-bottom:30px;
}

.form-icon{
    width:85px;
    height:85px;
    margin:auto;
    margin-bottom:20px;
    border-radius:24px;
    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:34px;
    box-shadow:0 15px 35px rgba(20,184,166,0.25);
}

.form-header h2{
    color:#0f172a;
    font-size:34px;
    margin-bottom:10px;
}

.form-header p{
    color:#64748b;
    font-size:14px;
    line-height:1.7;
}

/* INPUT GROUP */
.form-group{
    margin-bottom:18px;
}

.input-box{
    position:relative;
}

/* INPUTS */
.input-box input,
.input-box textarea{
    width:100%;
    padding:15px 18px 15px 50px;
    border:2px solid #e5e7eb;
    border-radius:16px;
    background:#f8fafc;
    font-size:15px;
    outline:none;
    transition:0.3s;
}

/* TEXTAREA FIX (no icon padding needed) */
.input-box textarea{
    padding-left:18px;
    min-height:120px;
    resize:none;
}

/* ICON */
.input-box i{
    position:absolute;
    left:18px;
    top:18px;
    color:#14b8a6;
    font-size:16px;
}

/* FOCUS */
.input-box input:focus,
.input-box textarea:focus{
    border-color:#14b8a6;
    background:white;
    box-shadow:0 0 0 4px rgba(20,184,166,0.1);
}

/* BUTTON */
.save-btn{
    width:100%;
    border:none;
    padding:16px;
    border-radius:18px;
    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
    margin-top:10px;
    box-shadow:0 15px 30px rgba(20,184,166,0.25);
}

.save-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 20px 40px rgba(20,184,166,0.35);
}

/* RESPONSIVE */
@media(max-width:600px){
    body{padding:20px;}

    .form-box{
        padding:30px 22px;
        border-radius:24px;
    }

    .form-header h2{
        font-size:28px;
    }

    .form-icon{
        width:72px;
        height:72px;
        font-size:28px;
    }
}

</style>
</head>

<body>

<div class="circle circle1"></div>
<div class="circle circle2"></div>

<div class="form-box">

    <div class="form-header">

        <div class="form-icon">
            <i class="fa-solid fa-user-nurse"></i>
        </div>

        <h2>Request Nurse</h2>

        <p>
            Book a professional nurse for elderly care, home assistance, and medical support.
        </p>

    </div>

    <form action="save_nurse_request.php" method="POST">

        <div class="form-group">
            <div class="input-box">
                <i class="fa-regular fa-calendar"></i>
                <input type="date" name="date" required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <i class="fa-regular fa-clock"></i>
                <input type="text" name="time" placeholder="Time (e.g. 9:00 AM)" required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <i class="fa-solid fa-hourglass-half"></i>
                <input type="text" name="duration" placeholder="Duration (e.g. 2 hours)" required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
               
                <textarea name="notes" placeholder="Additional Notes (optional)"></textarea>
            </div>
        </div>

        <button type="submit" class="save-btn">
            <i class="fa-solid fa-paper-plane"></i>
            Send Request
        </button>

    </form>

</div>

</body>
</html>
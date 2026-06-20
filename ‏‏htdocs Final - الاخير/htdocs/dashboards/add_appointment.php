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

<title>Add Appointment</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- FONT AWESOME -->
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
    width:300px;
    height:300px;

    background:rgba(20,184,166,0.08);

    top:-120px;
    left:-100px;
}

.circle2{
    width:350px;
    height:350px;

    background:rgba(56,189,248,0.08);

    bottom:-150px;
    right:-120px;
}

/* FORM CARD */
.form-box{
    width:100%;
    max-width:520px;

    background:white;

    border:1px solid #e5e7eb;

    padding:42px;

    border-radius:30px;

    box-shadow:
    0 20px 50px rgba(0,0,0,0.08);

    position:relative;
    z-index:10;
}

/* HEADER */
.form-header{
    text-align:center;
    margin-bottom:30px;
}

/* ICON */
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

/* TITLE */
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

/* FORM GROUP */
.form-group{
    margin-bottom:20px;
}

/* INPUT BOX */
.input-box{
    position:relative;
}

/* ICONS */
.input-box i{
    position:absolute;
    left:18px;
    top:18px;

    color:#14b8a6;
    font-size:16px;
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

/* TEXTAREA */
.input-box textarea{
    min-height:120px;
    resize:none;
}

/* FOCUS */
.input-box input:focus,
.input-box textarea:focus{

    border-color:#14b8a6;
    background:white;

    box-shadow:
    0 0 0 4px rgba(20,184,166,0.1);
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

/* BUTTON HOVER */
.save-btn:hover{

    transform:translateY(-3px);

    box-shadow:0 20px 40px rgba(20,184,166,0.35);
}

/* RESPONSIVE */
@media(max-width:600px){

    body{
        padding:20px;
    }

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

<!-- BACKGROUND -->
<div class="circle circle1"></div>
<div class="circle circle2"></div>

<!-- FORM -->
<div class="form-box">

    <div class="form-header">

        <div class="form-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>

        <h2>Add Appointment</h2>

       

    </div>

    <form action="save_appointment.php" method="POST">

        <!-- DOCTOR NAME -->
        <div class="form-group">

            <div class="input-box">

                <i class="fa-solid fa-user-doctor"></i>

                <input
                    type="text"
                    name="doctor_name"
                    placeholder="Doctor Name"
                    required
                >

            </div>

        </div>

        <!-- DATE -->
        <div class="form-group">

            <div class="input-box">

                <i class="fa-regular fa-calendar"></i>

                <input
                    type="date"
                    name="date"
                    required
                >

            </div>

        </div>

        <!-- TIME -->
        <div class="form-group">

            <div class="input-box">

                <i class="fa-regular fa-clock"></i>

                <input
                    type="text"
                    name="time"
                    placeholder="Time (e.g. 10:30 AM)"
                    required
                >

            </div>

        </div>

        <!-- NOTES -->
        <div class="form-group">

            <div class="input-box">

                <i class="fa-regular fa-note-sticky"></i>

                <textarea
                    name="notes"
                    placeholder="Additional Notes"
                ></textarea>

            </div>

        </div>

        <!-- BUTTON -->
        <button type="submit" class="save-btn">

            <i class="fa-solid fa-floppy-disk"></i>
            Save Appointment

        </button>

    </form>

</div>

</body>
</html>
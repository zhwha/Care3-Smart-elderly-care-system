<?php
 error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
date_default_timezone_set('Asia/Muscat');
include "config/db.php";
 
$error = "";

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $client_time = $_POST['client_time'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            
      
          $current_time = date('Y-m-d H:i:s');
mysqli_query($conn, "UPDATE users SET last_login = '$current_time' WHERE id = '" . $user['id'] . "'");

    
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            // Redirect حسب role
            if ($user['role'] == "elderly") {
                header("Location: dashboards/elderly.php");
                exit();
                

            }

            if ($user['role'] == "family") {
                header("Location: dashboards/family.php");
                exit();
            }

            if ($user['role'] == "nurse") {
                header("Location: dashboards/nurse.php");
                exit();
            }
 

        } else {
            $error = "Wrong password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - Elderly Care</title>

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
    display:flex;
    align-items:center;
    justify-content:center;
    background:
    linear-gradient(rgba(15,118,110,0.8),rgba(56,189,248,0.8));
    
    background-size:cover;
    background-position:center;
    overflow:hidden;
}

/* BLUR CIRCLES */
.circle{
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(10px);
}

.circle1{
    width:220px;
    height:120px;
    top:-70px;
    left:-70px;
}

.circle2{
    width:220px;
    height:120px;
    bottom:-100px;
    right:-100px;
}

/* MAIN CONTAINER */
.login-wrapper{
    width:80%;
    max-width:1000px;
    min-height:400px;
    display:flex;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.2);
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,0.25);
}

/* LEFT SIDE */
.left-side{
    flex:1;
    padding:50px;
    color:white;
    display:flex;
    flex-direction:column;
    justify-content:center;
    position:relative;
}


.left-side h2{
    font-size:35px;
    line-height:1.2;
    margin-bottom:20px;
}

.left-side p{
    font-size:15px;
    line-height:1.8;
    max-width:500px;
    opacity:0.95;
}

/* FEATURES */
.features{
    margin-top:35px;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
}

.feature{
    background:white;
    padding:18px;
    border: 2px solid rgba(15,118,110,0.8);
    border-radius:18px;
    display:flex;
    color:rgba(15,118,110,0.8);
    align-items:center;
    gap:15px;
    font-weight: 500;
}

.feature i{
    font-size:23px;
}

/* RIGHT SIDE */
.right-side{
    width:460px;
    background:white;
    padding:55px 45px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.login-title{
    margin-bottom:35px;
}

.login-title h2{
    color:#0f766e;
    font-size:34px;
    margin-bottom:10px;
}

.login-title p{
    color:#777;
    font-size:15px;
}

/* FORM */
.form-group{
    margin-bottom:20px;
}

.input-box{
    position:relative;
}

.input-box i{
    position:absolute;
    left:18px;
    top:50%;
    transform:translateY(-50%);
    color:#14b8a6;
    font-size:16px;
}

.input-box input{
    width:100%;
    padding:15px 18px 15px 50px;
    border-radius:14px;
    border:2px solid #e5e7eb;
    font-size:15px;
    outline:none;
    transition:0.3s;
    background:#f9fafb;
}

.input-box input:focus{
    border-color:#14b8a6;
    background:white;
    box-shadow:0 0 0 4px rgba(20,184,166,0.12);
}

/* BUTTON */
.login-btn{
    width:100%;
    border:none;
    padding:16px;
    border-radius:16px;
    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 10px 25px rgba(20,184,166,0.25);
}

.login-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 30px rgba(20,184,166,0.35);
}

/* ERROR */
.error-box{
    background:#fff1f2;
    color:#dc2626;
    padding:14px;
    border-radius:12px;
    margin-bottom:20px;
    font-size:14px;
    border-left:5px solid #dc2626;
}

/* LINKS */
.bottom-links{
    margin-top:25px;
    text-align:center;
    font-size:14px;
    color:#666;
}

.bottom-links a{
    color:#14b8a6;
    text-decoration:none;
    font-weight:600;
}

/* RESPONSIVE */
@media(max-width:950px){

    .login-wrapper{
        flex-direction:column;
        width:92%;
        margin:20px;
    }

    .right-side{
        width:100%;
    }

    .left-side{
        padding:40px 30px;
    }

    .left-side h2{
        font-size:38px;
    }

    .features{
        grid-template-columns:1fr;
    }
}

@media(max-width:600px){

    .left-side h2{
        font-size:30px;
    }

    .right-side{
        padding:35px 25px;
    }

    .login-title h2{
        font-size:28px;
    }

    .logo h1{
        font-size:24px;
    }
}

 
</style>
</head>

<body>
 
<div class="circle circle1"></div>
<div class="circle circle2"></div>

<div class="login-wrapper">
    <!-- LEFT -->
    <div class="left-side">

        

        <h2>Care, Safety & Comfort For Every Elderly Person</h2>

        <p>
            A modern healthcare platform that connects elderly people,
            families, and nurses in one secure and smart environment.
        </p>

        <div class="features">

            <div class="feature">
                <i class="fa-solid fa-user-nurse"></i>
                <span>Professional Nurses</span>
            </div>

            <div class="feature">
                <i class="fa-solid fa-bell"></i>
                <span>Smart Notifications</span>
            </div>

            <div class="feature">
                <i class="fa-solid fa-pills"></i>
                <span>Medication Tracking</span>
            </div>

            <div class="feature">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Emergency System</span>
            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="right-side">

        <div class="login-title">
            <h2>Welcome Back </h2>
            <p>Login to continue to your dashboard</p>
        </div>

        <?php if($error != ""){ ?>

            <div class="error-box">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?php echo $error; ?>
            </div>

        <?php } ?>

        <form action="login.php" method="POST">
        <input type="hidden" name="client_time" id="client_time">
            <!-- EMAIL -->
            <div class="form-group">

                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >
                </div>

            </div>

            <!-- PASSWORD -->
            <div class="form-group">

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>

            </div>

            <!-- BUTTON -->
            <button type="submit" class="login-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login
            </button>

        </form>

        <div class="bottom-links">
            Don't have an account?
            <a href="register.php">Create Account</a>
        </div>

    </div>

</div>
    
<script>
window.onload = function () {

    const now = new Date();

    const year = now.getFullYear();
    const month = String(now.getMonth()+1).padStart(2,'0');
    const day = String(now.getDate()).padStart(2,'0');

    const hours = String(now.getHours()).padStart(2,'0');
    const minutes = String(now.getMinutes()).padStart(2,'0');
    const seconds = String(now.getSeconds()).padStart(2,'0');

    const formatted = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

    document.getElementById("client_time").value = formatted;
};
</script>
    
</body>
</html>
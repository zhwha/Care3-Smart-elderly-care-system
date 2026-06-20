<?php
session_start();
include "../config/db.php";

$error = "";
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    position:relative;
    overflow:hidden;
}

 
body::before,
body::after{
    content:"";
    position:absolute;
    width:300px;
    height:300px;
    border-radius:50%;
    filter:blur(80px);
    opacity:0.4;
}

body::before{
    background:#ffffff;
    top:-100px;
    left:-100px;
}

body::after{
    background:#0f766e;
    bottom:-120px;
    right:-120px;
}

/* LOGIN BOX */
.box{
    width:100%;
    max-width:360px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.3);
    padding:35px;
    border-radius:20px;
    box-shadow:0 25px 60px rgba(0,0,0,0.2);
    text-align:center;
    position:relative;
    z-index:10;
}

/* TITLE */
.box h2{
    color:white;
    margin-bottom:20px;
    font-size:24px;
    font-weight:600;
}

/* INPUTS */
input{
    width:100%;
    padding:12px 14px;
    margin:10px 0;
    border:none;
    border-radius:12px;
    outline:none;
    font-size:14px;
    background:rgba(255,255,255,0.9);
    transition:0.3s;
}

input:focus{
    transform:scale(1.02);
    box-shadow:0 0 0 3px rgba(255,255,255,0.3);
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#0f766e,#14b8a6);
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
    font-size:15px;
}

button:hover{
    transform:translateY(-2px);
    box-shadow:0 15px 30px rgba(0,0,0,0.2);
}

/* ERROR */
p{
    margin-top:12px;
    font-size:13px;
}

/* MOBILE */
@media(max-width:500px){
    .box{
        margin:20px;
        padding:25px;
    }
}
</style>

</head>

<body>

<div class="box">


<h2>Admin Login</h2>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<?php

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins 
            WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    if($admin){

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];

        header("Location: admin_dashboard.php");
        exit();

    } else {
        echo "<p style='color:red'>Invalid login</p>";
    }
}
?>

</div>

</body>
</html>
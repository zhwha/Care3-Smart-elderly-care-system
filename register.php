<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // إدخال المستخدم الأساسي
    $sql = "INSERT INTO users (name, email, password, phone, role)
            VALUES ('$name', '$email', '$password', '$phone', '$role')";

    if (mysqli_query($conn, $sql)) {

        $user_id = mysqli_insert_id($conn);

        /* =========================
           ELDERLY ACCOUNT
        ========================== */
        if ($role == "elderly") {

            $age = $_POST['age'];
            $emergency_contact = $_POST['emergency_contact'];
            $medical_notes = $_POST['medical_notes'];

            $sql2 = "INSERT INTO elderly_profiles (user_id, age, emergency_contact, medical_notes)
                     VALUES ('$user_id', '$age', '$emergency_contact', '$medical_notes')";

            mysqli_query($conn, $sql2);
        }

        /* =========================
           FAMILY ACCOUNT (IMPORTANT FIX)
        ========================== */
        if ($role == "family") {

            $relation = $_POST['relation'];
            $elderly_email = $_POST['elderly_email'];

            // جلب ID الخاص بكبير السن من الإيميل
            $get_elderly = mysqli_query($conn, "
                SELECT id 
                FROM users 
                WHERE email = '$elderly_email' 
                AND role = 'elderly'
                LIMIT 1
            ");

            if (mysqli_num_rows($get_elderly) > 0) {

                $elderly = mysqli_fetch_assoc($get_elderly);
                $elderly_id = $elderly['id'];

                // إنشاء الربط داخل family_links
                $sql_link = "INSERT INTO family_links (elderly_id, family_id, relation)
                             VALUES ('$elderly_id', '$user_id', '$relation')";

                mysqli_query($conn, $sql_link);

            } else {
                echo "<script>alert('Elderly not found with this email');</script>";
                exit();
            }
        }

        /* =========================
           NURSE ACCOUNT (optional future use)
        ========================== */
        if ($role == "nurse") {
            $experience = $_POST['experience'];

            // يمكنك لاحقًا إنشاء جدول nurse_profiles إذا أردت
        }

        echo "Account created successfully!";
        header("Location: login.php");
        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register - Elderly Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    background:
    linear-gradient(rgba(15,118,110,0.75),rgba(56,189,248,0.75));
    
    background-size:cover;
    background-position:center;
}

 
/* WRAPPER */
.page{
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:100vh;
    padding:100px 20px 40px;
}

/* FORM CARD */
.container-form{
    margin-top: 0;
    width:90%;
    max-width:520px;
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:30px 30px;
    box-shadow:0 20px 60px rgba(0,0,0,0.25);
    animation:fadeIn 0.5s ease;
}

@keyframes fadeIn{
    from{transform:translateY(20px);opacity:0;}
    to{transform:translateY(0);opacity:1;}
}

h2{
    text-align:center;
    color:#0f766e;
    margin-bottom:20px;
}

/* INPUTS */
input, select, textarea{
    width:100%;
    padding:14px;
    margin:10px 0;
    border-radius:14px;
    border:2px solid #e5e7eb;
    outline:none;
    transition:0.3s;
    font-size:14px;
    background:#f9fafb;
}

input:focus, select:focus, textarea:focus{
    border-color:#14b8a6;
    background:white;
    box-shadow:0 0 0 4px rgba(20,184,166,0.15);
}

/* BUTTON */
button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:16px;
    background:linear-gradient(135deg,#14b8a6,#38bdf8);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
    transition:0.3s;
}

button:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 30px rgba(20,184,166,0.35);
}

/* SECTIONS */
.hidden{display:none;}

/* RESPONSIVE */
@media(max-width:600px){
    .container-form{
        padding:25px 18px;
        border-radius:18px;
    }

    
}
 
</style>
</head>

<body>

 

<!-- PAGE -->
<div class="page">

<div class="container-form">

    <h2>Create Account</h2>

    <form action="register.php" method="POST">

        <label>Account Type</label>
        <select name="role" id="role" onchange="showFields()">
            <option value="">Select Role</option>
            <option value="elderly">Elderly</option>
            <option value="family">Family Member</option>
            <option value="nurse">Nurse</option>
        </select>

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone Number">

        <div id="elderlyFields" class="hidden">
            <input type="number" name="age" placeholder="Age">
            <input type="text" name="emergency_contact" placeholder="Emergency Contact">
            <textarea name="medical_notes" placeholder="Medical Notes"></textarea>
        </div>

        <div id="familyFields" class="hidden">
            <input type="text" name="relation" placeholder="Relation">
            <input type="email" name="elderly_email" placeholder="Elderly Email">
        </div>

        <div id="nurseFields" class="hidden">
            <input type="text" name="experience" placeholder="Experience (years)">
        </div>

        <button type="submit">Create Account</button>

    </form>

</div>

</div>

<script>
function showFields() {

    let role = document.getElementById("role").value;

    document.getElementById("elderlyFields").classList.add("hidden");
    document.getElementById("familyFields").classList.add("hidden");
    document.getElementById("nurseFields").classList.add("hidden");

    if(role === "elderly"){
        document.getElementById("elderlyFields").classList.remove("hidden");
    }

    if(role === "family"){
        document.getElementById("familyFields").classList.remove("hidden");
    }

    if(role === "nurse"){
        document.getElementById("nurseFields").classList.remove("hidden");
    }
}
</script>

</body>
</html>
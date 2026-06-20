<?php
session_start();
include "../config/db.php";

/* حماية الأدمن */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

$sql = "SELECT * FROM admins WHERE id='$admin_id'";
$result = mysqli_query($conn,$sql);
$admin = mysqli_fetch_assoc($result);

if(!$admin){
    die("Access denied");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root{
    --primary:#14b8a6;
    --primary-dark:#0f766e;
    --bg:#f6f8fb;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --shadow:0 10px 30px rgba(0,0,0,0.08);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:var(--bg);
    color:var(--text);
}

/* ===== NAVBAR ===== */
.navbar{
    background:linear-gradient(135deg,var(--primary),#38bdf8);
    color:white;
    padding:14px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1000;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
}

.navbar .logo{
    font-weight:600;
    font-size:16px;
    letter-spacing:0.5px;
}

.navbar input{
    padding:9px 12px;
    border:none;
    border-radius:10px;
    width:220px;
    outline:none;
    background:rgba(255,255,255,0.9);
}

.navbar div{
    font-size:18px;
}

/* ===== SIDEBAR ===== */
.sidebar{
    position:fixed;
    top:60px;
    left:0;
    width:240px;
    height:100%;
    background:#0f172a;
    padding-top:20px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    color:#cbd5e1;
    padding:12px 18px;
    text-decoration:none;
    transition:0.3s;
    font-size:14px;
}

.sidebar a:hover{
    background:rgba(20,184,166,0.15);
    color:white;
    border-left:4px solid var(--primary);
}

/* ===== MAIN ===== */
.main{
    margin-left:240px;
    margin-top:80px;
    padding:25px;
}

/* ===== CARDS ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:18px;
    margin-bottom:25px;
}

.card{
    background:var(--card);
    padding:22px;
    border-radius:18px;
    box-shadow:var(--shadow);
    text-align:center;
    transition:0.3s;
    position:relative;
    overflow:hidden;
}

.card::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:5px;
    background:linear-gradient(90deg,var(--primary),#38bdf8);
}

.card:hover{
    transform:translateY(-5px);
}

.card i{
    font-size:28px;
    color:var(--primary);
    margin-bottom:10px;
}

.card h2{
    font-size:28px;
    margin:5px 0;
}

.card p{
    color:var(--muted);
    font-size:13px;
}

/* ===== SECTIONS ===== */
.section{
    margin-top:20px;
    background:var(--card);
    padding:20px;
    border-radius:18px;
    box-shadow:var(--shadow);
}

.section h3{
    margin-bottom:15px;
    color:var(--primary-dark);
    font-size:16px;
}

/* TEXT LISTS */
.section p{
    padding:10px 0;
    border-bottom:1px solid #f1f5f9;
    font-size:14px;
}

.section p:last-child{
    border-bottom:none;
}

/* ===== TABLE ===== */
table{
    width:100%;
    border-collapse:collapse;
    border-radius:12px;
    overflow:hidden;
}

thead{
    background:linear-gradient(135deg,var(--primary),#38bdf8);
    color:white;
}

th,td{
    padding:12px;
    text-align:left;
    font-size:14px;
}

tbody tr{
    border-bottom:1px solid #f1f5f9;
    transition:0.2s;
}

tbody tr:hover{
    background:#f8fafc;
}

/* ROLE BADGES */
td span{
    font-size:12px;
    padding:5px 10px;
    border-radius:8px;
    display:inline-block;
}

/* DELETE BUTTON */
a{
    transition:0.3s;
}

a:hover{
    opacity:0.8;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    .sidebar{
        width:200px;
    }

    .main{
        margin-left:200px;
    }

    .navbar input{
        width:140px;
    }
}

@media(max-width:600px){
    .sidebar{
        position:relative;
        width:100%;
        height:auto;
    }

    .main{
        margin-left:0;
    }

    .navbar{
        flex-wrap:wrap;
        gap:10px;
    }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">

    <div class="logo">
       <i class="fa-solid fa-crown"></i> Admin Panel
    </div>

    <input type="text" placeholder="Search...">

  <div>
    <i class="fa-solid fa-bell"></i>
</div>

</div>

<!-- SIDEBAR -->
<div class="sidebar">

   <a href="#"><i class="fa-solid fa-house"></i> Home</a>
<a href="#"><i class="fa-solid fa-users"></i> Users</a>
<a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Emergencies</a>
<a href="#"><i class="fa-solid fa-user-nurse"></i> Nurses</a>
<a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
<a href="admin_logout.php">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
</a>
</div>

<!-- MAIN -->
<div class="main">

<!-- STATS -->
<div class="cards">

<?php
$users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as c FROM users"))['c'];
$emergency = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as c FROM emergency_alerts"))['c'];
$nurses = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as c FROM nurse_requests"))['c'];
?>

<div class="card">
    <i class="fa-solid fa-users"></i>
    <h2><?php echo $users; ?></h2>
    <p>Users</p>
</div>

<div class="card">
    <i class="fa-solid fa-bell"></i>
    <h2><?php echo $emergency; ?></h2>
    <p>Emergencies</p>
</div>

<div class="card">
    <i class="fa-solid fa-user-nurse"></i>
    <h2><?php echo $nurses; ?></h2>
    <p>Nurse Requests</p>
</div>

</div>

<!-- EMERGENCIES -->
<div class="section">
<h3>🚨 Emergency Alerts</h3>

<?php
$sql = "SELECT e.*, u.name 
        FROM emergency_alerts e
        JOIN users u ON e.user_id=u.id
        ORDER BY e.id DESC";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
?>
<p>
<b><?php echo $row['name']; ?></b> - 
<?php echo $row['message']; ?>
</p>
<?php } ?>

</div>

<!-- NURSE REQUESTS -->
<div class="section">
<h3>👩‍⚕️ Nurse Requests</h3>

<?php
$sql = "SELECT n.*, u.name 
        FROM nurse_requests n
        JOIN users u ON n.user_id=u.id
        ORDER BY n.id DESC";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
?>
<p>
<b><?php echo $row['name']; ?></b> - 
<?php echo $row['status']; ?>
</p>
<?php } ?>

</div>




<div class="section">
<h3>👥 Users Management</h3>

<table style="width:100%; border-collapse:collapse; background:white; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.05);">

<thead style="background:#14b8a6; color:white;">
<tr>
    <th style="padding:10px;">ID</th>
    <th style="padding:10px;">Name</th>
    <th style="padding:10px;">Email</th>
    <th style="padding:10px;">Type</th>
    <th style="padding:10px;">Action</th>
</tr>
</thead>

<tbody>

<?php
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){

    // ألوان حسب النوع
    $color = "";

    if($row['role'] == "elderly"){
        $color = "#3b82f6";
    } elseif($row['role'] == "family"){
        $color = "#f59e0b";
    } elseif($row['role'] == "nurse"){
        $color = "#10b981";
    } else {
        $color = "#999";
    }
?>
<tr>

    <td style="padding:10px;"><?php echo $row['id']; ?></td>
    <td style="padding:10px;"><?php echo $row['name']; ?></td>
    <td style="padding:10px;"><?php echo $row['email']; ?></td>

    <td style="padding:10px;">
        <span style="
            background:<?php echo $color; ?>;
            color:white;
            padding:5px 10px;
            border-radius:8px;
            font-size:12px;
        ">
            <?php echo $row['role']; ?>
        </span>
    </td>

    <td style="padding:10px;">
        <a href="delete_user.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure?')"
           style="
           background:#ef4444;
           color:white;
           padding:6px 10px;
           border-radius:6px;
           text-decoration:none;
           ">
           🗑 Delete
        </a>
    </td>

</tr>
<?php } ?>

</tbody>
</table>

</div>
</div>

</body>
</html>
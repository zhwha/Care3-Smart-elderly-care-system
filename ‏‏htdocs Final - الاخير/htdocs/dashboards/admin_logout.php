<?php
session_start();

/* حذف جلسة الأدمن فقط */
unset($_SESSION['admin_id']);
unset($_SESSION['admin_name']);

session_destroy();

/* الرجوع لتسجيل دخول الأدمن */
header("Location: admin_login.php");
exit();
?>
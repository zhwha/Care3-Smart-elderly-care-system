<?php
session_start();

/* حذف كل بيانات الجلسة */
session_unset();
session_destroy();

/* الرجوع لصفحة تسجيل الدخول (عدلي حسب مشروعك) */
header("Location: ../login.php");
exit();
?>
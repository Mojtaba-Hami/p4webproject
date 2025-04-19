<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'gamenet';

// ایجاد اتصال
$conn = new mysqli($host, $user, $pass, $dbname);

// بررسی خطا
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// تنظیم کدگذاری
$conn->set_charset("utf8");
?>
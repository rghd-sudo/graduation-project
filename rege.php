<?php
include 'phpdb.php'; // استدعاء ملف الاتصال

// نجيب البيانات من الفورم
$username = $_POST['username'];
$password = $_POST['password'];

// نخزنها في الجدول
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "✅ تم التسجيل بنجاح";
} else {
    echo "❌ خطأ: " . $conn->error;
}

$conn->close();
?>
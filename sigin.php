<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username_db = "root"; // غالباً root
$password_db = "";     // غالباً فاضي في XAMPP
$dbname = "ather_graduate"; // غيريها حسب اسم قاعدتك

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// فحص الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استلام البيانات من الفورم
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// إدخال البيانات في الجدول
$sql = "INSERT INTO users (username, email, password) 
        VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "✅ تم التسجيل بنجاح";
} else {
    echo "❌ خطأ: " . $conn->error;
}

$conn->close();
?>
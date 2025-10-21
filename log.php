<?php
include 'phpdb.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "🎉 أهلاً $username، سجلت دخول بنجاح!";
} else {
    echo "❌ اسم المستخدم أو كلمة المرور غير صحيحة";
}
$conn->close();
?>
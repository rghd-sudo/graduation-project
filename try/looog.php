<?php
session_start();
include 'try.php'; // ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role  = $_POST['role'];

    // 1. إضافة المستخدم في جدول users
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        // 2. إذا كان دكتور → نحفظ بياناته في جدول doctors
        if ($role === 'doctor') {
            $university = $_POST['university'];
            $specialization = $_POST['specialization'];

            $stmt2 = $conn->prepare("INSERT INTO doctors (user_id, university, specialization) VALUES (?, ?, ?)");
            $stmt2->bind_param("iss", $user_id, $university, $specialization);
            $stmt2->execute();
        }

        // 3. إذا كان خريج → نحفظ بياناته في جدول graduates
        if ($role === 'graduate') {
            $graduation_year = $_POST['graduation_year'];
            $major = $_POST['major'];

            $stmt3 = $conn->prepare("INSERT INTO graduates (user_id, graduation_year, major) VALUES (?, ?, ?)");
            $stmt3->bind_param("iss", $user_id, $graduation_year, $major);
            $stmt3->execute();
        }

        // حفظ الجلسة وتوجيه المستخدم لصفحة البروفايل
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;

        if ($role === 'doctor') {
            header("Location: doctor_profile.php");
        } else {
            header("Location: graduate_profile.php");
        }
        exit;
    } else {
        echo "خطأ: " . $stmt->error;
    }
}
?>
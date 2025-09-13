<?php
/*
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ather_graduate";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";*/

$conn = new mysqli("localhost", "username", "password", "dbname");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
echo "قاعدة البيانات شغالة ✔";
?>
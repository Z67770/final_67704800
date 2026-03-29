<?php
$host = "db"; // ชื่อ service ใน docker-compose
$dbname = "final_db_41970389"; // <--- ต้องตรงกับใน docker-compose
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // ตั้งค่าให้แจ้งเตือน Error ออกมาให้เห็น
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}
?>
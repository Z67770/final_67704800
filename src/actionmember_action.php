<?php
require_once '../config/db.php';
header('Content-Type: application/json'); // บอกหน้าเว็บว่าจะตอบกลับเป็น JSON

$action = $_POST['action'] ?? '';

// 1. ดึงข้อมูลทั้งหมดไปแสดงในตาราง
if ($action == 'fetch') {
    $stmt = $conn->prepare("SELECT * FROM members ORDER BY id DESC");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// 2. เพิ่มข้อมูลใหม่
if ($action == 'add') {
    $stmt = $conn->prepare("INSERT INTO members (member_id, fullname, faculty) VALUES (?, ?, ?)");
    $res = $stmt->execute([$_POST['member_id'], $_POST['fullname'], $_POST['faculty']]);
    echo json_encode(['status' => $res]);
}

// 3. ลบข้อมูล
if ($action == 'delete') {
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $res = $stmt->execute([$_POST['id']]);
    echo json_encode(['status' => $res]);
}
?>
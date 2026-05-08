<?php
// Cho phép Front-end gọi API và set định dạng trả về là JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

// Cấu hình kết nối
$host = 'localhost';
$db   = 'nhac_nen_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy dữ liệu từ bảng songs
    $stmt = $pdo->query("SELECT id, title, artist, src FROM songs");
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($songs);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Lỗi: " . $e->getMessage()]);
}
?>
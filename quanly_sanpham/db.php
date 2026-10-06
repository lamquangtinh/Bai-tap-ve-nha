<?php
$conn = new mysqli("localhost", "root", "", "db_quanly_sanpham");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
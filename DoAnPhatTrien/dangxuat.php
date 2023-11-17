<?php
session_start(); // Bắt đầu session

// Xóa tất cả các biến session
session_unset();

// Hoặc sử dụng session_destroy() để hủy toàn bộ session
// session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập sau khi đăng xuất
header("Location: index.php"); 
exit;
?>
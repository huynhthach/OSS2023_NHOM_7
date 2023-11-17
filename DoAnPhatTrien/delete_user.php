<?php
include "Config.php";

if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];

    // Xác nhận xóa người dùng
    $query = "DELETE FROM users WHERE UserID = '$userID'";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>history.go(-2);</script>";
    } else {
        echo "Lỗi khi xoá người dùng: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

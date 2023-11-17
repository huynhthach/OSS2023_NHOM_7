<?php
include '../config.php';
$userID = 1;
$sql = "SELECT * FROM Users WHERE UserID = $userID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Thông tin chi tiết của người dùng:<br>";
        echo "User ID: " . $row["UserID"] . "<br>";
        echo "Username: " . $row["Username"] . "<br>";
        echo "Email: " . $row["Email"] . "<br>";
        echo "Ngày Tạo: " . $row["NgayTao"] . "<br>";
        echo "Role ID: " . $row["IDRole"] . "<br>";
        echo "Level: " . $row["level"] . "<br>";
        echo "Rank: " . $row["Rank"] . "<br>";
        echo "Số Dư: $" . $row["SoDu"] . "<br>";
        echo "Số Lần Thắng: " . $row["Win"] . "<br>";
        echo "Image: " . $row["image"] . "<br>";
    }
} else {
    echo "Không tìm thấy người dùng.";
}

// Đóng kết nối
$conn->close();
?>

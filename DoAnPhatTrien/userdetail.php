<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .profile-container {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .profile-info {
        margin-top: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .profile-value {
        margin-bottom: 15px;
    }

    .profile-image {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        height: auto;
        border-radius: 200px;/* Đặt border-radius thành 50% để bo tròn */
    }
</style>
<?php
include 'config.php';
$userID = $_POST['user_id'];
$sql = "SELECT * FROM Users WHERE UserID = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="profile-container">';
        echo '<h2>Thông tin chi tiết của người dùng</h2>';

        echo '<div class="profile-value">';
        echo '<img class="profile-image" src="image/default.png" style="width:30%" alt="User Image">';

        echo '<div class="profile-info">';
        echo '<label>User ID:</label>';
        echo '<div class="profile-value">' . $row["UserID"] . '</div>';

        echo '<label>Username:</label>';
        echo '<div class="profile-value">' . $row["Username"] . '</div>';

        echo '<label>Email:</label>';
        echo '<div class="profile-value">' . $row["Email"] . '</div>';

        echo '<label>Ngày Tạo:</label>';
        echo '<div class="profile-value">' . $row["NgayTao"] . '</div>';

        echo '<label>Role ID:</label>';
        echo '<div class="profile-value">' . $row["IDRole"] . '</div>';

        echo '<label>Level:</label>';
        echo '<div class="profile-value">' . $row["level"] . '</div>';

        echo '<label>Rank:</label>';
        echo '<div class="profile-value">' . $row["Rank"] . '</div>';

        echo '<label>Số Dư:</label>';
        echo '<div class="profile-value">$' . $row["SoDu"] . '</div>';

        echo '<label>Số Lần Thắng:</label>';
        echo '<div class="profile-value">' . $row["Win"] . '</div>';

        echo '</div>';

        echo '</div>'; // Kết thúc profile-info
        echo '</div>'; // Kết thúc profile-container
    }
} else {
    echo "Không tìm thấy người dùng.";
}

// Đóng kết nối
$conn->close();
?>

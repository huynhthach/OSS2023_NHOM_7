<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "Config.php";
session_start();
$ID = $_SESSION['UserID'];
$query = "SELECT * FROM owneditems JOIN items ON owneditems.ItemID = items.ItemID WHERE OwnerID = '$ID' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Hiển thị thông tin về sản phẩm và tạo liên kết đến trang đấu giá với thông tin sản phẩm tương ứng.
        echo "<div>";
        echo "<h2>" . $row['ItemName'] . "</h2>";
        echo "<p>Giá: $" . $row['image'] . "</p>";
        echo "<a href='fightprice.php?product_id=" . $row['ItemID'] . "'>Đấu giá</a>";
        echo "</div>";
    }
} else {
    echo "Không có sản phẩm nào để hiển thị.";
}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Price</title>
</head>
<body>
<?php
include "Config.php";
session_start();

if (isset($_GET['product_id'])) {
    $productID = $_GET['product_id'];
    
    // Truy vấn thông tin về sản phẩm
    $query = "SELECT * FROM items WHERE ItemID = '$productID'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị thông tin về sản phẩm
        echo "<h2>" . $row['ItemName'] . "</h2>";
        echo "<p>Description: $" . $row['Description'] . "</p>";

        // Tạo biểu mẫu để đấu giá sản phẩm
        echo "<form method='post' action='process_fightprice.php'>";
        echo "<input type='hidden' name='product_id' value='" . $productID . "'>";
        
        // Thêm trường SELECT để chọn kiểu đấu giá
        echo "<label for='auction-type'>Chọn kiểu đấu giá:</label>";
        echo "<select id='auction-type' name='auction-type' required>";
        echo "<option value='ĐG'>Đấu giá</option>";
        echo "<option value='MB'>Mua bán</option>";
        echo "</select>";

        echo "<label for='bid-amount'>Số tiền đấu giá hoặc giá mua:</label>";
        echo "<input type='number' id='bid-amount' name='bid-amount' required>";
        
        echo "<button type='submit'>Thực hiện</button>";
        echo "</form>";
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
} else {
    echo "Không có thông tin sản phẩm để hiển thị.";
}
?>
</body>
</html>

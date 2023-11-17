<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Thông tin kết nối cơ sở dữ liệu
    include 'Config.php';

    // Lấy dữ liệu từ yêu cầu POST
    $itemID = $_POST["itemID"];
    $sellValue = $_POST["sellValue"];

    // Cập nhật giá trị cột "Sell" trong cơ sở dữ liệu
    $updateSql = "UPDATE items SET Sell = $sellValue WHERE ItemID = $itemID";
    $conn->query($updateSql);

    // Đóng kết nối
    $conn->close();

    // Trả về phản hồi (nếu cần)
    echo "Cập nhật thành công";
}
?>

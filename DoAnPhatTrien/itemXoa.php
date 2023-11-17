<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Thông tin kết nối cơ sở dữ liệu
    include 'Config.php';
    // Lấy dữ liệu từ yêu cầu POST
    $itemID = $_POST["itemID"];

    // Thực hiện truy vấn xóa
    $deleteSql = "DELETE FROM items WHERE ItemID = $itemID";
    $conn->query($deleteSql);

    // Đóng kết nối
    $conn->close();

    // Trả về phản hồi (nếu cần)
    echo "Xóa thành công";
}
?>

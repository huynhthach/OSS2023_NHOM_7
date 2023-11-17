<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_button']) && isset($_POST['item_id'])) {
        $itemID = $_POST['item_id'];
        $updateSellQuery = "UPDATE Items SET sell = 0 WHERE ItemID = $itemID";
        
        if ($conn->query($updateSellQuery) === TRUE) {
            echo "Vật phẩm đã được xóa và trường sell được cập nhật thành 0.";
        } else {
            echo "Lỗi khi cập nhật trường sell: " . $conn->error;
        }
    }
}
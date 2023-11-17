<?php
include "Config.php";

// Kiểm tra xem có tham số receiptId được gửi từ yêu cầu không
if (isset($_GET['receiptId'])) {
    $receiptId = $_GET['receiptId'];

    // Truy vấn để lấy thông tin về đơn hàng
    $getReceiptInfoQuery = "SELECT * FROM receipt WHERE RecieptID = $receiptId";
    $result = $conn->query($getReceiptInfoQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Nếu UserIDBuy là null, chỉ cập nhật trạng thái
        if ($row['UserIDBuy'] == null) {
            $updateQuery = "UPDATE receipt SET State = 1 WHERE RecieptID = $receiptId";
            $conn->query($updateQuery);
            echo "Trạng thái đã được cập nhật thành công.";
            exit();
        } else {
            // Nếu UserIDBuy không phải là null, xóa vật phẩm trong owneditems
            $deleteItemQuery = "DELETE FROM owneditems WHERE ItemID = " . $row['ItemID'] . " AND OwnerID = " . $row['UserIDSell'];
            $conn->query($deleteItemQuery);
            // Cập nhật vật phẩm trong owneditems theo UserIDBuy
            $updateOwnedItemsQuery = "UPDATE owneditems SET OwnerID = " . $row['UserIDBuy'] . " WHERE ItemID = " . $row['ItemID'];
            $conn->query($updateOwnedItemsQuery);
            // Cập nhật trạng thái
            $updateQuery = "UPDATE receipt SET State = 1 WHERE RecieptID = $receiptId";
            $conn->query($updateQuery);
            echo "Trạng thái đã được cập nhật và vật phẩm đã được xóa thành công.";
            exit();
        }
    } else {
        // Nếu không có thông tin về đơn hàng, trả về thông báo lỗi
        echo "Không tìm thấy thông tin đơn hàng.";
    }
} else {
    // Nếu không có tham số được gửi, trả về thông báo lỗi
    echo "Thiếu tham số receiptId.";
}
?>

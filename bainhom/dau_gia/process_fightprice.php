<?php
include "Config.php";
session_start();

if (isset($_POST['product_id']) && isset($_POST['auction-type'])) {
    $productID = $_POST['product_id'];
    $bidAmount = $_POST['bid-amount'];
    $ActionType = $_POST['auction-type'];
    $userID = $_SESSION['UserID'];

    // Lấy thời gian hiện tại
    $currentTime = time();
    // Lấy số ngày hiện tại
    $currentDate = date("Y-m-d", $currentTime);
    // Tính toán thời gian sau 2 ngày
    $time2day = $currentTime + (2 * 24 * 60 * 60); // Số giây trong 2 ngày
    // Lấy ngày sau 2 ngày
    $date2day = date("Y-m-d", $time2day);

    $query = "SELECT MAX(RecieptID) AS MaxID FROM receipt";
    $resultM = $conn->query($query);
    $row_id = $resultM->fetch_assoc();
    $t = $row_id["MaxID"] + 1;
    // $Receiptmax = $resultM + 1;
    // Truy vấn thông tin sản phẩm
    $insertReceipt = "INSERT INTO receipt (UserIDBuy, UserIDSell, RecieptDate, ReceiptDayEnd, TotalAmount, CategoryReceiptID, State) 
    VALUES (NULL, '$userID', '$currentDate','$date2day','$bidAmount', '$ActionType', 0)";
    $result = $conn->query($insertReceipt);
        if ($result!=0) {
            $insertReceiptDt="INSERT INTO `recieptdetails`(`DetailID`, `RecieptID`, `ItemID`, `Price`)
             VALUES (NULL,$t,$productID,NULL)";
            $result1 = $conn->query($insertReceiptDt);
            // Đấu giá thành công, có thể thêm mã HTML hoặc thông báo tại đây
            echo "Đấu giá thành công!";
            $conn->close();
            header("process_fightprice.php");
            // Tại đây, bạn có thể thêm mã HTML hoặc chuyển hướng người dùng đến trang khác (ví dụ: trang danh sách sản phẩm).
        } else {
            // Xử lý lỗi nếu cần
            echo "Lỗi khi thực hiện đấu giá: " . $conn->error;
        }
        
} else {
    echo "Thiếu thông tin sản phẩm hoặc số tiền đấu giá.";
}
?>

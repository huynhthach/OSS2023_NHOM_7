<?php
include "Config.php";
session_start();
if (isset($_POST['product_id']) && isset($_POST['auction-type']) && isset($_POST['auction-type'])) {
    $productID = $_POST['product_id'];
    $bidAmount = $_POST['bid-amount'];
    $ActionType = $_POST['auction-type'];
    $userID = $_SESSION['UserID'];
    echo $productID.$bidAmount.$ActionType.$userID;
    // Lấy thời gian hiện tại
    $currentTime = time();
    // Lấy số ngày hiện tại
    $currentDate = date("Y-m-d", $currentTime);
    // Tính toán thời gian sau 2 ngày
    $time2day = $currentTime + (2 * 24 * 60 * 60); // Số giây trong 2 ngày
    // Lấy ngày sau 2 ngày
    $date2day = date("Y-m-d", $time2day);

    // $Receiptmax = $resultM + 1;
    // Truy vấn thông tin sản phẩm
    $insertReceipt = "INSERT INTO reciept (RecieptID, UserIDBuy, UserIDSell, RecieptDate, RecieptDateEnd,ItemID, Price, CategoryRecieptID, State) 
    VALUES (NULL, NULL, '$userID', '$currentDate','$date2day','$productID','$bidAmount', '$ActionType', 0)";
    $result = $conn->query($insertReceipt);
    
    if ($result != 0) {
        header("Location: index.php?page=daugia");
        exit(); // Đảm bảo dừng việc thực hiện script sau khi chuyển hướng
    } else {
        // Xử lý lỗi nếu cần
        echo "Lỗi khi thực hiện đấu giá: " . $conn->error;
    }
} else {
    echo "Thiếu thông tin sản phẩm hoặc số tiền đấu giá.";
}
?>

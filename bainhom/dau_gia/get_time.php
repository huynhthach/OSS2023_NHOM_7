<?php
// ajax_get_time.php
include "Config.php";

// Truy vấn cơ sở dữ liệu để lấy currentTime và time2day
$query = "SELECT RecieptDate, ReceiptDayEnd FROM receipt "; // Thay thế your_time_table và id bằng tên bảng và ID thích hợp của bạn
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
    $currentTime = strtotime($row["RecieptDate"]);
    $time2day = strtotime($row["ReceiptDayEnd"]);
    echo json_encode(array("currentTime" => $currentTime, "time2day" => $time2day));
     } 
    }
    else {
    echo json_encode(array("error" => "Không thể lấy thời gian từ cơ sở dữ liệu."));
}

?>
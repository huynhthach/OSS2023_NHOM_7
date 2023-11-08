<?php
include "Config.php";

$query = "SELECT MAX(RecieptID) AS MaxID FROM receipt";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // Lấy dòng dữ liệu đầu tiên
    $row = $result->fetch_assoc();
    $maxID = $row["MaxID"];
    
    // In ra màn hình ID lớn nhất
    echo "ID lớn nhất: " . $maxID;
} else {
    echo "Không tìm thấy bất kỳ dữ liệu nào.";
}

?>
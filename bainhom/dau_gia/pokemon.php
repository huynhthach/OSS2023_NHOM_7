<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
            background-color: #f0f0f0;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-description {
            font-size: 14px;
        }

        .card-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<?php
// Kết nối đến cơ sở dữ liệu
include "Config.php";
session_start(); // Bắt đầu phiên
// Loại hoá đơn "DG" (Đấu Giá)
$categoryID = "ĐG";

// Truy vấn vật phẩm và tên người bán với categoryID là "DG"
$query = "SELECT *
          FROM receipt
          JOIN users ON receipt.UserIDSell = users.UserID
          JOIN owneditems ON users.UserID = owneditems.OwnerID
          JOIN items ON owneditems.ItemID = items.ItemID
          WHERE receipt.CategoryReceiptID = '$categoryID'";
$result = $conn->query($query);

if ($result === false) {
    die("Lỗi trong truy vấn SQL: " . $conn->error);
}
echo "<a href='new_fightprice.php'>Đấu giá</a>";
// Kiểm tra số hàng trả về
if ($result->num_rows > 0) {
    echo "<div class='card-container'>";
    while ($row = $result->fetch_assoc()) {
        if($row['State']==0){
        $currentTime = strtotime($row["RecieptDate"]);
        $time2day = strtotime($row["ReceiptDayEnd"]);
    
        // Tính toán thời gian còn lại
        $remainingTime = $time2day - $currentTime;
    
        // Chuyển thời gian còn lại thành định dạng giờ:phút:giây
        $hours = floor($remainingTime / 3600);
        $minutes = floor(($remainingTime % 3600) / 60);
        $seconds = $remainingTime % 60;

        echo "<div class='card'>";  
        echo "<img src='" . $row['image'] . "' alt='Item Image' class='card-image'>";
        echo "<h3 class='card-title'>" . $row['ItemName'] . "</h3>";
        echo "<p class='card-description'>Người Bán: " . $row['Username'] . "</p>";
        echo "<p class='card-description'>GIÁ: " . $row['TotalAmount'] . "</p>";
        echo "<p id='remaining-time'></p>";
        echo "<button class='auction-button' onclick='startAuction(" . $row['RecieptID'] . ")'>Đấu Giá</button>";
        echo "</div>";
        }
    }
    echo "</div>";
} else {
    echo "Không có vật phẩm nào có categoryID là 'ĐG' hoặc không có vật phẩm đấu giá nào được tìm thấy.";
}
?>



<script>
    function startAuction(RecieptID) {
    // Tạo URL cho trang đấu giá
    var auctionURL = 'auction.php?RecieptID=' + RecieptID;

    // Mở cửa sổ nhỏ (popup)
    var popupWindow = window.open(auctionURL, '_blank', 'width=800, height=600');

    // Tùy chỉnh kích thước và các thuộc tính khác của cửa sổ popup theo nhu cầu
}
function updateRemainingTime() {
        var currentTime = <?php echo $currentTime; ?>;
        var time2day = <?php echo $time2day; ?>;
        var remainingTime = time2day - currentTime;
        var hours = Math.floor(remainingTime / 3600);
        var minutes = Math.floor((remainingTime % 3600) / 60);
        var seconds = remainingTime % 60;
        document.getElementById("remaining-time").textContent = hours + ' giờ, ' + minutes + ' phút, ' + seconds + ' giây';
    }
    updateRemainingTime();
</script>

</body>
</html>
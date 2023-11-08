<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đấu giá vật phẩm</title>
</head>
<body>
<?php
include "Config.php";
session_start();
// Bước 1: Trích xuất thông tin về vật phẩm (ví dụ: ItemID từ URL)
$error = "";
if (isset($_GET['RecieptID'])) {
    $RecieptID = $_GET['RecieptID'];

    if(isset($_POST['submit'])){
    $bidAmount = $_POST['bid-amount'];

    $ID = $_SESSION['UserID'];

    $query = "SELECT * FROM users WHERE UserID = '$ID'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    $query1 = "SELECT * FROM receipt";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();

    if ($row !== null && $row1 !== null) {
        if ($bidAmount <= 0 || $bidAmount > $row['SoDu'] || $bidAmount < $row1['TotalAmount']) {
            $error = "Số tiền đấu giá không hợp lệ";
        } else {
            // Thực hiện đấu giá
            $query = "UPDATE receipt SET TotalAmount = '$bidAmount',UserIDBuy = '$ID' WHERE RecieptID = $RecieptID";
            $final_result = $conn->query($query);
            if($final_result){
            $error = "đấu giá thành công";
            }else 
            $error = "fail";
        }
    } else {
        $error = "Lỗi trong truy vấn SQL hoặc dữ liệu không tồn tại";
    }
    
    
    }
    // Bước 2: Hiển thị thông tin về vật phẩm và biểu mẫu đấu giá
} else {
    echo "Không tìm thấy thông tin về vật phẩm.";
}
?>
    <h1>Đấu giá vật phẩm</h1>

    <!-- Hiển thị thông tin về vật phẩm, ví dụ: tên, hình ảnh, giá hiện tại -->
    <p>Thông tin về vật phẩm:</p>
    <!-- Hiển thị thông tin về vật phẩm, ví dụ: tên, hình ảnh, giá hiện tại -->

    <form method="post">
        <input type="hidden" name="item_id" value="<?php echo $RecieptID; ?>">
        <label for="bid-amount">Số tiền đấu giá:</label>
        <input type="number" name="bid-amount" required>
        <button type="submit" name="submit">Đấu giá</button>
    </form>
    <p><?php echo $error; ?></p>
</body>
</html>

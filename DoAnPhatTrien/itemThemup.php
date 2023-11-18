<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Thông tin kết nối cơ sở dữ liệu
    include 'Config.php';
    // Lấy dữ liệu từ biểu mẫu POST
    $itemName = $_POST["itemName"];
    $itemCategory = $_POST["itemCategory"];
    $itemDescription = $_POST["itemDescription"];
   
    $itemPrice = $_POST["itemPrice"];
    $itemSell = isset($_POST["itemSell"]) ? 1 : 0;

    // Thực hiện truy vấn thêm mới
    // Xử lý hình ảnh
    $targetDirectory = "image/imageTin/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $nameim=basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $insertSql = "INSERT INTO items (ItemName, ItemCategory, Description, image, Date, Price, Sell) 
                  VALUES ('$itemName', '$itemCategory', '$itemDescription', '$nameim', NOW(), '$itemPrice', '$itemSell')";
    if ($conn->query($insertSql) === TRUE) {
        echo "Thêm mới thành công";
        header("Location: index.php?page=itemQuanLy");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
    // Đóng kết nối
    $conn->close();
}
?>

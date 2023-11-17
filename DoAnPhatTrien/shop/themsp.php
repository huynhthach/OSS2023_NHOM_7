<?php
include '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        $itemName = $_POST['item_name'];
        $itemCategory = $_POST['item_category'];
        $itemDescription = $_POST['item_description'];
        $itemPrice = $_POST['item_price'];
        $itemSell = isset($_POST['item_sell']) ? 1 : 0; 

        $targetDir = "../image/";
        $targetFile = $targetDir . basename($_FILES["item_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if(isset($_POST["add_product"])) {
            $check = getimagesize($_FILES["item_image"]["tmp_name"]);
            if($check !== false) {
                echo "File là hình ảnh - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File không phải là hình ảnh.";
                $uploadOk = 0;
            }
        }
        if (file_exists($targetFile)) {
            echo "Xin lỗi, file đã tồn tại.";
            $uploadOk = 0;
        }

        if ($_FILES["item_image"]["size"] > 50000000) {
            echo "Xin lỗi, file của bạn quá lớn.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Xin lỗi, chỉ các file JPG, JPEG, PNG & GIF được phép.";
            $uploadOk = 0;
        }

        
        if ($uploadOk == 0) {
            echo "Xin lỗi, file của bạn không được tải lên.";
        
        } else {
            if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetFile)) {
                echo "File ". htmlspecialchars( basename( $_FILES["item_image"]["name"])). " đã được tải lên thành công.";
                
                $imagePath = $targetFile;
                $insertProductQuery = "INSERT INTO Items (ItemName, ItemCategory, Description, Price, Sell, image) 
                                      VALUES ('$itemName', '$itemCategory', '$itemDescription', $itemPrice, $itemSell, '$imagePath')";

                if ($conn->query($insertProductQuery) === TRUE) {
                    echo "Sản phẩm đã được thêm thành công.";
                } else {
                    echo "Lỗi khi thêm sản phẩm: " . $conn->error;
                }
            } else {
                echo "Xin lỗi, có lỗi xảy ra khi tải lên file của bạn.";
            }
        }
        
    }
}
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
</head>
<body>

<h2>Thêm Sản Phẩm Mới</h2>

<form method="post" action="" enctype="multipart/form-data">
    <label for="item_name">Tên Sản Phẩm:</label>
    <input type="text" name="item_name" required><br>

    <label for="item_category">Danh Mục:</label>
    <input type="text" name="item_category" required><br>

    <label for="item_description">Mô Tả:</label>
    <textarea name="item_description" required></textarea><br>

    <label for="item_price">Giá:</label>
    <input type="number" name="item_price" required><br>

    <label for="item_sell">Hiển Thị:</label>
    <input type="checkbox" name="item_sell" checked><br>

    <label for="item_image">Hình Ảnh:</label>
    <input type="file" name="item_image" accept="image/*" required><br>

    <input type="submit" name="add_product" value="Thêm Sản Phẩm">
</form>

</body>
</html>

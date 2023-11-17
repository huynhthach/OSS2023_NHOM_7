<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Item</title>
</head>
<body>

<h2>Thêm Item</h2>

<form action="?page=itemThemup" method="post" enctype="multipart/form-data">
    <label for="itemName">Tên vật phẩm:</label>
    <input type="text" id="itemName" name="itemName" required>

    <label for="itemCategory">Loại vật phẩm:</label>
    <select id="itemCategory" name="itemCategory" required>
       <?php
       include 'Config.php';
        $query = "SELECT CategoryID, CategoryName FROM itemcategories";
        $result = $conn->query($query);

        // Hiển thị các tùy chọn trong dropdown list
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row["CategoryID"]}'>{$row["CategoryName"]}</option>";
        }
       ?>
    </select>

    <label for="itemDescription">Mô tả:</label>
    <textarea id="itemDescription" name="itemDescription" required></textarea>

    <label for="itemImage">Ảnh:</label>
    <input type="file" id="image" name="image" accept="image/*" required>
    

    <label for="itemPrice">Giá:</label>
    <input type="text" id="itemPrice" name="itemPrice" required>

    <label for="itemSell">Sell:</label>
    <input type="checkbox" id="itemSell" name="itemSell" value="1">

    <button type="submit">Thêm Item</button>
</form>

</body>
</html>

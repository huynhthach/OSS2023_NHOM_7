<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buy_button']) && isset($_POST['item_id']) && isset($_POST['user_id'])) {
        $itemID = $_POST['item_id'];
        $ownerID = 1;
        $ngaySoHuu = date("Y-m-d H:i:s");

        $userQuery = "SELECT SoDu FROM Users WHERE UserID = $ownerID";
        $userResult = $conn->query($userQuery);

        $productPriceQuery = "SELECT Price FROM Items WHERE ItemID = $itemID";
        $productPriceResult = $conn->query($productPriceQuery);

        if ($userResult->num_rows > 0 && $productPriceResult->num_rows > 0) {
            $userData = $userResult->fetch_assoc();
            $currentBalance = $userData['SoDu'];
            $productData = $productPriceResult->fetch_assoc();
            
            $productPrice = $productData['Price'];

            if ($currentBalance >= $productPrice) {
                $newBalance = $currentBalance - $productPrice;
                $updateBalanceQuery = "UPDATE Users SET SoDu = $newBalance WHERE UserID = $ownerID";
                $conn->query($updateBalanceQuery);

                $insertOwnedItemsQuery = "INSERT INTO OwnedItems (ItemID, OwnerID, NgaySoHuu) VALUES ('$itemID', '$ownerID', '$ngaySoHuu')";
                
                if ($conn->query($insertOwnedItemsQuery) === TRUE) {
                    $invoiceQuery = "SELECT OwnedItems.NgaySoHuu, Items.ItemName, Items.Description, Items.Price, ItemCategories.CategoryName
                                     FROM OwnedItems
                                     INNER JOIN Items ON OwnedItems.ItemID = Items.ItemID
                                     INNER JOIN ItemCategories ON Items.ItemCategory = ItemCategories.CategoryID
                                     WHERE OwnedItems.OwnerID = $ownerID AND OwnedItems.NgaySoHuu = '$ngaySoHuu'";
            
                    $invoiceResult = $conn->query($invoiceQuery);
            
                    if ($invoiceResult->num_rows > 0) {
                        $invoiceDetails = $invoiceResult->fetch_assoc();
                        echo "<div class='invoice'>";
                        echo "<p class='invoice-title'>Hóa đơn:</p>";
                        echo "<p><strong>Ngày mua hàng:</strong> " . $invoiceDetails['NgaySoHuu'] . "</p>";
                        echo "<p><strong>Tên sản phẩm:</strong> " . $invoiceDetails['ItemName'] . "</p>";
                        echo "<p><strong>Mô tả:</strong> " . $invoiceDetails['Description'] . "</p>";
                        echo "<p><strong>Danh mục:</strong> " . $invoiceDetails['CategoryName'] . "</p>";
                        echo "<p><strong>Giá:</strong> $" . $invoiceDetails['Price'] . "</p>";
                        echo "</div>";
                    } else {
                        echo "Không tìm thấy thông tin hóa đơn.";
                    }
                }
            } else {
                echo "Không đủ tiền để mua sản phẩm.";
            }
        } else {
            echo "Không tìm thấy thông tin người dùng hoặc sản phẩm.";
        }
    }
}
$sql = "SELECT * FROM Items WHERE sell = 1 ";
$result = $conn->query($sql);
?>
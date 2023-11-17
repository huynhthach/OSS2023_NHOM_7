<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST['show_sell_zero'])||isset($_POST['show_sell_one'])) {
        $sql = "SELECT * FROM Items WHERE sell = 0";
    if (isset($_POST['show_sell_one']) && isset($_POST['item_id'])) {
        $itemID = $_POST['item_id'];
        $updateSellQuery = "UPDATE Items SET sell = 1 WHERE ItemID = $itemID";
        if ($conn->query($updateSellQuery) === TRUE) {
            echo "Sản phẩm có ID $itemID đã được hiển thị lại.";
        } else {
            echo "Lỗi khi cập nhật trường sell: " . $conn->error;
        }
    }
   
$result = $conn->query($sql);

if ($result->num_rows > 0 ) {
    echo '</div><div class="Items-container">';
    $count = 0;
    if(!isset($filterResult))
    while($row = $result->fetch_assoc()) {
        echo "<div class='Items'>";
        echo "<h3>" . $row["ItemName"] . "</h3>";
        $imageFileName = $row["image"];
        $imagePath = "../image/". $imageFileName;
    if (file_exists($imagePath)) {
        echo "<img src='" . $imagePath . "' alt='" . $row["image"] . "' width='200'>";
    } else {
        echo "<p>Image not found</p>";
    }
        echo "<p>" . $row["Description"] . "</p>";
        echo "<p>Price: $" . $row["Price"] . "</p>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='item_id' value='" . $row["ItemID"] . "'>";
        echo '<form method="post" action="">
            <input type="hidden" name="item_id" value="' . $row["ItemID"] . '">
            <input type="submit" name="show_sell_one" value="Hiển thị lại">
            </form>';
        echo "</div>";
        
        $count++;
        if ($count % 3 == 0) {
            echo '</div><div class="Items-container">';
            $count = 0;
        }
    }
} else {
    echo "No products found";
}
$conn->close();
}
echo '<form method="post" action="">
        <input type="submit" name="show_sell_zero" value="Hiển thị vật phẩm bị ẩn">
      </form>';

?>
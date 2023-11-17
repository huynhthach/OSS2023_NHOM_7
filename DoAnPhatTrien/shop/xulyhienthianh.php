<?php
if (!isset($_POST['show_sell_zero'])) {
 $sql = "SELECT * FROM Items WHERE sell = 1";
 if ($_SERVER["REQUEST_METHOD"] == "GET"){
 if (isset($_GET['category']) && $selectedCategory !== 'all') {
    $result = $conn->query($filterQuery1);
 }
 elseif (isset($_GET['category']) ){
$result = $conn->query($filterQuery);
 }
 elseif (isset($_GET['search'])){
 $result = $conn->query($searchQuery);
 }
}
 else
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
         echo "<input type='hidden' name='user_id' value='1'>";
         echo "<input type='submit' name='buy_button' value='Buy' class='buy-button'>";
         echo '<input type="hidden" name="item_id" value="' . $row["ItemID"] . '">';
         echo "<input type='submit' name='delete_button' value='Delete' class='buy-button'> ";
         echo "</div>";
         
         $count++;
         if ($count % 3 == 0) {
             echo '</div><div class="Items-container">';
             $count = 0;
         }
     }
 } else {
    echo "<p class='no-products'>No products found</p>";
 }
}
?>
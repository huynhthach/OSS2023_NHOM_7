<?php
$categoryQuery = "SELECT * FROM ItemCategories";
$categoryResult = $conn->query($categoryQuery);
echo "<form method='get' action=''>";
echo "<label for='category'>Chọn danh mục:</label>";
echo "<select name='category' id='category'>";
echo "<option value='all'>Tất cả</option>";

if ($categoryResult->num_rows > 0) {
    while ($categoryRow = $categoryResult->fetch_assoc()) {
        echo "<option value='" . $categoryRow['CategoryID'] . "'>" . $categoryRow['CategoryName'] . "</option>";
    }
}

echo "</select>";
echo "<input type='submit' value='Lọc'>";
echo "</form>";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    $filterQuery= "SELECT * FROM Items WHERE sell = 1";
    
    if ($selectedCategory !== 'all') {
        $filterQuery1 = "SELECT * FROM Items ";
        $filterQuery1 .= " INNER JOIN ItemCategories ON Items.ItemCategory = ItemCategories.CategoryID WHERE ItemCategories.CategoryID = '$selectedCategory' and sell = 1";
    }
    
}

?>
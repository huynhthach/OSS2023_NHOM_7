<?php
echo "<form method='get' action=''>";
echo "<label for='search'>Tìm kiếm sản phẩm:</label>";
echo "<input type='text' name='search' id='search'>";
echo "<input type='submit' value='Tìm kiếm'>";
echo "</form>";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $searchQuery = "SELECT * FROM Items WHERE ItemName LIKE '%$searchKeyword%' and sell = 1";
     
}


?>
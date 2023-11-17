<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $searchKeyword = $_POST['search'];
    $searchQuery = "SELECT * FROM Users WHERE 
                    Username LIKE '%$searchKeyword%' OR 
                    Email LIKE '%$searchKeyword%' OR 
                    Rank LIKE '%$searchKeyword%'";
    
    $result = $conn->query($searchQuery);
   
}

$conn->close();
?>

<?php
$itemId = $_GET['itemID'] ?? $_POST['itemID'] ?? '';

$itemPrice = $_GET['itemPrice'] ?? $_POST['itemPrice'] ?? '';

include 'Config.php';
$insertSql="INSERT INTO `reciept`(`RecieptID`, `UserIDBuy`, `UserIDSell`, `RecieptDate`, `ItemID`, `Price`, `CategoryRecieptID`, `State`) VALUES
 (NULL,'3','2',NOW(),$itemId,$itemPrice,'SHOP','1')";
    if ($conn->query($insertSql) === TRUE) {
        $insertSql2="SELECT `SoDu` FROM `users` WHERE UserID=2;";
        $insertSql1="INSERT INTO `owneditems`(`ItemID`, `OwnerID`, `NgaySoHuu`) VALUES ($itemId,2,NOW())";
        if ($conn->query($insertSql1) === TRUE) {
        echo "Thanh toán thành công";
        header("Location: index.php?page=shop");
    }
        else {
            echo "Lỗi: " . $conn->error;}
    } 
    else {
        echo "Lỗi: " . $conn->error;
    }
?>
<?php
include('index2.php');
?>
<body>
    <section>
    <div class="container" style="background-image: url('image/body_bg.png')">
        <h1>Your Storage</h2> 
        <?php
        include "Config.php";
        session_start();
        $ID = $_SESSION['UserID'];
        $query = "SELECT * FROM owneditems JOIN items ON owneditems.ItemID = items.ItemID WHERE OwnerID = '$ID'";
        $query2 = "SELECT * FROM reciept";
        $resultow = $conn->query($query);
        $resultre = $conn->query($query2);

        if ($resultow->num_rows > 0) {
            while ($row = $resultow->fetch_assoc()) {
                // Kiểm tra xem ItemID có tồn tại trong receipt hay không
                $itemID = $row['ItemID'];
                $isItemSold = false;
                while ($receiptRow = $resultre->fetch_assoc()) {
                    $currentDateTime = date("Y-m-d H:i:s");
                    if ($receiptRow['ItemID'] == $itemID and $currentDateTime < $receiptRow['RecieptDateEnd']
                    ) {
                        $isItemSold = true;
                        break;
                    }
                    if ($receiptRow['ItemID'] == $itemID and $currentDateTime > $receiptRow['RecieptDateEnd']
                    and $receiptRow['UserIDBuy']==null) {
                        $isItemSold = false;
                        break;
                    }
                }

                echo "<div class='item'>";
                echo "<h2>" . $row['ItemName'] . "</h2>";
                echo "<p>Giá: $" . $row['image'] . "</p>";

                if ($isItemSold) {
                    echo "<p>Đang bán</p>";
                } else {
                    echo "<a href='fightprice.php?product_id=" . $row['ItemID'] . "'>Đấu giá</a>";
                }

                echo "</div>";
            }
        } else {
            echo "Không có sản phẩm nào để hiển thị.";
        }
        ?>
    </div>
    </section>
</body>
</html>
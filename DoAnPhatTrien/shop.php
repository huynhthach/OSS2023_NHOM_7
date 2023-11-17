<?php
include 'Config.php';
if (isset($_SESSION['UserID'])) {
    $IdND=$_SESSION['UserID'];
    $Name=$_SESSION['UserName'];
    $SoDu=$_SESSION['SoDu'];
    $Quyen=$_SESSION['Role'];}
// Truy vấn cơ sở dữ liệu để lấy thông tin items
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị dữ liệu trong bảng
    echo "<table border='1'>";
    echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemCategory</th><th>Description</th><th>Image</th><th>Date</th><th>Price</th></tr>";

    while ($row = $result->fetch_assoc()) {
        if($row["Sell"]==1){
        echo "<tr>";
        echo "<td>" . $row["ItemID"] . "</td>";
        echo "<td>" . $row["ItemName"] . "</td>";
        echo "<td>" . $row["ItemCategory"] . "</td>";
        echo "<td>" . $row["Description"] . "</td>";
        echo "<td>" . $row["image"] . "</td>";
        echo "<td>" . $row["Date"] . "</td>";
        echo "<td>" . $row["Price"] . "</td>";
        if(isset($IdND))
        echo "<td><button class='buyButton' data-itemid='{$row["ItemID"]}' data-sodu='{$SoDu}' data-itemprice='{$row["Price"]}'>Mua</button></td>";
        echo "</tr>";}
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu";
}

// Đóng kết nối
$conn->close();

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buyButtons = document.querySelectorAll('.buyButton');

        buyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-itemid');
                const itemPrice = this.getAttribute('data-itemprice');
                const sodu = this.getAttribute('data-sodu');
                if (sodu < itemPrice) {
                    alert('Không đủ số dư để mua sản phẩm này.');
                } 
                else 
                {
                    const isConfirmed = confirm('Bạn có chắc chắn muốn mua sản phẩm này?');

                    if (isConfirmed) {
                        // Chuyển hướng hoặc thực hiện các hành động mua
                        //window.location.href = 'shopreceipt.php?itemID=' + itemId;
                        window.location.href = 'shopreceipt.php?itemID=' + itemId + '&itemPrice=' + itemPrice;
                        alert('Đã xác nhận mua');
                    }
                }
            });
        });
    });
</script>
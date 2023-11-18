<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Item</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        table {
            width: 60%;
            border-collapse: collapse;
            
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin:0 auto;
            margin-top:20%;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body style=" background-image: url('image/body_bg.png')">

<?php
include 'Config.php';
echo '<a href="?page=itemThem">Thêm vật phẩm</a>';
// Truy vấn cơ sở dữ liệu để lấy thông tin items
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị dữ liệu trong bảng
    echo "<table border='1'>";
    echo "<tr><th>ItemID</th><th>ItemName</th><th>ItemCategory</th><th>Description</th><th>Image</th><th>Date</th><th>Price</th><th>Được bán</th><th>Chức năng</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ItemID"] . "</td>";
        echo "<td>" . $row["ItemName"] . "</td>";
        echo "<td>" . $row["ItemCategory"] . "</td>";
        echo "<td>" . $row["Description"] . "</td>";
        echo "<td>" . $row["image"] . "</td>";
        echo "<td>" . $row["Date"] . "</td>";
        echo "<td>" . $row["Price"] . "</td>";
        $isChecked = $row["Sell"] == 1 ? "checked" : "";
        echo "<td><input type='checkbox' class='sellCheckbox' data-itemid='{$row["ItemID"]}' $isChecked></td>";
        echo "<td><button class='deleteButton' data-itemid='{$row["ItemID"]}'>Xóa</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu";
}

// Đóng kết nối
$conn->close();
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var checkboxes = document.querySelectorAll(".sellCheckbox");

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
            var itemID = this.getAttribute("data-itemid");
            var sellValue = this.checked ? 1 : 0;

            // Sử dụng Ajax để gửi yêu cầu cập nhật giá trị cột "Sell" lên máy chủ
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Xử lý phản hồi từ máy chủ nếu cần
                }
            };
            xhttp.open("POST", "?page=update_sell", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("itemID=" + itemID + "&sellValue=" + sellValue);

            // Không thực hiện các hành động mặc định của checkbox để tránh thay đổi giá trị trước khi cập nhật
            event.preventDefault();
        });
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var deleteButtons = document.querySelectorAll(".deleteButton");

        deleteButtons.forEach(function(deleteButton) {
            deleteButton.addEventListener("click", function() {
                var itemID = this.getAttribute("data-itemid");

                // Hiển thị cửa sổ xác nhận xóa
                var confirmDelete = confirm("Bạn có chắc muốn xóa mục này không?");
                
                if (confirmDelete) {
                    // Sử dụng Ajax để gửi yêu cầu xóa
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // Xử lý phản hồi từ máy chủ nếu cần
                            location.reload(); // Làm mới trang sau khi xóa
                        }
                    };
                    xhttp.open("POST", "?page=itemXoa", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("itemID=" + itemID);
                }
            });
        });
    });
</script>
</body>
</html>

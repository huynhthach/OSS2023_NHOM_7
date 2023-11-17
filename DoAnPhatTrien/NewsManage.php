<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Item</title>
</head>
<body>

<?php
include 'Config.php';
echo '<a href="?page=itemThem">Thêm vật phẩm</a>';
// Truy vấn cơ sở dữ liệu để lấy thông tin items
$sql = "SELECT * FROM news";
$result = $conn->query($sql);
echo '<section>';
if ($result->num_rows > 0) {
    // Hiển thị dữ liệu trong bảng
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Title</th><th>Content</th></tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["NewsID"] . "</td>";
            echo "<td>" . $row["Title"] . "</td>";
            echo "<td>" . $row["AuthorID"] . "</td>";
            echo '<td><a href="?page=tintucct_them&NewsID=' . $row["NewsID"] . '">Thêm chi tiết</a></td>';
            echo "</tr>";
        }
    
        echo "</table></section>";
        
    } else {
        echo "Không có dữ liệu trong bảng News.";
    }
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

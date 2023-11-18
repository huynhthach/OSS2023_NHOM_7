<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người Dùng</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            width: 80px;
        }

        .action-buttons a {
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons a:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body style=" background-image: url('image/body_bg.png');margin-top:8%">
    <?php
    if(isset($_POST['detail']))
    include "userdetail.php";
    ?>
    <?php
    include "Config.php";
    include "usersearch.php";    
    // Truy vấn danh sách người dùng
    $query = "SELECT * FROM users";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])){
        $result = $conn->query($searchQuery);
    }
    
       $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Image</th><th>Tên người dùng</th><th>Email</th><th>Level</th>
        <th>Rank</th><th>Số dư</th><th>Win Rate</th><th>Chức năng 1</th><th>Chức năng 2</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            $imagePath = $row['imageus']; // Đường dẫn ảnh từ cơ sở dữ liệu
            // Kiểm tra xem đường dẫn ảnh có tồn tại hay không
            if (file_exists($imagePath)) {
                echo "<td style='width:50px'><img src='image/iamegItem" . $imagePath . "' alt='Image'></td>";
            } else {
                // Nếu không tồn tại, sử dụng ảnh mặc định
                echo "<td style='width:50px'><img src='image/default.png' alt='Default Image'></td>";
            }
            echo "<form method='post' action=''>";
            echo "<td>" . $row['Username'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['level'] . "</td>";
            echo "<td>" . $row['Rank'] . "</td>";
            echo "<td>" . $row['SoDu'] . "</td>";
            echo "<td>" . $row['Win'] . "</td>";
            echo "<td class='action-buttons'>";
            echo "<a href='delete_user.php?user_id=".$row['UserID']."'>Xoá</a>";
            echo "<input type='hidden' name='user_id' value='".$_SESSION['UserID']."'>";
            echo "</td>";
            echo "<td><input type='submit' name='detail' value='Xem chi tiết' class='buy-button'></td>";
            echo "</tr>";
            echo "</form>";
        }
        
        echo "</table>";
    } else {
        echo "Không có người dùng nào để hiển thị.";
    }

    $conn->close();
    ?>
    
</body>

</html>

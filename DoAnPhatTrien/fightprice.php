<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Price</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #333;
        }

        select,
        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    include "Config.php";

    if (isset($_GET['product_id'])) {
        $productID = $_GET['product_id'];

        // Truy vấn thông tin về sản phẩm
        $query = "SELECT * FROM items WHERE ItemID = '$productID'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Hiển thị thông tin về sản phẩm
            echo "<div class='container'>";
            echo "<h2>" . $row['ItemName'] . "</h2>";
            echo "<p>Description: " . $row['Description'] . "</p>";

            // Tạo biểu mẫu để đấu giá sản phẩm
            echo "<form method='post' action='process_fightprice.php'>";
            echo "<input type='hidden' name='product_id' value='" . $productID . "'>";

            // Thêm trường SELECT để chọn kiểu đấu giá
            echo "<label for='auction-type'>Chọn kiểu đấu giá:</label>";
            echo "<select id='auction-type' name='auction-type' required>";
            echo "<option value='DG'>Đấu giá</option>";
            echo "<option value='SHOP'>Mua bán</option>";
            echo "</select>";

            echo "<label for='bid-amount'>Số tiền đấu giá hoặc giá mua:</label>";
            echo "<input type='number' id='bid-amount' name='bid-amount' required>";

            echo "<button type='submit'>Thực hiện</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>Không tìm thấy sản phẩm.</p>";
        }
    } else {
        echo "<p>Không có thông tin sản phẩm để hiển thị.</p>";
    }
    ?>
</body>

</html>

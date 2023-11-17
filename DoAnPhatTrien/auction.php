<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đấu giá vật phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            width: 100%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: #d9534f;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    include "Config.php";
    session_start();
    // Bước 1: Trích xuất thông tin về vật phẩm (ví dụ: ItemID từ URL)
    $error = "";
    if (isset($_GET['RecieptID'])) {
        $RecieptID = $_GET['RecieptID'];

        if (isset($_POST['submit'])) {
            $bidAmount = $_POST['bid-amount'];

            $ID = $_SESSION['UserID'];

            $queryUser = "SELECT * FROM users WHERE UserID = '$ID'";
            $resultUser = $conn->query($queryUser);
            $rowUser = $resultUser->fetch_assoc();

            $queryReceipt = "SELECT * FROM reciept WHERE RecieptID = $RecieptID";
            $resultReceipt = $conn->query($queryReceipt);
            $rowReceipt = $resultReceipt->fetch_assoc();

            if ($rowUser !== null && $rowReceipt !== null) {
                if ($bidAmount <= 0 || $bidAmount > $rowUser['SoDu'] || $bidAmount < $rowReceipt['Price']) {
                    $error = "Số tiền đấu giá không hợp lệ";
                } else {
                    // Thực hiện đấu giá
                    $queryUpdateReceipt = "UPDATE reciept SET Price = '$bidAmount', UserIDBuy = '$ID' WHERE RecieptID = $RecieptID";
                    $finalResultReceipt = $conn->query($queryUpdateReceipt);

                    if ($finalResultReceipt) {
                        // Cập nhật số dư người dùng
                        $newBalance = $rowUser['SoDu'] - $bidAmount;
                        $queryUpdateUser = "UPDATE users SET SoDu = '$newBalance' WHERE UserID = '$ID'";
                        $finalResultUser = $conn->query($queryUpdateUser);
                        $_SESSION['SoDu']-=$bidAmount;
                        if ($finalResultUser) {
                            $error = "Đấu giá thành công. Số dư của bạn đã được cập nhật.";
                            echo '<script>window.close();</script>';
                        } else {
                            $error = "Cập nhật số dư người dùng thất bại.";
                        }
                    } else {
                        $error = "Fail";
                    }
                }
            } else {
                $error = "Lỗi trong truy vấn SQL hoặc dữ liệu không tồn tại";
            }
        }
        // Bước 2: Hiển thị thông tin về vật phẩm và biểu mẫu đấu giá
    } else {
        echo "Không tìm thấy thông tin về vật phẩm.";
    }
    ?>
    <h1>Đấu giá vật phẩm</h1>

    <!-- Hiển thị thông tin về vật phẩm, ví dụ: tên, hình ảnh, giá hiện tại -->
    <p>Thông tin về vật phẩm:</p>

    <form method="post">
        <input type="hidden" name="item_id" value="<?php echo $RecieptID; ?>">
        <label for="bid-amount">Số tiền đấu giá:</label>
        <input type="number" name="bid-amount" required>
        <button type="submit" name="submit">Đấu giá</button>
    </form>
    <p><?php echo $error; ?></p>
</body>

</html>
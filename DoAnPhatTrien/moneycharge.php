<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp Tiền</title>
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body style=" background-image: url('image/body_bg.png')">
    <?php
    include "Config.php";
    if (isset($_POST["submit"])) {
        $money = $_POST["money"];
        $userID = $_SESSION['UserID'];
        $query = "UPDATE `users` SET `SoDu` = '$money' WHERE `UserID` = '$userID'";
        $result = $conn->query($query);
        if ($result != 0) {
            // Cập nhật thành công, chuyển hướng đến trang chi tiết sữa
            echo "<script>history.go(-2);</script>";
            $_SESSION['SoDu']+=$money;
            exit();
        } else {
            echo "Nạp tiền thất bại.";
        }
    }
    ?>

    <form method="post">
        <table>
            <tr>
                <th colspan="2">Nạp Tiền</th>
            </tr>
            <tr>
                <td>Nhập vào số tiền cần nạp:</td>
                <td>
                    <input type="number" name="money" value="<?php if (isset($money)) echo $money; ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Nạp" name="submit"></td>
            </tr>
        </table>
    </form>
</body>

</html>

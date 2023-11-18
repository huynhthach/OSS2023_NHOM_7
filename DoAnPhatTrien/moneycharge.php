<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp Tiền</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
        margin-top:20%;
    }

    form {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    table {
        width: 100%;
    }

    th {
        background-color: #3498db;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 24px;
        border-radius: 8px 8px 0 0;
    }

    td {
        padding: 15px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 16px;
    }

    input[type="number"] {
        width: calc(100% - 30px);
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #3498db;
        color: white;
        padding: 15px;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 5px;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #2980b9;
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

    
    <form method="post" action="">
    <table>
        <tr>
            <th colspan="2">Nạp Tiền</th>
        </tr>
        <tr>
            <td>Chọn số tiền:</td>
            <td>
                <label><input type="radio" name="money" value="10" <?php if (isset($money) && $money == 10) echo 'checked'; ?>> 10$</label>
                <label><input type="radio" name="money" value="20" <?php if (isset($money) && $money == 20) echo 'checked'; ?>> 20$</label>
                <label><input type="radio" name="money" value="50" <?php if (isset($money) && $money == 50) echo 'checked'; ?>> 50$</label>
                <label><input type="radio" name="money" value="100" <?php if (isset($money) && $money == 100) echo 'checked'; ?>> 100$</label>
                <label><input type="radio" name="money" value="200" <?php if (isset($money) && $money == 200) echo 'checked'; ?>> 200$</label>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Nạp" name="submit"></td>
        </tr>
    </table>
</form>

    </form>
</body>

</html>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        body {
            
            background-color: #f4f4f4;
            margin: 0 auto;
            padding: 0;
            padding-top:40%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        

        h3 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            color:#ddd;
            margin: 0 auto;
        }

        tr {
            text-align: left;
        }

        td {
            padding: 2px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 150%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
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

        h3 {
            text-align: center;
            color: #e74c3c;
        }
    </style>
    </head>
    <body style="background-image: url('image/body_bg.png')">
    

<?php
include "Config.php";

$congrat = "";
$errors = array();

if (isset($_POST['submit'])) {
    if (
        empty($_POST['UserName']) || empty($_POST['Password']) || empty($_POST['PasswordConfirm']) 
        || empty($_POST['Email']))
     {
        $errors[] = "Nhập thiếu thông tin.";
    }

    $password = $_POST['Password'];
    $passwordConfirm = $_POST['PasswordConfirm'];

    if (strlen($password) < 8) {
        $errors[] = "Mật khẩu phải có ít nhất 8 ký tự.";
    }

    $user=$_POST['UserName'];
    $query = "SELECT * FROM `users` WHERE `Username` LIKE '$user'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $errors[]="Người dùng đã tồn tại";
    }
    $Email=$_POST['Email'];
    $query = "SELECT * FROM `users` WHERE `Email` LIKE '$Email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $errors[]="email đã tồn tại";
    }

    if (
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)
    ) {
        $errors[] = "Mật khẩu phải chứa ít nhất một ký tự hoa và một ký tự đặc biệt.";
    }

    if ($password != $passwordConfirm) {
        $errors[] = "Mật khẩu không khớp.";
    }
    if (empty($errors)) {
        $options = ['cost' => 12];
        $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT, $options);

        $query = "INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `NgayTao`, 
        `IDRole`, `level`, `Rank`, `SoDu`, `Win`, `imageus`)

        VALUES (NULL, '" . $_POST['UserName'] . "', '" . $hashedPassword . "', 
        '" . $_POST['Email'] . "', CURRENT_TIMESTAMP, 1, 1, 0, 200, 0, 'default.png');";
        $result = $conn->query($query);
        if (!$result) {
            die('Query failed: ' . $conn->error);
        }
        $congrat = "Đã thêm vào thành công!!";
        header("Location: index?page=login");
        exit;
    }
}
?>

        <form method='post'>
        <h3>Đăng ký người dùng</h3>
        <table>
            <tr>
                <td>Tên người dùng</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="UserName" value="<?php
                        if(isset($_GET['submit']) && !empty($_GET['UserName'])) echo $_GET['UserName'];
                    ?>" placeholder="<?php
                        if(isset($_GET['submit']) && empty($_GET['UserName'])) echo "Please enter a username";
                    ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
            </tr>
                <td>
                    <input type="email" name="Email" value="<?php
                        if(isset($_GET['submit']) && !empty($_GET['Email'])) echo $_GET['Email'];
                    ?>" placeholder="<?php
                        if(isset($_GET['submit']) && empty($_GET['Email'])) echo "Please enter an email";
                    ?>">
                </td>
            </tr>
            <tr>
                <td>Mật khẩu</td>
                
            </tr>
            <tr>
                <td>
                    <input type="password" name="Password" value="<?php
                        if(isset($_GET['submit']) && !empty($_GET['Password'])) echo $_GET['Password'];
                    ?>" placeholder="<?php
                        if(isset($_GET['submit']) && empty($_GET['Password'])) echo "Please enter a password";
                    ?>">
                </td>
            </tr>
            <tr>
                
                <td>Nhập lại mật khẩu</td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="PasswordConfirm" value="<?php
                        if(isset($_GET['submit']) && !empty($_GET['PasswordConfirm'])) echo $_GET['PasswordConfirm'];
                    ?>" placeholder="<?php
                        if(isset($_GET['submit']) && empty($_GET['PasswordConfirm'])) echo "Please confirm your password";
                    ?>">
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Đăng ký">
        <h3>
            <?php
                foreach ($errors as $error) {
                    echo $error . " ";
                }
                echo $congrat;
            ?>
        </h3>
    </form>
    </body>
    </html>
    </body>
    </html>
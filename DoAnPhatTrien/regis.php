    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <style>
    

</style>

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
        '" . $_POST['Email'] . "', CURRENT_TIMESTAMP, 2, 1, NULL, 1, 1, NULL);";



        $result = $conn->query($query);
        if (!$result) {
            die('Query failed: ' . $conn->error);
        }
        $congrat = "Đã thêm vào thành công!!";
        header("Location: login.php");
        exit;
    }
}
?>

        <form method='post' style="border: 1px solid;">
        <h3>Rigistration</h3>
            <table>
                <tr>
                    <td>UserName</td>
                    <td>Email</td>
                </tr>
                <tr>
                    <td><input type= "text" name="UserName"value="<?php
                        if(isset($_GET['submit']))
                            if(!empty($_GET['UserName'])) echo $_GET['UserName'];
                            ?>" 
                            placeholder="<?php
                                if(isset($_GET['submit']) and empty($_GET['UserName']))
                                    echo "yeu cau khong duoc de trong"
                            ?>"></td>
                    <td><input type= "email" name="Email" value="<?php
                        if(isset($_GET['submit']))
                            if(!empty($_GET['Email'])) echo $_GET['Email'];
                            ?>" 
                            placeholder="<?php
                                if(isset($_GET['submit']) and empty($_GET['Email']))
                                    echo "yeu cau khong duoc de trong"
                            ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>ConfirmPassword</td>
                </tr>
                <tr>
                    <td><input type= "password" name="Password" value="<?php
                        if(isset($_GET['submit']))
                            if(!empty($_GET['Password'])) echo $_GET['Password'];
                            ?>" 
                            placeholder="<?php
                                if(isset($_GET['submit']) and empty($_GET['Password']))
                                    echo "yeu cau khong duoc de trong"
                            ?>"></td>
                    <td><input type= "password" name="PasswordConfirm" value="<?php
                        if(isset($_GET['submit']))
                            if(!empty($_GET['PasswordConfirm'])) echo $_GET['PasswordConfirm'];
                            ?>" 
                            placeholder="<?php
                                if(isset($_GET['submit']) and empty($_GET['PasswordConfirm']))
                                    echo "yeu cau khong duoc de trong"
                            ?>"></td>
                </tr>
                
            </table>
                <input type="submit" name="submit" size="50">
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
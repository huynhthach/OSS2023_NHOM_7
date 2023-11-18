<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    /* Reset some default styles */
    body, html {
        font-family: Arial, sans-serif;
        background-image: url('image/body_bg.png');
        margin-top:10%;
        width:60%;
        text-align: center;
        margin:0 auto;
        padding-top:10%;
    }
    
    /* Style the container for the form */
 

    /* Style the form labels */
    label {
        display: block;
        margin-bottom: 8px;
    }

    /* Style the form input fields */
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    /* Style the login button */
    button {
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        
    }

    /* Add some hover effect to the button */
    button:hover {
        background-color: #45a049;
    }

    /* Style the cancel button */
    .cancelbtn {
        background-color: #ccc;
        color: black;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        width: auto;
        float: left;
    }

    /* Add some hover effect to the cancel button */
    .cancelbtn:hover {
        background-color: #bbb;
    }

    /* Style the password forgot link */
    .psw a {
        color: #4caf50;
    }

    /* Add some spacing to the error message */
    h3 {
        margin-top: 10px;
        color: red;
    }
</style>
</head>
<body>
<?php

include 'Config.php';
$error = "";

if (isset($_POST['submit'])) {
    $user = $_POST['uname'];
    $password = $_POST['psw'];
    $query = "SELECT * FROM `users` WHERE `Username` = '$user'";
    $result = $conn->query($query);

    if (!$result) {
        die('Query failed: '.$conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Lấy hàng đầu tiên
        if(password_verify($password, $row['Password'])) {
            $error = "Đăng nhập thành công!";
            $_SESSION['UserID'] =$row['UserID'];
            $_SESSION['UserName'] =$row['Username'];
            $_SESSION['SoDu'] =$row['SoDu'];
            $_SESSION['Role'] =$row['IDRole'];
            echo "<script>history.go(-2);</script>";
            exit();
        } else {
            $error = "Mật khẩu không hợp lệ";
            var_dump($row['Password']);
            var_dump(password_verify($password, $row['Password']));
        }
    } else {
        $error = "Đăng nhập không thành công. Vui lòng kiểm tra lại tên người dùng và mật khẩu.";
    }
}
?>

        <h2>Login Form</h2>

        <form action="" method="post">

        <div class="container">
            <label for=""><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for=""><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
                
            <button type="submit" name="submit">Login</button>
            
        </div>

        
            
            
        
        <div>
            <h3>
                <?php
                echo $error;
                ?>
            </h3>
        </div>
        </form>

</body>
</html>

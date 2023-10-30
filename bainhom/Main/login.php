<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<?php
session_start();
include 'Config.php';

$error = "";

if (isset($_POST['submit'])) {
    $user = $_POST['uname'];
    $password = $_POST['psw'];
    $query = "SELECT * FROM `user` WHERE `Username` = '$user'";
    $result = $conn->query($query);

    if (!$result) {
        die('Query failed: '.$conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Lấy hàng đầu tiên
        if(password_verify($password, $row['Password'])) {
            $error = "Đăng nhập thành công!";
            header("Location: QuanLyDiemSV.php");
            exit;
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

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn" >Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
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

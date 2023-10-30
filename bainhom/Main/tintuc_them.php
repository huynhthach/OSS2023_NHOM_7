<!DOCTYPE html>
<html>
<head>
    <title>Tạo tin tức</title>
</head>
<body>
    <?php
        include 'Config.php';
        $msg="";
        $fname="";
        if (isset($_POST['submit'])) {
            if($_POST["title"]!=NULL){
                $title=$_POST["title"];
            }
            else
            $msg.="Chưa có tiêu đề !";

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image'];
            
                // Đường dẫn lưu trữ tệp trên máy chủ
                $upload_dir = 'images/';
                $file_name = $upload_dir . $file['name'];
                $fname=$file_name;
                // Di chuyển tệp tải lên vào thư mục lưu trữ
                if (move_uploaded_file($file['tmp_name'], $file_name)) {
                    echo "Tải ảnh lên thành công. Đường dẫn tới ảnh: " . $file_name;
                } else {
                    echo "Lỗi khi tải lên ảnh.";
                }
            } else {
                echo "Vui lòng chọn một tệp ảnh và thử lại.";
            }

            if($msg==""){
                $query="INSERT INTO `news`(`NewsID`, `Title`, `PublishedDate`, `AuthorID`, `CategoryID`, `image`) VALUES (NULL,'".$title."',".date('Y-m-d H:i:s').",'2','1','".$fname."')";
                $result = $conn->query($query);
                if (!$result) {
                    die('Query failed: ' . $conn->error);
                }
            
            
            }
        }
    
    ?>
    <h1>Tạo tin tức</h1>
    <form action="" method="post">
        <label for="title">Tiêu đề tin tức:</label>
        <input type="text" name="title" id="title" required><br><br>
        
        <form action="" method="post" enctype="multipart/form-data">
            <label for="image">Chọn ảnh để tải lên:</label>
            <input type="file" name="image" id="image" accept="image/*" required><br><br>
            <input type="submit" value="Tải lên ảnh">
        </form>
    </form>
</body>
</html>
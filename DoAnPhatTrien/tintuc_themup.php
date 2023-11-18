<?php
// Kết nối đến cơ sở dữ liệu
include 'Config.php';

// Xử lý tiêu đề
$title = $_POST['title'];
if (isset($_SESSION['UserID'])) {
    $IdND=$_SESSION['UserID'];
    $Name=$_SESSION['UserName'];
    $SoDu=$_SESSION['SoDu'];
    $Quyen=$_SESSION['Role'];}
// Xử lý hình ảnh
$targetDirectory = "image/imageTin/";
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$nameim=basename($_FILES["image"]["name"]);
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    // Tải ảnh lên thành công, tiến hành lưu dữ liệu vào cơ sở dữ liệu
    // $sql = "INSERT INTO images (title, image_path) VALUES ('$title', '$targetFile')";
    $sql = "INSERT INTO news (NewsID, Title, PublishedDate, AuthorID, CategoryID, image) VALUES (NULL, '$title', NOW(), $IdND, 1, '$nameim')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Hình ảnh đã được tải lên và lưu vào cơ sở dữ liệu.";
        echo "<script>history.go(-2);</script>";
        echo "Lỗi khi thêm dữ liệu vào cơ sở dữ liệu: " . $conn->error;
    }
} else {
    echo "Lỗi khi tải lên hình ảnh.";
}

$conn->close();
?>

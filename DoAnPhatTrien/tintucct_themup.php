<?php
// Kết nối đến cơ sở dữ liệu
include 'Config.php';

// Xử lý tiêu đề
$title = $_POST['title'];
$id=$_POST['NewsID'];
$form=$_POST['Form'];
// Xử lý hình ảnh
$targetDirectory = "image/imageTin/";
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$nameim=basename($_FILES["image"]["name"]);
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    // Tải ảnh lên thành công, tiến hành lưu dữ liệu vào cơ sở dữ liệu
    // $sql = "INSERT INTO images (title, image_path) VALUES ('$title', '$targetFile')";
    $sql = "INSERT INTO `newsdetails`(`NewsID`, `ImagePath`, `Content`, `ThuTu`, `Form`) VALUES ($id,'$nameim','$title',NOW(),'$form')";
    if ($conn->query($sql) === TRUE) {
        echo "Hình ảnh đã được tải lên và lưu vào cơ sở dữ liệu.";
        echo "<script>history.go(-2);</script>";
    } else {
        echo "Lỗi khi thêm dữ liệu vào cơ sở dữ liệu: " . $conn->error;
    }
} else {
    echo "Lỗi khi tải lên hình ảnh.";
}

$conn->close();
?>

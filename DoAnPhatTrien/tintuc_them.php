<!DOCTYPE html>
<html>
<head>
    <title>Thêm Hình Ảnh</title>
</head>
<body>
    
    <h1>Thêm Hình Ảnh</h1>
    <form action="?page=tintuc_themup" method="POST" enctype="multipart/form-data">
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" id="title" required><br>
        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br>
        <input type="submit" value="Tải lên">
    </form>
</body>
</html>

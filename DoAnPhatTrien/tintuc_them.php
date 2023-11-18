<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm</title>
    <style>
        body {
            
            background-image: url('image/body_bg.png');
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        
        h1 {
            text-align: center;
            color:#fff;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color:#fff;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            color:black;
        }
        input[type="submit"] {
            background-color: #3498db;
            color:#fff;
            border: none;
            padding: 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Thêm tin tức mới</h1>
    <form action="?page=tintuc_themup" method="POST" enctype="multipart/form-data">
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" id="title" required>
        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <input type="submit" value="Tải lên">
    </form>
</body>
</html>
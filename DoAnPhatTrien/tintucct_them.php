<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="?page=tintucct_themup" method="POST" enctype="multipart/form-data">
<label for="NewsID">IDNews</label>
<input type="text" name="NewsID" value="<?php echo isset($_GET['NewsID']) ? $_GET['NewsID'] : ''; ?>" readonly><br>
        <input type="text" name="title" id="title" style="width: 300px;height: 300px;" required><br>
        <label>
        <input type="radio" name="Form" value="1"> <img src="image/icon1.png">
        </label>
        <label>
            <input type="radio" name="Form" value="2"> <img src="image/icon2.png">
        </label>
        <label>
            <input type="radio" name="Form" value="3"> <img src="image/icon3.png">
        </label>
        <br>
        
        <label for="image">Hình ảnh</label>
        <input type="file" name="image" id="image" accept="image/*" required><br>
        <input type="submit" value="Tải lên">
        <br>
</form>
</body>
</html>
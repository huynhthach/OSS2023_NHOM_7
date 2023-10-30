<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .game-item {
    display: flex;
    background-color: #333;
    border: 2px solid #666;
    margin: 10px;
    padding: 10px;
    box-shadow: 3px 3px 6px #111;
}

.game-image img {
    max-width: 100px;
    height: auto;
    border: 2px solid #444;
}

.game-details {
    flex: 1;
    color: #fff;
}

.game-title {
    font-size: 20px;
    font-weight: bold;
    margin: 0;
}

.game-platform {
    font-size: 16px;
    margin: 0;
}

.play-now {
    background-color: #007bff;
    color: #fff;
    padding: 5px 10px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
}

.play-now:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    
    <h2>TIN TỨC</h2>
    <?php
    include 'Config.php';
     $query ='SELECT * FROM `news`';
     $result=$conn->query($query);
     if(!$result) die ('<br> <b>FAIL<br>');
     if (mysqli_num_rows($result) != 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="game-item">
            <div class="game-image">
                <img src="images/'.$row["image"].'"alt="404.jpeg" width="100" height="100">
            </div>
            <div class="game-details">
                <p class="game-platform">Ngày đăng:'.$row["PublishedDate"].'</p>
                <h3 class="game-title">'.$row["Title"].'</h3>
                <a href="tintuc_ct.php?id='.$row["NewsID"].'" class="play-now">Xem chi tiết</a>
            </div>
        </div>';
            
        }
    }
    echo "<a href='tintuc_them.php'>Thêm tin tức</a>";
    ?>
    <div>
        <div></div>
        <div></div>
    </div>
</body>
</html>
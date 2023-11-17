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
    
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center"style="background-image: url('image/breadcrum.png');">>
                        <div class="breadcrumb_iner_item">
                            <h2>Tin tức</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include 'Config.php';
    
     $query ='SELECT * FROM `news`';
     $result=$conn->query($query);
     if(!$result) die ('<br> <b>FAIL<br>');
     if (mysqli_num_rows($result) != 0) {
        while ($row = $result->fetch_assoc()) {
            echo'
        <article class="blog_item" style="margin-left:10%;border:2px">
            <div class="blog_item_img">
                <img class="card-img rounded-0" src="image/imageTin/'.$row["image"].'" style="width:40% "alt="">
                <a href="#" class="blog_item_date">
                    <h3>'.$row["PublishedDate"].'</h3>
                    <p>'.$row["PublishedDate"].'</p>
                </a>
            </div>

            <div class="blog_details">
                <a class="d-inline-block" href="tintuc_ct.php?id='.$row["NewsID"].'">
                    <h2 style="color:blue">'.$row["Title"].'</h2>
                </a>
                <ul class="blog-info-link">
                    <li><a href="#"><i class="far fa-user"></i> Author:'.$row["AuthorID"].'</a></li>
                </ul>
            </div>
        </article>';
            
        }
    }
    echo "<a href='?page=tintuc_them'>Thêm tin tức</a>";
    ?>
    <div>
        <div></div>
        <div></div>
    </div>
    
</body>
</html>
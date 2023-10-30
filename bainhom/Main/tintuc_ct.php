<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
    <?php
    $new_id = $_GET['id'];
    include 'Config.php';
    $query ='SELECT * FROM `news`
    INNER JOIN users ON news.AuthorID = users.UserID
    WHERE NewsID= '.$new_id;
     $result=$conn->query($query);
     if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo '<img src="images/'.$row["image"].'"alt="404.jpeg" width="100%" height="400">
        <div>
            <p>
            '.$row["PublishedDate"].'
            </p>
            <p>
            '.$row["Username"].'
            </p>
        </div>
        '
        ;
        $query ='SELECT * 
        FROM newsdetails WHERE NewsID='.$new_id.'
        ORDER BY ThuTu ASC';
        
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($row["ImagePath"]!=NULL)
                echo '<img src="images/'.$row["ImagePath"].'"alt="404.jpeg" width="70%" height="100">';
                echo '<p>'.$row["Content"].'</p>';
            }
        }

    }
    else 
    echo"Không tim thấy tin tức";
    

    ?>
</body>
</html>
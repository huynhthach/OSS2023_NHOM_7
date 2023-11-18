<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-image: url('image/body_bg.png')">
    
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
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-6 mb-lg-0">
                    <div class="blog_left_sidebar">
                    <?php
                        if(isset($_SESSION['UserID']))
                        if($_SESSION['Role']==2)
                        echo "<a href='?page=tintuc_them' style='font-size: 36px'>Thêm tin tức</a>";
                        include 'Config.php';
                        
                        $query ='SELECT * FROM `news` JOIN users ON news.AuthorID=users.UserID';
                        $result=$conn->query($query);
                        if(!$result) die ('<br> <b>FAIL<br>');
                        if (mysqli_num_rows($result) != 0) {
                            while ($row = $result->fetch_assoc()) {
                                $query2 ='SELECT COUNT(*) as count FROM comment JOIN news ON news.NewsID=comment.NewsID WHERE comment.NewsID='.$row["NewsID"];
                                $result2=$conn->query($query2);
                                $row2= $result2->fetch_assoc();
                                echo'
                            <article class="blog_item" style="margin-left:10%;border:2px">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="image/imageTin/'.$row["image"].'" style="width:40% "alt="">
                                    <a href="tintuc_ct.php?id='.$row["NewsID"].'" class="blog_item_date"style="background-color:blue">
                                        <h3>'.$row["PublishedDate"].'</h3>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="tintuc_ct.php?id='.$row["NewsID"].'">
                                        <h2 style="color:blue">'.$row["Title"].'</h2>
                                    </a>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="far fa-user"></i> Author:'.$row["Username"].'</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i>'.$row2["count"].' Comments</a></li>
                                    </ul>
                                </div>
                            </article>';
                                
                            }
                        }
                        
                        ?>
                    </div>
                    
                </div>
                <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Recent Post</h3>
                     <?php
                     include 'Config.php';
                     $query ='SELECT * FROM `news` JOIN users ON news.AuthorID=users.UserID ORDER BY news.PublishedDate DESC LIMIT 3';
                     $result=$conn->query($query);
                     if(!$result) die ('<br> <b>FAIL<br>');
                     if (mysqli_num_rows($result) != 0) {
                         while ($row = $result->fetch_assoc()) {
                             $query2 ='SELECT COUNT(*) as count FROM comment JOIN news ON news.NewsID=comment.NewsID WHERE comment.NewsID='.$row["NewsID"];
                             $result2=$conn->query($query2);
                             $row2= $result2->fetch_assoc();
                             echo'
                             <div class="media post_item">
                                <img style="width:30%" src="image/imageTin/'.$row["image"].'" alt="post">
                                <div class="media-body">
                                <a href="tintuc_ct.php?id='.$row["NewsID"].'">
                                    <h3>'.$row["Title"].'</h3>
                                </a>
                                <p>'.$row["PublishedDate"].'</p>
                                </div>
                            </div>
                             ';
                            }
                        }
                     ?>
                     
                  </aside>
               </div>
            </div>
            </div>
        </div>
    
    
    <div>
        <div></div>
        <div></div>
    </div>
    
</body>
</html>
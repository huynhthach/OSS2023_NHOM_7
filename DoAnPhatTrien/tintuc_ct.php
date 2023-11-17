<?php
include('index2.php');
?>
    <section class="breadcrumb breadcrumb_bg">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="breadcrumb_iner text-center">
                  <div class="breadcrumb_iner_item">
                     <h2>Chi tiết tin tức</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     
    <?php
    $new_id = $_GET['id'];
    include 'Config.php';
    $ID="";
    $query ='SELECT * FROM `news`
    INNER JOIN users ON news.AuthorID = users.UserID
    WHERE NewsID= '.$new_id;
     $result=$conn->query($query);
     if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ID=$row["NewsID"];
        echo'
        <img class="img-fluid" src="image/imageTin/'.$row["image"].'"alt="404.jpeg"">
                  </div>
                  <div class="blog_details">
                     <h2>'.$row["Title"].'
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="far fa-user"></i>'.$row["Username"].'</a></li>
                     </ul>  
        ';

        
        $query ='SELECT * 
        FROM newsdetails WHERE NewsID='.$new_id.'
        ORDER BY ThuTu ASC';
        
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($row["ImagePath"]!=NULL)
                    if($row['Form']==1){
                        echo '
                        <img class="img-fluid" src="image/imageTin/'.$row["ImagePath"].'"alt="404.jpeg"">
                            <p class="excert">
                            '.$row["Content"].'
                            </p>';
                            
                    }
                    if($row["Form"]==2){
                        echo '<p class="excert">
                        '.$row["Content"].'
                        </p>';
                    }
                    if($row["Form"]==3){
                        echo'
                        <section class="about_us section_padding">
                            <div class="container">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-md-5 col-lg-6 col-xl-6">
                                        <div class="learning_img">
                                            <img src="image/imageTin/'.$row["ImagePath"].'" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-6 col-xl-5">
                                        <div class="about_us_text">
                                            <p>'.$row["Content"].'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        ';
                    }
                
            }
        }
        echo '</section>';

    }
    else 
    echo"Không tim thấy tin tức";
    

    ?>
    <?php
  include 'script.php'
  ?>
</body>
</html>
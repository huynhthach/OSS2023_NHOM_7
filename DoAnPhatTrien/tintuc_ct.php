<style>
    textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
</style>
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
    if(isset($_GET['id']))
    $new_id = $_GET['id'];
    else
    $new_id = $_POST['NewsID'];

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
                        echo '<div class="quote-wrapper">
                        <div class="quotes">
                        '.$row["Content"].'
                        </div>
                     </div>';
                        
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
    <div class="comments-area" style="margin-left:10%;width:50%">
        <h4 style="color:blue">Comments</h4>
        <?php
        include('Config.php');
        $sql = "SELECT * FROM comment JOIN users ON comment.UserID = users.UserID WHERE comment.NewsID=".$new_id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo'<div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb">
                                <img src="image/'.$row["imageus"].'" alt="">
                            </div>
                            <div class="desc">
                                <p class="comment">
                                    '.$row["Message"].'
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                    <h5>
                                        <a href="#">'. $row["Username"] .'</a>
                                    </h5>
                                    <p class="date">'. $row["Date"] .'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>';
            }
        } else {
            echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
        }
        ?>
        
        <?php
    // Kết nối đến cơ sở dữ liệu
    include('Config.php');
    // Xử lý form bình luận khi được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Giá trị mặc định hoặc lấy thông tin từ người dùng
        $newsID = $_POST['NewsID'];
        $userID = $_POST['UserID'];
        $message = $_POST["Message"];
        $date = date("Y-m-d H:i:s"); // Lấy ngày giờ hiện tại

        // Thêm bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO comment (NewsID, UserID, Message, Date) VALUES ('$newsID', '$userID', '$message', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "Bình luận đã được thêm thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }

    // Đóng kết nối đến cơ sở dữ liệu
    $conn->close();
    ?>
    <?php
        if(isset($_SESSION['UserID']))
        echo'
        <form  action="#" id="commentForm" method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
            
                <input type="hidden" name="NewsID" value="'.$new_id.'">
                <input type="hidden" name="UserID" value="'.$_SESSION['UserID'].'">
                <label>Để lại bình luận:</label>
                <textarea name="Message" rows="4" cols="50" placeholder="Write your comment here..." required></textarea><br>
                <div class="form-group mt-3">
                        <button type="submit" value="Submit" class="button button-contactForm btn_1">Send Message <i
                              class="flaticon-right-arrow"></i> </button>
                     </div>
            </form> 
        ';

    ?>
    </div>
    
    <?php
  include 'script.php'
  ?>
</body>
</html>
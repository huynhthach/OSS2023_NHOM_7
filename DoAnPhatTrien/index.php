<!DOCTYPE html>
<html>
<head>
  <title>Trang Chủ</title>
  <style>
        h2 {
            color: #333;
        }

        p {
            margin: 10px 0;
            color: #555;
        }

        .balance {
            font-weight: bold;
            color: #27ae60;
        }
        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            padding: 10px 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
  <?php
  include 'deco.php';
  if(!isset($_SESSION['Exist'])){
    session_start();
    $_SESSION['Exist']=1;
  }
  
    ?>
</head>
<body>
<header class="main_menu single_page_menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="index.php"> <img src="image/arceus-logo.png" style="width:100px" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="fas fa-bars"></i></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="?page=trangchu">Home</a>
                                    </li>
                                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Buy
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="?page=shop"> Shop</a>
                                            <a class="dropdown-item" href="?page=daugia">Auction</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Discover
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="?page=tintuc"> News</a>
                                            <a class="dropdown-item" href="?page=guide">Guide</a>
                                        </div>
                                    </li>
                                    <?php
                                    if(isset($_SESSION['UserID']))
                                    echo '<li class="nav-item">
                                        <a class="nav-link" href="?page=moneycharge">Nạp tiền</a>
                                    </li>';
                                    ?>
                                    
                                    <li class="nav-item dropdown">
                                        
                                        <?php
                                        if(isset($_SESSION['UserID']))
                                        {
                                            if($_SESSION['UserID']==3){
                                                
                                                echo'<a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown1"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                AdminManage
                                            </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                                <a class="dropdown-item" href="?page=usermanager">UserManage</a>
                                                <a class="dropdown-item" href="?page=itemQuanLy">ItemManage</a>
                                                <a class="dropdown-item" href="?page=NewsManage">NewsManage</a>
                                            </div>';
                                            }
                                            
                                        }
                                        ?>
                                        
                                    </li>
                                </ul>
                            </div>
                            <a href="https://drive.google.com/file/d/1BDOKUN50aqOoYKjkmrVaDKw8395g1DYp/view?usp=sharing" class="btn_1 d-none d-sm-block">Install Now</a>
                            
                              <?php
                                if (isset($_SESSION['UserID'])) {
                                  $IdND = $_SESSION['UserID'];
                                  $Name=$_SESSION['UserName'];
                                  $SoDu=$_SESSION['SoDu'];
                                  $Quyen=$_SESSION['Role'];
                                
                                echo' <div class="user-info">
                                <h2>'.$Name.'</h2>
                                <p class="balance">Balance: '.$SoDu.'$</p>
                                <a href="dangxuat.php">LogOut</a>
                            </div>';
                                }
                                else
                                echo '<a href="?page=login">Login</a>
                                <a href="?page=regis">Regis</a>';
                              ?>
                        </nav>
                    </div>
                </div>
            </div>
            <div>
            <form action="search.php" method="GET" style="text-align: center;">
                <input type="text" name="search" id="search" style="width: 70%; border-radius: 20px; padding: 8px; box-sizing: border-box; border: none; background-color: #000; color: #fff;">
                <button type="submit" style="padding: 8px; border-radius: 20px; background-color: #333; color: #fff;">Search</button>
            </form>
            </div>
        </header>
  
  <div id="main-content">
    <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      include("$page.php");
    } else {
      include("trangchu.php");
    }
    ?>
  </div>
  <?php
  include 'script.php'
  ?>
</body>
</html>

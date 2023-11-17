<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><?php
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
                                        <a class="nav-link" href="index.php?page=trangchu">Home</a>
                                    </li>
                                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Buy
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="index.php?page=shop"> Shop</a>
                                            <a class="dropdown-item" href="index.php?page=auction">Auction</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Discover
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="index.php?page=tintuc"> News</a>
                                            <a class="dropdown-item" href="index.php?page=guide">Guide</a>
                                        </div>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contact</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown1"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            AdminManage
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                            <a class="dropdown-item" href="index.php?page=UsersManage">UserManage</a>
                                            <a class="dropdown-item" href="index.php?page=ItemsManage">ItemsManage</a>
                                            <a class="dropdown-item" href="?page=ItemsManage">NewsManage</a>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="btn_1 d-none d-sm-block">Install Now</a>
                            
                              <?php
                                if (isset($_SESSION['UserID'])) {
                                  $IdND = $_SESSION['UserID'];
                                  $Name=$_SESSION['UserName'];
                                  $SoDu=$_SESSION['SoDu'];
                                  $Quyen=$_SESSION['Role'];
                                
                                echo' <div class="user-info">
                                <h2>'.$Name.'</h2>
                                <p class="balance">Balance: '.$SoDu.'</p>
                                <a href="dangxuat.php">LogOut</a>
                            </div>';
                                }
                                else
                                echo '<a href="index.php?page=login">Login</a>
                                <a href="index.php?page=regis">Regis</a>';
                              ?>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
</body>
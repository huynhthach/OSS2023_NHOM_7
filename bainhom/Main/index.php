<!DOCTYPE html>
<html>
<head>
  <title>Trang Chủ</title>
  <style>
  ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333; /* Màu nền menu */
}

/* Định dạng các mục menu (li) */
li {
  float: left; /* Hiển thị các mục liên tiếp nhau ngang */
}

/* Định dạng liên kết trong các mục (a) */
li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Đổi màu liên kết khi hover */
li a:hover {
  background-color: #555; /* Màu nền khi hover */
}</style>
</head>
<body>
  <ul>
    <li><a href="?page=regis">Đăng ký</a></li>
    <li><a href="?page=login">Đăng nhập</a></li>
    <li><a href="?page=">Tải về</a></li>
  </ul>
  <ul>
    <li><a href="?page=trangchu">Trang chủ</a></li>
    <li><a href="?page=tintuc">Tin tức</a></li>
    <li><a href="?page=lienhe">Discover</a></li>
    <li><a href="?page=diendan">Cập nhật</a></li>
    <li><a href="?page=trangchu">Cửa hàng</a></li>
  </ul>
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
</body>
</html>

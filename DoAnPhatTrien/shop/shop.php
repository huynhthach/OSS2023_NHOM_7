<?php
include '../Config.php';
$sql = "SELECT * FROM Items WHERE sell = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/slick.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .no-products {
        color: white;
        
    }
        .invoice {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        width: 300px; 
    }

    .invoice-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .invoice p {
        margin: 5px 0;
    }

    .invoice strong {
        font-weight: bold;
    }
    .custom-styled-div {
    
    background-color: red; 
    padding: 20px;
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   
}
.custom-styled-div > * {
    display: inline-block;
    margin-right: 10px; /* Adjust the right margin as needed */
}

.custom-styled-div > *:last-child {
    margin-right: 0; /* Remove margin for the last element */
}
        .buy-button {
            background-color: #4CAF50; 
            color: white;
            padding: 15px 30px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       .Items img {
            max-width: 100%;
        }
        .Items-container {
            display: flex;
            flex-wrap: wrap;
            border-color: #3498db;
        }

        .Items {
            width: 30%; 
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            
        }
        body {
            background-color: black;
            color: white; /* Đổi màu chữ để nó dễ đọc trên nền đen */
        }
    </style>
</head>
<body >
    <h2>Shop</h2>
    <?php
    include 'xulymua.php'
    ?>
    <div class="custom-styled-div">
    <a href="themsp.php">Thêm Sản Phẩm</a>
    <?php
    include 'xulylocsanpham.php';
    include 'gosanphamkhoishop.php';
    include 'xulytimkiem.php';
    include 'vatphambian.php';
    include 'xulyhienthianh.php';
    ?>
</div>
</body>
</html>

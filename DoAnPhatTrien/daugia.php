<style>
    
    .our {
  background-color: #43424200;;
  padding-top: 90px;
}
.our .titlepage {
  text-align: left;
}
.our .two-box figure {
  margin:0px;
}
.our .Games {
  text-align: left;
}
.our .row{
  margin: 10px;
}
.our .Games h3 {
  color: whitesmoke;
  font-size: 30px;
  line-height: 30px;
  font-weight: 500;
  padding: 0;
}
.our .Games p {
  font-size: 17px;
  line-height: 30px;
  color: white;
  padding:20px 0px;
  font-weight: 400;
}
.our .Games a {
  font-size: 16px;
  border: #fff solid 1px;
  background-color: #000;
  color: #fff;
  padding: 10px 27px;
  display: inline-block;
}
.our .Games a:hover {
  background-color: #ff0000;
  border: #ff0000 solid 1px;
  color: #fff;
}
</style>
<div class="main-layout" style="background-image: url('image/body_bg.png')">
    <div id="games" class="our">
        <div class="container"style="margin-top:5%">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Games</h2>
                        <?php
                            if(isset($_SESSION['UserID']))
                            echo"<a href='?page=new_fightprice' class='btn btn-primary'>Đấu giá mới</a>";
                        ?>
                        
                    </div>
                </div>
            </div>
            <?php
            include "Config.php";
            // Truy vấn vật phẩm và tên người bán với categoryID là "DG"
            $categoryID = "DG";
            
            $query = "SELECT *
            FROM items
            JOIN reciept ON items.ItemID = reciept.ItemID
            JOIN users ON reciept.UserIDSell = users.UserID
            WHERE reciept.CategoryRecieptID = 'DG'
                      ";
            $result = $conn->query($query);
            
            if ($result === false) {    
                die("Lỗi trong truy vấn SQL: " . $conn->error);
            }
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if($row['State']==0){
                        $currentDays = strtotime($row["RecieptDate"]);
                        $time2day = strtotime($row["RecieptDateEnd"]);
                    ?>
                    <div class="col-md-12 margin_bottom">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="two-box">
                                    <figure><img src="image/iamgeItem/<?php echo $row["image"] ?>"></figure>
                                </div>
                            </div>

                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                <div class="Games">
                                    <h3><?php echo $row['ItemName']." - ".$row['Price']."$"; ?></h3>
                                    <p><?php echo $row['Description']; ?></p>
                                    <p>Người Bán: <?php echo $row['Username']; ?></p>
                                    <h4 class='remaining-time' data-start-time="<?php echo $currentDays ?>" 
                                    data-end-time="<?php echo $time2day ?>"
                                    data-receipt-id= "<?php echo $row['RecieptID'] ?>"></h4>
            
                                    <?php
                                    if(isset($_SESSION['UserID'])){
                                        
                                            echo "<a onclick='startAuction(" . $row['RecieptID'] . ")'>Đấu Giá</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
            } else {
                echo "Không có sản phẩm nào để hiển thị.";
            }
            ?>
        </div>
    </div>
</div>
<script>
    function startAuction(RecieptID) {
    // Tạo URL cho trang đấu giá
    var auctionURL = 'auction.php?RecieptID=' + RecieptID;

    // Mở cửa sổ nhỏ (popup)
    var popupWindow = window.open(auctionURL, '_blank', 'width=800, height=600');

    // Tùy chỉnh kích thước và các thuộc tính khác của cửa sổ popup theo nhu cầu
}
function updateRemainingTime() {
    var elements = document.getElementsByClassName('remaining-time');
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        var startTime = parseInt(element.getAttribute("data-start-time"));
        var endTime = parseInt(element.getAttribute("data-end-time"));
        var receiptId = parseInt(element.getAttribute("data-receipt-id"));
        
        var currentTime = Math.floor(Date.now() / 1000);
        var remainingTime = endTime - currentTime;

        var days = Math.floor(remainingTime / 86400);
        var hours = Math.floor(remainingTime / 3600) % 24;
        var minutes = Math.floor((remainingTime % 3600) / 60);
        var seconds = remainingTime % 60;

        element.textContent = "End of acution :"+ days + " ngày, " + hours + " giờ, " + minutes + " phút, " + seconds + " giây";

        if (remainingTime <= 0) {
            // Gọi hàm để cập nhật trạng thái trong cơ sở dữ liệu
            updateState(receiptId);
        }
    }
}

function updateState(receiptId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_state.php?receiptId=' + receiptId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send();
}

updateRemainingTime();
setInterval(updateRemainingTime, 1000);
</script>
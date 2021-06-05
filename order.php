
<?php include('partials-front/menu.php'); ?>

    <?php 
        //kiếm tra id đã đặt hay chưa
        if(isset($_GET['food_id']))
        {
            //Nhận id Thức ăn và thông tin chi tiết của thức ăn đã chọn
            $food_id = $_GET['food_id'];

            //Nhận thông tin chi tiết về thực phẩm đã chọn
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //Thực thi truy vấn
            $res = mysqli_query($conn, $sql);
            //Đếm các hàng
            $count = mysqli_num_rows($res);
            //Kiểm tra xem dữ liệu có sẵn hay không
            if($count==1)
            {
                
                //lấy dlieu từ csdl
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //trở lại trang chủ
                header('location:'.SITEURL);
            }
        }
        else
        {
            //trở lại trang chủ
            header('location:'.SITEURL);
        }
    ?>

    <!--  -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Xác nhận đơn đặt hàng</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Món đã chọn</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //Kiểm tra xem hình ảnh có sẵn hay không
                            if($image_name=="")
                            {
                                //k có hình ảnh
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //có ảnh
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?> VNĐ</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Số lượng</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Thông Tin Giao Hàng</legend>
                    <div class="order-label">Họ tên</div>
                    <input type="text" name="full-name" placeholder="Nhập họ tên..." class="input-responsive" required>

                    <div class="order-label">Số Điện Thoại</div>
                    <input type="tel" name="contact" placeholder="0989571xxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="huynq156@gmail.com" class="input-responsive" required>

                    <div class="order-label">Địa chỉ giao hàng</div>
                    <textarea name="address" rows="10" placeholder="... TP Hồ Chí Minh" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Hoàn tất" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                //Kiểm tra xem nút button
                if(isset($_POST['submit']))
                {
                    //Nhận tất cả

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; 

                    $order_date = date("Y-m-d h:i:s "); //h:i:s 

                    $status = "Ordered";  // trạng thái

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //lưu đơn hàng trong dtb
                    //tạo dtb để lưu dl
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    

                    //thực thi truy vấn
                    $res2 = mysqli_query($conn, $sql2);

                    //kiểm tra câu truy vấn
                    if($res2==true)
                    {
                        //thành công và lưu đơn hàng
                        $_SESSION['order'] = "<div class='success text-center'>Đặt Hàng Thành Công</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //thất bại và k lưu
                        $_SESSION['order'] = "<div class='error text-center'>Đặt Hàng Không Thành Công</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
  

    <?php include('partials-front/footer.php'); ?>
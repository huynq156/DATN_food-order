    <?php include('partials-front/menu.php'); ?>
    <link rel="stylesheet" href="css/style.css">

    <!-- Tìm kiếm thức ăn nhanh -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Tìm kiếm thức ăn..." required>
                <input type="submit" name="submit" value="Tìm Kiếm" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- kết thúc Tìm Kiếm-->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- Danh Mục -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Khám Phá Món Ngon</h2>

            <?php 
                //Tạo truy vấn SQL để hiển thị các danh mục từ cơ sở dữ liệu
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'  LIMIT 10";
                //thực thi truy vấn
                $res = mysqli_query($conn, $sql);
                //Đếm hàng để kiểm tra xem danh mục có sẵn hay không
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //DM có sẵn
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //nhận các giá trị id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //kiểm tra ảnh có sẵn hay k
                                    if($image_name=="")
                                    {
                                        //tạo thông báo
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //hình ảnh có sẵn
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- kết thúc -->



    <!-- Menu trang chủ -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Thực Đơn</h2>

            <?php 
            
            //Lấy Thực phẩm từ Cơ sở dữ liệu đang hoạt động và nổi bật
            //SQL Query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 12";

            //THỰC THI
            $res2 = mysqli_query($conn, $sql2);

            //đếm
            $count2 = mysqli_num_rows($res2);

            //kiemtra thức ăn có sẵn hay k
            if($count2>0)
            {
                //có sẵn
                while($row=mysqli_fetch_assoc($res2))
                {
                    //thì nhận tất cả các giá trị
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Kiểm tra xem hình ảnh có sẵn hay không
                                if($image_name=="")
                                {
                                    //k có sẵn
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
                                    //có sẵn
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?> VNĐ</p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-dm">Đặt món</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>

            <div class="clearfix"></div>
        </div>
        <div class="see_product__all">
            <p class="text-center">
                <a href="foods.php">Xem tất cả</a>
            </p>
        </div>
        
    </section>
    

    
    <?php include('partials-front/footer.php'); ?>
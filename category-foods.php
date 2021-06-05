    
    <?php include('partials-front/menu.php'); ?>

    <?php 
        // kiểm tra id
        if(isset($_GET['category_id']))
        {
            //lấy id danh mục
            $category_id = $_GET['category_id'];
            // lấy category từ id
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //thực thi truy vấn
            $res = mysqli_query($conn, $sql);

            //nhận gtri từ csdl
            $row = mysqli_fetch_assoc($res);

            $category_title = $row['title'];
        }
     
    ?>


    <!--  -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2><a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>


    <!--  -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Thực Đơn</h2>

            <?php 
            
                //Tạo truy vấn SQL để lấy thực phẩm dựa trên Danh mục đã chọn
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //thực thi truy vấn
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                //Kiểm tra xem thức ăn có sẵn hay không
                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        
                                        echo "<div class='error'>Không có hình ảnh</div>";
                                    }
                                    else
                                    {
                                       
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

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt Món</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food not available
                    echo "<div class='error'>Food not Available.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>

<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Trang Quản Trị</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">

                    <?php 
                        $sql = "SELECT * FROM tbl_category";
                        
                        $res = mysqli_query($conn, $sql);
                        
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Thể Loại
                </div>


                <div class="col-4 text-center">
                    <?php 
                        
                        $sql2 = "SELECT * FROM tbl_food";
                        
                        $res2 = mysqli_query($conn, $sql2);
                        
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Món Ăn
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                       
                        $sql3 = "SELECT * FROM tbl_order";
                       
                        $res3 = mysqli_query($conn, $sql3);
                       
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Đơn hàng
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        // Tạo truy vấn SQL để nhận Tổng doanh thu đã tạo
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Đã Giao Hàng'";

                        
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1><?php echo $total_revenue; ?> VNĐ</h1>
                    <br />
                    Tổng tiền
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include('partials/footer.php') ?>
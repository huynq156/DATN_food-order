<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý Danh Mục</h1>

        <br /><br />
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        
        ?>
        <br><br>

                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Thêm danh mục</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Hình</th>
                        <th>Trạng Thái</th>
                        <th>Chức năng</th>
                    </tr>

                    <?php 
                        $sql = "SELECT * FROM tbl_category";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        //tạo biến và gán gtri =1
                        $sn=1;

                        if($count>0)
                        {
                            //nếu có lấy dl và hiển thị
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>

                                        <td>

                                            <?php  
                                                
                                                if($image_name!="")
                                                {
                                                    
                                                    ?>
                                                    
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                                    
                                                    <?php
                                                }
                                                else
                                                {
                                                    
                                                    echo "<div class='error'>Không có hình ảnh</div>";
                                                }
                                            ?>

                                        </td>

                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa danh mục</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Xóa danh mục</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr>

                            <?php
                        }
                    
                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>
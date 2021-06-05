<?php include('partials/menu.php'); ?>


        <div class="main-content">
            <div class="wrapper">
                <h1>Quản lý quản trị viên</h1>

                <br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //hiển thị tb
                        unset($_SESSION['add']); 
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br><br><br>
                <a href="add-admin.php" class="btn-primary">Thêm Admin</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>TT</th>
                        <th>Họ và tên</th>
                        <th>Tài khoản</th>
                        <th>Chức năng</th>
                    </tr>

                    
                    <?php 
                        //truy vấn để nhận all
                        $sql = "SELECT * FROM tbl_admin";

                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            // Đếm hàng để kiểm tra có dữ liệu trong csdl hay không
                            $count = mysqli_num_rows($res); 

                            $sn=1; //tạo biến và gán gtri

                            
                            if($count>0)
                            {
                                
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    // Sử dụng vòng lặp While để lấy all dl
                                    // Và vòng lặp while sẽ chạy miễn là có dl trong csdl
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                   
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi Mật Khẩu</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhập</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xóa Admin</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                               
                            }
                        }

                    ?>


                    
                </table>

            </div>
        </div>

<?php include('partials/footer.php'); ?>
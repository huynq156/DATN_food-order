<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //ktra session
            {
                echo $_SESSION['add']; //thông báo session nếu set
                unset($_SESSION['add']); //xóa tb
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Họ và tên: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Nhập họ và tên">
                    </td>
                </tr>

                <tr>
                    <td>Tài khoản: </td>
                    <td>
                        <input type="text" name="username" placeholder="Nhập tài khoản">
                    </td>
                </tr>

                <tr>
                    <td>Mật Khẩu: </td>
                    <td>
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    //xử lý gtri từ biểu mẫu và lưu trong dtb

    //Kiểm tra xem nút gửi có được nhấp hay không

    if(isset($_POST['submit']))
    {
        // Button Clicked

        //Lấy dữ liệu từ biểu mẫu
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //Truy vấn SQL để lưu dữ liệu vào dtb
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //thực thi truy vấn và lưu dl vào dtb
        $res = mysqli_query($conn, $sql);

        //ktra dlieu
        if($res==TRUE)
        {
            //chèn dlieu
            //hien thi thong bao
            $_SESSION['add'] = "<div class='success'>Thêm Admin thành công!</div>";
            
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //chèn dl thất bại
            $_SESSION['add'] = "<div class='error'>Thêm Admin thất bại!!</div>";
            
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>
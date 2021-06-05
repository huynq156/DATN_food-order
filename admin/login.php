<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Đăng Nhập</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Đăng Nhập Trang Admin</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
            Tài khoản: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Mật Khẩu: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
        </div>

    </body>
</html>


<?php 

    
    if(isset($_POST['submit']))
    {
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //check tk & mk có tồn tại k
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        
        $res = mysqli_query($conn, $sql);

        
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            
            $_SESSION['login'] = "<div class='success'>Đăng Nhập Thành Công</div>";
            $_SESSION['user'] = $username; 

            
            header('location:'.SITEURL.'admin/');
        }
        else
        {
           
            $_SESSION['login'] = "<div class='error text-center'>Tài khoản hoặc Mật khẩu không đúng.</div>";
            
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>
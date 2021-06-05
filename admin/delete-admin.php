<?php 

    
    include('../config/constants.php');

    //lấy id admin bị xóa
    $id = $_GET['id'];

    //2. Tạo truy vấn SQL để xóa admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    
    if($res==true)
    {
        
       
        $_SESSION['delete'] = "<div class='success'>Xóa tài khoản thành công.</div>";
        
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {

        $_SESSION['delete'] = "<div class='error'>Xóa thất bại. Vui lòng thử lại sau...</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>
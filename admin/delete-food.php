<?php 
    include('../config/constants.php');



    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        //get id và hình
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //dele food từ dtb
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        
        $res = mysqli_query($conn, $sql);

        
        if($res==true)
        {
            
            $_SESSION['delete'] = "<div class='success'>Xóa món ăn thành công.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            
            $_SESSION['delete'] = "<div class='error'>Xóa món ăn thất bại.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
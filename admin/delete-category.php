<?php 
    include('../config/constants.php');

   
    // Kiểm tra xem giá trị id và image_name đã được đặt hay chưa
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //lấy gtri và xóa
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        
        // if($image_name != "")
        // {
            
        //     $path = "../images/category/".$image_name;

        //     $remove = unlink($path);

            
        //     if($remove==false)
        //     {
                
        //         $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
               
        //         header('location:'.SITEURL.'admin/manage-category.php');
               
        //         die();
        //     }
        // }

        //Delete Data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        
        $res = mysqli_query($conn, $sql);

        //ktra thử dlieu có bị xóa hay k
        if($res==true)
        {
            
            $_SESSION['delete'] = "<div class='success'>Đã xóa danh mục thành công.</div>";
            
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            
            $_SESSION['delete'] = "<div class='error'>Xóa danh mục thất bại.</div>";
            
            header('location:'.SITEURL.'admin/manage-category.php');
        }

 

    }
    else
    {
        
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
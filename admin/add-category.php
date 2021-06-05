<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm thể loại món</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tên món: </td>
                    <td>
                        <input type="text" name="title" placeholder="">
                    </td>
                </tr>

                <tr>
                    <td>Hình Ảnh: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
<!-- 
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr> -->

                <tr>
                    <td>Trạng Thái: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            //Kiểm tra xem nút gửi có được nhấp hay không
            if(isset($_POST['submit']))
            {
                //Nhận Giá trị từ Biểu mẫu thể loại món
                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                    //lấy value
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                if(isset($_FILES['image']['name']))
                {
                   
                    $image_name = $_FILES['image']['name'];
                    
                    
                    if($image_name != "")
                    {

                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        
                        if($upload==false)
                        {
                            
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            
                            header('location:'.SITEURL.'admin/add-category.php');
                            
                            die();
                        }

                    }
                }
                else
                {
                    
                    $image_name="";
                }

                //Tạo truy vấn SQL để chèn CAtegory vào cơ sở dữ liệu
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    
                    $_SESSION['add'] = "<div class='success'>Thêm thể loại món thành công.</div>";
                    
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    
                    $_SESSION['add'] = "<div class='error'>Thêm thể loại món thất bại.</div>";
                    
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Món</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Tên Món: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Mô Tả: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Thêm hình ảnh: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Thể loại: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // Tạo mã PHP để hiển thị các danh mục từ Cơ sở dữ liệu
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                
                                $res = mysqli_query($conn, $sql);

                                // Đếm hàng để kiểm tra xem chúng ta có danh mục hay không
                                $count = mysqli_num_rows($res);

                                
                                if($count>0)
                                {
                                    
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // lấy thông tin chi tiết của các danh mục
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Có 
                        <input type="radio" name="featured" value="No"> Không
                    </td>
                </tr>

                <tr>
                    <td>Trạng Thái: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Còn hàng 
                        <input type="radio" name="active" value="No"> Hết hàng
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm món mới" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //ktra nút nhấp
            if(isset($_POST['submit']))
            {
                //thêm food vào dtb
                
                //1. Get DAta
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //gửi gtri mđ
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                
                if(isset($_FILES['image']['name']))
                {
                    
                    $image_name = $_FILES['image']['name'];

                    
                    if($image_name!="")
                    {
                       
                        $ext = end(explode('.', $image_name));

                        
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                        

                       
                        $src = $_FILES['image']['tmp_name'];

                        
                        $dst = "../images/food/".$image_name;

                      
                        $upload = move_uploaded_file($src, $dst);

                        //ktra hình có dc tải lên chưa
                        if($upload==false)
                        {
                            
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; 
                }

                //3. chèn vào csdl

                //Create a SQL Query to Save or Add food
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                
                $res2 = mysqli_query($conn, $sql2);

              
                if($res2 == true)
                {
                    
                    $_SESSION['add'] = "<div class='success'>Thêm món mới thành công.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    
                    $_SESSION['add'] = "<div class='error'>Thêm món mới thất bại.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
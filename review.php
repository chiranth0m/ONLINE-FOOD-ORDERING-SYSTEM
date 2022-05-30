<?php include('partials-food/menu.php'); ?>

<?php 
    if(isset($_GET['food_id']))
    {
        $food_id=$_GET['food_id'];

        $sql="SELECT * FROM tbl_food WHERE id=$food_id";

        $res=mysqli_query($conn, $sql);

        $count=mysqli_num_rows($res);

        if($count==1){
            $row=mysqli_fetch_assoc($res);

            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
        }
        else{
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }
?>



<!-- food section starts here -->
<section class="categories">
    <div class="container">

    



        <div class="food-menu-box">
            <div class="food-menu-img">
                <?php 
                    
                    if($image_name=="")
                    {
                        
                        echo "<div class='error'>Image not available.</div>";
                    }
                    else
                    {
                        
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                ?>
                
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price">$<?php echo $price; ?></p>
                <p class="food-detail">
                    <?php echo $description; ?>
                </p>
                <br>

                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                <a href="<?php echo SITEURL; ?>add_review.php?food_id=<?php echo $id; ?>" class="btn btn-hprimary">add_review</a>
            </div>
        </div>

        <div class="clearfix"></div>

    </div>
</section>
<!-- food-section ends here -->


<section class="food-menu">
    <div class="container">

                
            

                <?php
                
                $sql2="SELECT customer_review, customer_name FROM tbl_review where food_id=$food_id";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0){
                    while($row=mysqli_fetch_assoc($res2)){
                        $customer_review=$row['customer_review'];
                        $customer_name=$row['customer_name'];
                        
                        ?>
                            <div class="food-menu-box">
                                <strong><?php echo $customer_review; ?> </strong>
                                <br><br>
                                
                                <?php echo 'by'; echo ' '; echo $customer_name;?> 
                            </div>
                            
                        <?php

                    }
                }
                else{
                    echo "<div class='error'>no review for this food.</div>";
                }
            ?>


        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-food/footer.php'); ?>

 
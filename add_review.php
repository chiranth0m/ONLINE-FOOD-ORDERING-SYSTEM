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

            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else{
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-review-s">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to add review.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php 
                            if($image_name==""){
                                echo "<div class='error'>image is not available</div>";
                            }
                            else{

                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>

                        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>user data and review</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijay.com" class="input-responsive" required>

                    <div class="order-label">review</div>
                    <textarea name="review" rows="10" placeholder="E.g. food is very testy" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="add review" class="btn btn-primary">
                </fieldset>

            </form>
                <?php

                if(isset($_POST['submit'])){

                    $food_id=$_POST['food_id'];
    

                    $review_date=date("Y-m-d h:i:sa");

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_review = $_POST['review'];
                    

                    $sql2 = "INSERT INTO tbl_review SET 
                        food_id = '$food_id',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_review = '$customer_review',
                        review_date = '$review_date'
                    ";


                    $res2 = mysqli_query($conn, $sql2);


                    if($res2==true){
                        $_SESSION['review_add'] = "<div class='success text-center'>review added Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        $_SESSION['review_add'] = "<div class='error text-center'>Failed to add review.</div>";
                        header('location:'.SITEURL);
                    }

                
                }
                 

                ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-food/footer.php'); ?>
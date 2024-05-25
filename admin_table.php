<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><Menu></Menu></title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
    .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   justify-content: center;
   gap:1.5rem;
   max-width: 1200px;
   margin:0 auto;
   align-items: flex-start;
}

.box-container .box{
   background-color: var(--white);
   padding:2rem;
   border:var(--border);
   box-shadow: var(--box-shadow);
   border-radius: .5rem;
}

.box-container .box p{
   padding-bottom: 1rem;
   font-size: 2rem;
   color:var(--light-color);
}

.box-container .box p span{
   color:var(--purple);
}

.box-container .box form{
   text-align: center;
}

.box-container .box form select{
   border-radius: .5rem;
   margin:.5rem 0;
   width: 100%;
   background-color: var(--light-bg);
   border:var(--border);
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--black);
}
   </style>
   
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <a href = "admin_orders.php">
    <h1 class="title">orders placed</h1>
</a>
</section>

<section >


   <div class="box-container">

      <?php
         $address = $_GET['address'];
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE address = ?");
         $select_orders->bind_param("s", $address);
         $select_orders->execute();
         $result = $select_orders->get_result();
         if ($result->num_rows > 0) {
            while ($fetch_orders = $result->fetch_assoc()) {
      ?>
     
     <div class="box">
         <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p style ="color:limegreen;font-weight:bold;">Table Number :  <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Customer Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Contact No. : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total price : <span>Rs <?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <input type="submit" value="update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>








<!-- custom js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
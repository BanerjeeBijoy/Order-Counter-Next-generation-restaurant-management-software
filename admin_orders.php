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
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      .category .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr));
   gap:1.5rem;
   align-items: flex-start;
}

.category .box-container .box{
   border:var(--border);
   padding:2rem;
   text-align: center;
}

.category .box-container .box img{
   width: 100%;
   height: 10rem;
   object-fit: contain;
}

.category .box-container .box h3{
   font-size: 2rem;
   margin-top: 1.5rem;
   color:var(--black);
   text-transform: capitalize;
}
.category .box-container .box h2{
   font-size: 3rem;
   font-weight:bold;
   margin-top: 1.5rem;
   color: limegreen ;
   text-transform: capitalize;
}
.category .box-container #t1:hover{
   background-color: var(--black);
}
.category .box-container #t2:hover{
   background-color: var(--black);
}
.category .box-container #t3:hover{
   background-color: var(--black);
}
.category .box-container #t4:hover{
   background-color: var(--black);
}
.category .box-container #t5:hover{
   background-color: var(--black);
}
.category .box-container #t6:hover{
   background-color: var(--black);
}
.category .box-container #t7:hover{
   background-color: var(--black);
}
.category .box-container #t8:hover{
   background-color: var(--black);
}
.category .box-container #t9:hover{
   background-color: var(--black);
}
.category .box-container #t10:hover{
   background-color: var(--black);
}.category .box-container #t11:hover{
   background-color: var(--black);
}
.category .box-container #t12:hover{
   background-color: var(--black);
}

.category .box-container .box:hover img{
   filter: invert(1);
}

.category .box-container .box:hover h3{
   color:var(--white);
}
.category .box-container .box:hover h2{
   color:var(--white);
}



   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<?php
// Establish a connection to the database
include 'config.php';

// Retrieve data from the "orders" table
$sql = "SELECT address, payment_status FROM orders";
$result = mysqli_query($conn, $sql);

// Loop through each row of data
while ($row = mysqli_fetch_assoc($result)) {
  // Determine the appropriate div id based on the address value
  $div_id = "t" . $row["address"];
  
  // Determine the appropriate background color based on the payment_status value
  $bg_color = ($row["payment_status"] == "pending") ? "#9867C5" : "white";
  
  // Apply the background color to the div with the corresponding id
  echo "<style>#$div_id { background-color: $bg_color; }</style>";
}

// Close the database connection
mysqli_close($conn);
?>



<section class="orders">

   <h1 class="title">orders placed</h1>

   <section class="category">

   <div class="box-container">

      <a href="admin_table.php?address=1" id= "t1" class="box">
        
         <h3>TABLE </h3> <h2> 1</h2>
      </a>

      <a href="admin_table.php?address=2" id= "t2" class="box">
         
         <h3>TABLE </h3> <h2> 2</h2>
      </a>

      <a href="admin_table.php?address=3" id= "t3" class="box">
        
         <h3>TABLE  </h3> <h2> 3</h2>
      </a>

      <a href="admin_table.php?address=4" id= "t4" class="box">
        
         <h3>TABLE  </h3> <h2> 4 </h2>
      </a>
      <a href="admin_table.php?address=5" id= "t5" class="box">
        
         <h3>TABLE  </h3> <h2> 5</h2>
      </a>

      <a href="admin_table.php?address=6" id= "t6" class="box">
         
         <h3>TABLE </h3> <h2> 6</h2>
      </a>

      <a href="admin_table.php?address=7" id= "t7" class="box">
        
         <h3>TABLE </h3> <h2> 7</h2>
      </a>

      <a href="admin_table.php?address=8" id= "t8" class="box">
        
         <h3>TABLE </h3> <h2> 8</h2>
      </a>
      <a href="admin_table.php?address=9" id= "t9" class="box">
        
         <h3>TABLE </h3> <h2> 9</h2>
      </a>

      <a href="admin_table.php?address=10" id= "t10" class="box">
         
         <h3>TABLE </h3> <h2> 10</h2>
      </a>

      <a href="admin_table.php?address=11" id= "t11" class="box">
        
         <h3>TABLE </h3> <h2> 11</h2>
      </a>

      <a href="admin_table.php?address=12" id= "t12" class="box">
        
         <h3>TABLE  </h3> <h2> 12</h2>
      </a>



   </div>

  </section>

  <!-- <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
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
   </div>-->

</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
<?php
  require_once('functions/function.php');
  get_header();
 ?>
 <div class="profile-area">
   <div class="container">
     <div class="row">
       <div class="col-md-12 col-sm-12">

     <div class="card text-center">
   <div class="card-header" style="background:#003366;">
     <h3 style="float:left;color:#ffffff;">Profile Information</h3>
     <a style="float:right;" href="logout.php" class="btn btn-primary">Log Out</a>
   </div>
   <div class="card-body">
     <!---->
     <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order Status</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="returnpolicy-tab" data-toggle="tab" href="#returnpolicy" role="tab" aria-controls="returnpolicy" aria-selected="false">Return Policy</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="sellbook-tab" data-toggle="tab" href="#sellbook" role="tab" aria-controls="sellbook" aria-selected="false">Old Book Sell</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="orderaccept-tab" data-toggle="tab" href="#orderaccept" role="tab" aria-controls="orderaccept" aria-selected="false">Earn Money</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <br><br>
    <table class="table table-bordered table-striped table-responsive table-danger view_table_cus">
      <tr>
        <td>User ID</td>
          <td>:</td>
          <td><?= $_SESSION['user_id']; ?></td>
      </tr>
      <tr>
          <td>Name</td>
            <td>:</td>
            <td><?= $_SESSION['user_fullname']; ?></td>
        </tr>
        <tr>
          <td>Username</td>
            <td>:</td>
            <td><?= $_SESSION['user_username']; ?></td>
        </tr>
        <tr>
          <td>Email</td>
            <td>:</td>
            <td><?= $_SESSION['user_email']; ?></td>
        </tr>
        <tr>
          <td>Roll</td>
            <td>:</td>
            <td><?= $_SESSION['user_roll']; ?></td>
        </tr>
        <tr>
          <td>Mobile</td>
            <td>:</td>
            <td><?= $_SESSION['user_contact']; ?></td>
        </tr>

        <tr>
          <td>Password</td>
            <td>:</td>
            <td><?= $_SESSION['user_password']; ?></td>
        </tr>
    </table>
    <br> <a href="edit-profile.php?ed=<?= $_SESSION['user_id']; ?>" class="btn btn-primary">Edit Profile</a>
  </div>

  <div class="tab-pane fade" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">
    <br><br>
    <h5>Your Order Status.</h5>
    <h6>If Order Status is Hold, than As soon as Admin will contact to you and approve your order.</h6>
    <br>
    <h5></h5>

          <table class="table table-responsive table-bordered table-striped table-hover table_cus">
              <thead class="table_head">
                <tr>
                    <th>Order ID</th>
                    <th>Book Title</th>
                    <th>Price</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
              </thead>
                <tbody>
                  <?php
                  $sel="SELECT * FROM adm_billing_info";
                  $Quy=mysqli_query($con,$sel);
                  while($info=mysqli_fetch_assoc($Quy)){
                    if ($_SESSION['user_username'] == $info['username']){
                    ?>
                  <tr>
                    <td><?= $info['orderid']; ?></td>
                    <td><?= $info['product_name']; ?></td>
                    <td><?= $info['price']; ?></td>
                    <td><?= $info['orderdate']; ?></td>
                    <td><?= $info['orderStatus']; ?></td>
                  </tr>
                  <?php
                  } }
                  $sel="SELECT * FROM adm_approve_orderlist";
                  $Quy=mysqli_query($con,$sel);
                    while($info=mysqli_fetch_assoc($Quy)){
                      if ($_SESSION['user_username'] == $info['username']){
                  ?>
                  <tr>
                      <td><?= $info['orderid']; ?></td>
                      <td><?= $info['product_name']; ?></td>
                      <td><?= $info['price']; ?></td>
                      <td><?= $info['orderdate']; ?></td>
                      <td><?= $info['orderStatus']; ?></td>
                  </tr>
                <?php }} ?>
                </tbody>
          </table>

  </div>
  <div class="tab-pane fade" id="returnpolicy" role="tabpanel" aria-labelledby="returnpolicy-tab">
<br><br>
   <h5>Return Policy</h5>
   <?php
   $rid=rand(10000,90000);
       if(isset($_POST['draft'])){
           $orderid=$_POST['orderid'];
           $reason=$_POST['reason'];
           $comment=$_POST['comment'];
           $username=$_POST['username'];
           $contact=$_POST['contact'];
           $email=$_POST['email'];


           $insert="INSERT INTO adm_returnbook(returnid,orderid,reason,comment,username,contact,email)
           VALUES('$rid','$orderid','$reason','$comment','$username','$contact','$email')";

           if(mysqli_query($con,$insert)){
               echo '<script>alert("Successfully send.")</script>';
           }else{
               echo '<script>alert("Please, Try again.")</script>';
           }
       }
   ?>
   <form method="post">
     <div class="mb-3">
       <label class="form-label">Return ID</label>
       <input type="text" class="form-control" name="returnid" value="<?= $rid; ?>" disabled>
     </div>
     <div class="mb-3">
       <label class="form-label">Order ID</label>
       <input type="text" class="form-control" name="orderid" placeholder="Enter your Order ID" required>
       <input type="hidden" class="form-control" name="username" value="<?= $_SESSION['user_username']; ?>">
       <input type="hidden" class="form-control" name="contact" value="<?= $_SESSION['user_contact']; ?>">
       <input type="hidden" class="form-control" name="email" value="<?= $_SESSION['user_email']; ?>">
     </div>
     <div class="mb-3">
       <label class="form-label">Return Reason</label>
        <textarea class="form-control" name="reason" rows="3" placeholder="Return Reason" required></textarea>
     </div>
     <div class="mb-3">
       <label class="form-label">Additional Comment</label>
        <textarea class="form-control" name="comment" placeholder="Additional Comment" rows="3"></textarea>
     </div>
     <button type="submit" class="btn btn-primary" name="draft">Draft Off</button>
   </form>
  </div>
  <div class="tab-pane fade" id="sellbook" role="tabpanel" aria-labelledby="sellbook-tab">
    <br>
    <h6>Your Old Book Sell Info</h6>
    <table class="table table-responsive table-bordered table-striped table-hover table_cus">
        <thead class="table_head">
          <tr>
              <th>Book Title</th>
              <th>Book Author</th>
              <th>Book Price</th>
              <th>Contact</th>
              <th>Status</th>
          </tr>
        </thead>
          <tbody>
            <?php
            $sel="SELECT * FROM adm_sechandbook";
            $Quy=mysqli_query($con,$sel);
            while($info=mysqli_fetch_assoc($Quy)){
              if ($_SESSION['user_username'] == $info['username']){
              ?>
            <tr>
              <td><?= $info['secbook_title']; ?></td>
              <td><?= $info['secbook_author']; ?></td>
              <td><?= $info['secbook_price']; ?></td>
              <td><?= $info['seller_num']; ?></td>
              <td><button type="btn btn-sm-primary" name="button" style="background:#0066ff;color:#ffffff;" disabled>Not Sell</button></td>
            </tr>
            <?php
          } } ?>

          </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="orderaccept" role="tabpanel" aria-labelledby="orderaccept-tab">
    <br>
    <h6>Your Accepted Order Info</h6>
    <table class="table table-responsive table-bordered table-striped table-hover table_cus">
        <thead class="table_head">
          <tr>
              <th>Order No</th>
              <th>Book Title</th>
              <th>Book Author</th>
              <th>Edition</th>
              <th>Quantity</th>
              <th>Status</th>
          </tr>
        </thead>
          <tbody>
            <?php
            $user=$_SESSION['user_username'];
            $s="SELECT * FROM adm_earnmoney_order_accept WHERE username='$user'";
            $Q=mysqli_query($con,$s);
            while($info=mysqli_fetch_assoc($Q)){
              $number=$info['orderNo'];
              $sel="SELECT * FROM adm_active_reqbook WHERE orderNo='$number'";
              $Quy=mysqli_query($con,$sel);
              while($data=mysqli_fetch_assoc($Quy)){ ?>
            <tr>
              <td><?= $info['orderNo']; ?></td>
              <td><?= $data['req_title']; ?></td>
              <td><?= $data['req_author']; ?></td>
              <td><?= $data['req_edition']; ?></td>
              <td><?= $data['req_quantity']; ?></td>
              <td> <button type="btn btn-sm-primary" name="button" style="background:#0066ff;color:#ffffff;" disabled>Not Complete</button> </td>
            </tr>
            <?php
             }
              }
                ?>
          </tbody>
    </table>
  </div>
</div>
     <!---->
    </div>
  </div>
   </div>
 </div>
   </div>
 </div>
  <?php
   get_footer();
   ?>

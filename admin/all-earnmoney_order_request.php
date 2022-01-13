<?php
    require_once('functions/function.php');
    needLogged();
    if($_SESSION['role']=='1'){
    get_header();
    get_sidebar();


?>
    <div class="col-md-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-md-9 heading_title">
                    All Earnmoney Order Request
                 </div>
                 <div class="col-md-3 text-right">
                 	<!--<a href="add-donatebook.php" class="btn btn-sm btn btn-primary"><i class="fa fa-plus-circle"></i> Add donate book</a>-->
                </div>
                <div class="clearfix"></div>
            </div>
          <div class="panel-body">
              <table class="table table-responsive table-striped table-hover table_cus">
              		<thead class="table_head">
                		<tr>
                      	<th>Full Name</th>
                        <th>Mobile Number</th>
                        <th>Order No</th>
                        <th>Username</th>
                        <th>Manage</th>
                    </tr>
                	</thead>
                    <tbody>
                      <?php
                          $sel="SELECT * FROM adm_earnmoney_order_accept ORDER BY id DESC";
                          $Q=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_assoc($Q)){
                      ?>
                    	<tr>
                          <td><?= $data['fname']; ?></td>
                          <td><?= $data['mobile']; ?></td>
                          <td><?= $data['orderNo']; ?></td>
                          <td><?= $data['username']; ?></td>
                          <td>
                          	<a href="view-earnmoney_order_request.php?v=<?= $data['id']; ?>"><i class="fa fa-eye fa-lg"></i></a>
                              <a href="delete-earnmoney_order_request.php?d=<?= $data['id']; ?>"><i class="fa fa-trash fa-lg"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                    </tbody>
              </table>
          </div>
          <div class="panel-footer">
            <div class="col-md-4">
            	<a href="#" class="btn btn-sm btn-warning">EXCEL</a>
                <button onclick="window.print()" class="btn btn-sm btn-info" type="button">PDF</button>
                <a href="#" class="btn btn-sm btn-danger">SVG</a>
                <button onclick="window.print()" class="btn btn-sm btn-success" type="button">PRINT</button>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-right">

            </div>
            <div class="clearfix"></div>
          </div>
        </div>
    </div><!--col-md-12 end-->
<?php
    get_footer();
  }else{
      echo "Access Denied! You have no permission access this page.";
  }
?>

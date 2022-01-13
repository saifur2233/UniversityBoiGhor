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
                    All User Information
                 </div>
                 <div class="col-md-3 text-right">
                 	<a href="add-user.php" class="btn btn-sm btn btn-primary"><i class="fa fa-plus-circle"></i> Add User</a>
                </div>
                <div class="clearfix"></div>
            </div>
          <div class="panel-body">
              <table class="table table-responsive table-striped table-hover table_cus">
              		<thead class="table_head">
                		<tr>
                      	<th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>UserRole</th>
                        <th>Photo</th>
                        <th>Manage</th>
                    </tr>
                	</thead>
                    <tbody>
                      <?php
                          $sel="SELECT * FROM adm_user NATURAL JOIN adm_role ORDER BY user_id DESC";
                          $Q=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_assoc($Q)){
                      ?>
                    	<tr>
                        	<td><?php echo $data['user_name'];?></td>
                          <td><?= $data['user_email']; ?></td>
                          <td><?= $data['user_phone']; ?></td>
                          <td><?= $data['user_username']; ?></td>
                          <td><?= $data['role_name']; ?></td>
                          <td>
                              <?php
                                if($data['user_pic']!=''){
                              ?>
                                <img width="50" src="uploads/<?= $data['user_pic']; ?>" alt="Image"/>
                              <?php
                                }else{
                              ?>
                                <img width="50" src="images/avatar.png" alt="Image"/>
                              <?php } ?>
                          </td>
                          <td>
                          	<a href="view-user.php?v=<?= $data['user_id']; ?>"><i class="fa fa-plus-square fa-lg"></i></a>
                              <a href="edit-user.php?ed=<?= $data['user_id']; ?>"><i class="fa fa-pencil-square fa-lg"></i></a>
                              <a href="delete-user.php?del=<?= $data['user_id']; ?>"><i class="fa fa-trash fa-lg"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                    </tbody>
              </table>
          </div>
          <div class="panel-footer">
            <div class="col-md-4">
            	<a href="#" class="btn btn-sm btn-warning">EXCEL</a>
                <a href="#" class="btn btn-sm btn-primary">PDF</a>
                <a href="#" class="btn btn-sm btn-danger">SVG</a>
                <a href="#" class="btn btn-sm btn-success">PRINT</a>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-right">
            	<nav aria-label="Page navigation">
                  <ul class="pagination pagina_cus">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
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

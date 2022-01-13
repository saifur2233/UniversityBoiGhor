<?php
    require_once('functions/function.php');
    needLogged();
    get_header();
    get_sidebar();
?>
    <div class="col-md-12">
    	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-md-9 heading_title">
                    All Subscriber
                 </div>
                 <div class="col-md-3 text-right">
                 	<a href="all-subscriber.php" class="btn btn-sm btn btn-primary"><i class="fa fa-th"></i> All Subscriber</a>
                </div>
                <div class="clearfix"></div>
            </div>
          <div class="panel-body">
           <?php
           $sel="SELECT * FROM adm_subscribers ORDER BY subscriber_id DESC";
           $Q=mysqli_query($con,$sel);
           while($data=mysqli_fetch_assoc($Q)){
               if(!empty($_POST)){

                 $receiver=$data['subscriber_email'];;
                 $subject=$_POST['subject'];
                 $message=$_POST['message'];
                 $sender="From: amazinginfotechbd@gmail.com";

                 if (mail($receiver, $subject, $message, $sender)){
                   echo '<script>alert("Mail sent.")</script>';
                 }else {
                   echo '<script>alert("Mail not sent.")</script>';
                 }
               }
             }
            ?>
              <div class="form-group">
                <label for="" class="col-sm-3 control-label">From:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="fromemail" value="amazinginfotechbd@gmail.com" disabled>
                </div>
              </div>

              <div class="form-group">
                <label for="" class="col-sm-3 control-label">Subject:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="subject">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-3 control-label">Message</label>
                <div class="col-sm-4">
                  <textarea class="form-control" rows="8" name="message"></textarea>
                </div>
              </div>


          </div>
          <div class="panel-footer text-center">
            <button class="btn btn-sm btn-primary">Send Notification</button>
          </div>
        </div>
        </form>
    </div><!--col-md-12 end-->
<?php
    get_footer();
?>

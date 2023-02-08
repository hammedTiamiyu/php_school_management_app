<?php 
session_start();
include("includes/config.php");
error_reporting(0);
if(strlen($_SESSION['login'])==0){
  header('location:index.php');
}else{
  date_default_timezone_set('Africa/Lagos');
  $currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit'])){
  if(empty($_POST['currentpassword'] || $_POST['newpassword'] || $_POST['confirmpassword'])){
    $_SESSION['msg']="Fill all the neccesary field";
  } elseif($_POST['newpassword']!== $_POST['confirmpassword']){
    $_SESSION['msg']="New password missmatched";
  } else
  {
  $curentpwd=md5($_POST['currentpassword']);
  $newpwd=md5($_POST['newpassword']);
  $confpwd=md5($_POST['confirmpassword']);

  $query = mysqli_query($con, "SELECT password FROM students WHERE password='$curentpwd' && studentRegno='".$_SESSION['login']."' ");
  $row=mysqli_fetch_array($query);
  if($row>0){
    $nwpwdquery= mysqli_query($con, "UPDATE students SET password='$newpwd', updationDate='$currentTime' WHERE studentRegno='".$_SESSION['login']."' ");
    if($nwpwdquery){
      $_SESSION['msg']="Password Changed Successfully !!";
    } else{
      $_SESSION['msg']="Your query is incorrect";
    }
  }else{
    $_SESSION['msg']="Current Password not match !!";
  }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<meata charset="UTF-8">
<meta name="viewport" content="width=device-width initial-scale=0">
<title>Change Password</title>
<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/font-awesome.css" />
<link rel="stylesheet" href="assets/css/style.css" />
<style>
  
</style>
</head>
<body>

<?php include('includes/header2.php');?>
<?php
if($_SESSION['login']!=""){
  include('includes/menubar.php');
}
?>
  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
            <h2 class="page-head-line">CHANGE PASSWORD NOW</h2>
        </div>
      </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Change Password
                </div>
 <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                <div class="panel-body">
                  <form name="change_password" method="post">
                    <div class="form-group">
                      <label for="currentPassword">Current Password</label>
                      <input type="password" class="form-control" id="currentPassword" name="currentpassword" />
                    </div>
                    <div class="form-group">
                      <label for="newPassword1">New Password</label>
                      <input type="password" class="form-control" id="newPassword" name="newpassword" />
                    </div>
                    <div class="form-group">
                      <label for="newPassword">Confirm Password</label>
                      <input type="password" class="form-control" id="confirmPassword2" name="confirmpassword" />
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">SUBMIT</button>
                  </form>
                </div>
              </div>
         
            </div>
        </div>
    </div>
  </div>

  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>
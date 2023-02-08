<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(strlen($_SESSION['adlogin'])==0){
  header("location:index.php");
}else
{ 
  date_default_timezone_set('Africa/Lagos');
  $currentTime=date('d-m-Y h:i:s A',time());
  if(isset($_POST['submit']))
  {
  
    
    $reg=$_SESSION['adlogin'];
    $curpd= md5($_POST['curpassword']);
    $newpd = md5($_POST['newpassword']);
    $chkquery=mysqli_query($con, "SELECT * FROM admin WHERE username='".$_SESSION['adlogin']."' and password='$curpd' ");
    $result=mysqli_fetch_row($chkquery);
        if($result>0)
        {
        $query = mysqli_query($con, "UPDATE admin SET password='$newpd', updationDate='$currentTime' WHERE username='$reg'");
        if($query){
          $_SESSION['mesg']="Update successful";      
        } else{
          $_SESSION['mesg']="Your update wasnt successful";
        }
      } else{
        $_SESSION['mesg'] = "user does not exist";
      }
    
  }
 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Admin | Change Password</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css"/>
  <link rel="stylesheet" href="assets/css/font-awesome.css"/>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <script type="text/javascript">
    function valid()
    {
    if(document.chngpasswd.curpassword.value=="")
    {
      alert("Current password field is empty!");
      document.chngpasswd.curpassword.focus();
      return false;
    }else if(document.chngpasswd.newpassword.value=="")
    {
      alert("New password field is empty!");
      document.chngpasswd.newpassword.focus();
      return false;
    }else if(document.chngpasswd.cnfnewpw.value=="")
    {
      alert("Confirm new password field is empty!")
      document.chngpasswd.cnfnewpw.focus();
        return false;      
    }
    return true;
  }
  </script>
</head>
<body>
<?php include("includes/header.php"); ?>
<?php if($_SESSION['adlogin'] !=""){
  include("includes/menubar.php");
}
?>
<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-head-line">Chanege Password || <?php echo htmlentities($_SESSION['adlogin']); ?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Chanege Password
          </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['mesg']); ?><?php echo htmlentities($_SESSION['mesg']=""); ?></font>         
          <div class="panel-body">
            <form name="chngpasswd" method="post" onSubmit="return valid();">
              <div class="form-group">
                <label for="currentpassword">Current Password</label>
                <input type="password" class="form-control" name="curpassword" placeholder="Enter Current Password" />
              </div>
              <div class="form-group">
                <label for="newpword">New Password</label>
                <input type=password class="form-control" name="newpassword" placeholder="Enter New Password"/>
              </div>
              <div class="form-group">
                <label for="newpword">Conffirm New Password </label>
                <input type="password" class="form-control" name="cnfnewpw" placeholder="Confirm New Password"/>
              </div>
              <button class="btn btn-primary" name="submit">Change Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- CONTENT-WRAPPER ENDS HERE -->
<?php include("includes/footer.php"); ?>
<!-- FOOTER SECTION ENDS HERE -->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- JQUERY SCRIPT -->
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
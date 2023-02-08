<?php

session_start();
//error_reporting(0);
include('includes/config.php');
//echo $_POST['password'];

if(isset($_POST['submit']))
{
  echo md5($_POST['password']);
  //echo $_POST['adminregno'];
  //return;

  $reg=$_POST['adminregno'];
  $password=md5($_POST['password']);
  //echo $password;
  $query=mysqli_query($con, "SELECT * FROM admin WHERE username='$reg' and password='$password' ");
  $result=mysqli_fetch_array($query);
  //echo mysqli_error($con);
 // echo json_encode($result);
  //echo $result;
  //echo $result['password'];


// exit();
  if($result>0){
   
    $extra="change-password.php";
    $_SESSION['adlogin']=$_POST['adminregno'];
    $_SESSION['id']=$result['id'];
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    exit();
  } else {
      $extra="index.php";
      $_SESSION['errmsg']="Username/Password is incorrect";
      $host=$_SERVER['HTTP_HOST'];
      $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
      header("location:http://$host$uri/$extra");
      exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <?php include("includes/header.php"); ?>
  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
           <h4 class="page-head-line">Admin Login Page</h4>
        </div>

      </div>
      <div class="row">
        <div class="col-md-6">
   
        <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
        <form method="post" name="admin">
            <div class="form-group">
              <label for="adminreg">Admin Reg No</label>
              <input type="text" class="form-control" name="adminregno" placeholder="Enter your ID"  />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter your password" />
            </div>
            <button class="btn btn-info" name="submit"><span class="glyphicon glyphicon-user"></span>&nbsp;SUBMIT</button>
          </form>
        </div>
        
        <div class="col-md-6">
                    <div class="alert alert-info">
                        This is a free bootstrap admin template with basic pages you need to craft your project. 
                        Use this template for free to use for personal and commercial use.
                        <br />
                         <strong> Some of its features are given below :</strong>
                        <ul>
                            <li>
                                Responsive Design Framework Used
                            </li>
                            <li>
                                Easy to use and customize
                            </li>
                            <li>
                                Font awesome icons included
                            </li>
                            <li>
                                Clean and light code used.
                            </li>
                        </ul>
                       
                    </div>
        </div>
      </div>
    </div>
  </div>
   <!-- CONTENT-WRAPPER SECTION END-->
   <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>

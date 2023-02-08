<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
    $regNo = $_POST['studentRegNo'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con,"SELECT * FROM students WHERE StudentRegNo = '$regNo' and password='$password' ");
   
    $num=mysqli_fetch_array($query);
    if($num>0){
       $extra="change-password.php";
       $_SESSION['login']=$_POST['studentRegNo'];
       $_SESSION['id']=$num['StudentRegnO'];
       $_SESSION['studentname']=$num['studentName'];
       $uip=$_SERVER['REMOTE_ADDR'];
       $status=1;
       $log=mysqli_query($con,"INSERT INTO userlog(studentRegno,userip,status) VALUES('".$_SESSION['login']."','$uip','$status')");
       $host=$_SERVER['HTTP_HOST'];
       $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
       header("location:http://$host$uri/$extra");
       exit();
       } else
       {
           $_SESSION['errmsg']="Username/Password is incorrect";
           $extra="index.php";
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
<meata charset="UTF-8">
<meta name="viewport" content="width=device-width initial-scale=0">
<title>Index Page</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<h2 class="testing">Good Evening PALS</h2>
<?php include('includes/header.php');?>
  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12"> <h2 class="page-head-line">Plese Login </h2> </div>
      </div>
      <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
      <form name="admin" method="post">
      <div class="row">
        <div class="col-md-6">
        <label for="studentregno">Student Reg No</label>
            <input class="form-control" type="text" name="studentRegNo" placeholder="Enter your Reg No"/>
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter your password" />
            <button name="submit" class="btn btn-primary">SUBMIT</button>
        </div>
      </form>
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

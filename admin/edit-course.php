<?php
session_start();
include("includes/config.php");
if(strlen($_SESSION['addlogin'])==0){
  header("location:index.php");
}else
{
  $id=intval($_GET['id']);
  date_default_timezone_set('Africa/Lagos');
  $currenttime=date('d-m-Y h:i:s', time());
  if(isset($_POST['submit']))
  {
    $coursecode=$_POST['coursecode'];
    $coursename=$_POST['coursename'];
    $courseunit=$_POST['courseunit'];
    $seatlimit=$_POST['seatlimit'];
    $query=mysqli_query($con, "UPDATE course set courseCode='$coursecode', courseName='$coursename', updationDate='$currenttime', courseUnit='$courseunit', noofSeats='$seatlimit' WHERE id='$id'");
    if($query){
      $_SESSION['msg'] = "Course updated successfully!";
    }

  }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<meta name="description" content="" />
<meta name="author" content="" />
<title> Course Edit</title>
<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/font-awesome.css"/>
<link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php include("includes/header.php"); ?>
<?php
  if($_SESSION['adlogin'] !=""){
    include("includes/menubar.php");
  }
?>
<div class= content-wrapper>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3 class="page-head-line">EDIT PAGE</h3>
      </div>
    </div>
    <!--content div starts here -->
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-edit"></i>EDIT</div>
  <font align="center" color="green"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?> </font>                 
          <div class="panel-body"> 
<?php $query=mysqli_query($con, "SELECT * FROM course WHERE id='$id'");
      while($row=mysqli_fetch_array($query))
      {
?> 
            <form method="post" name="dept">
              <div class="form-group">
                <label for="coursecode"> Course Code </label>
                <input type="text" class="form-control" name="coursecode" value="<?php echo htmlentities($row['courseCode']) ?>" placeholder="Course Code" />
              </div>
              <div class="form-group">
                <label for="coursename"> Course Name </label>
                <input type="text" class="form-control" name="coursename" value="<?php echo htmlentities($row['courseName']) ?>" placeholder="Course Name" />
              </div>
              <div class="form-group">
                <label for="courseunit"> Course Unit </label>
                <input type="text" class="form-control" name="courseunit" value="<?php echo htmlentities($row['courseUnit']) ?>" placeholder="Course Unit"/>
              </div>
              <div class="form-group">
                <label for="seatlimit"> Seat Limit </label>
                <input type="text" class="form-control" name="seatlimit" value="<?php echo htmlentities($row['noofSeats']) ?>" placeholder="Seat Limit" />
              </div>
              <?php } ?>
              <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
            </form>          
          </div>
        </div>
      </div>
    </div>
  </div>  
<div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</htmll>
<?php } ?>
<?php
    session_start();
    include("includes/config.php");
    if(strlen($_SESSION['adlogin'])==0){
        header("location:index.php");
    }else
    {
        
        if(isset($_POST['submit'])){
            $coursecode=$_POST['coursecode'];
            $coursename=$_POST['coursename'];
            $courseunit=$_POST['courseunit'];
            $seatlimit=$_POST['seatlimit'];
            $query=mysqli_query($con, "INSERT INTO course(courseCode,courseName,courseUnit,noofSeats) VALUES('$coursecode', '$coursename', '$courseunit', '$seatlimit') ");
            if($query){
                $_SESSION['msg']="Course created successfully !!";
            }else
            {
                $_SESSION['msg']="Error: Course not created";
            }
        }
        if(isset($_GET['del'])){
            $query=mysqli_query($con, "DELETE from course where id='".$_GET['id']."'");
            $_SESSION['delmesg']="Course deleted successfully";
        }
        
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meata name="author" content=""/>
  <title>Admin | Course Registration </title>
  <link rel="stylesheet" href="assets/css/bootstrap.css"/>
  <link rel="stylesheet" href="assets/css/font-awesome.css"/>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<?php include("includes/header.php");?>
<?php if($_SESSION['adlogin']!="")
    {
        include("includes/menubar.php");
        
    }
?>
<div class="conten-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3 class="page-head-line">New Course Registration </h3>
      </div> 
    <div>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            New Course Registration
          </div>
          <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>          
          <div class="panel-body">
            <form name="coursereg" method="post">
              <div class="form-group">
                <label for="coursecode">Course Code</label>
                <input type="text" name="coursecode" class="form-control" placeholder="Course Code"/>
              </div>
              <div class="form-group">
                <label for="coursename">Course Name</label>
                <input type="text" name="coursename" class="form-control" placeholder="Course Name"/>
              </div>
              <div class="form-group">
                <label for="courseunit">Course Unit</label>
                <input type="text" name="courseunit" class="form-control" placeholder="Course Unit"/>
              </div>
              <div class="form-group">
                <label for="seatlimit">Seat Limit</label>
                <input type="text" name="seatlimit" class="form-control" placeholder="Seat Limit"/>
              </div>
              <button class="btn btn-info" name="submit">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>
    </div>
<font align="center" color="red"><?php echo htmlentities($_SESSION['delmesg']); ?><?php echo htmlentities($_SESSION['delmesg']==""); ?></font>
     <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Manage Course
          </div>
          <div class="panel-body">
            <div class="table-responsive table-bordered">
              <table class="table">
                <thead>
                  <tr>
                    <td>#</td>
                    <td>Course Code</td>
                    <td>Course Name</td>
                    <td>Course Unit</td>
                    <td>Seat Limi</td>
                    <td>Creation Date</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
<?php

$query=mysqli_query($con, "SELECT * FROM course");
$cnt=1;

while($result=mysqli_fetch_array($query))
{
?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo htmlentities($result['courseCode']); ?></td>
                    <td><?php echo htmlentities($result['courseName']); ?></td>
                    <td><?php echo htmlentities($result['courseUnit']); ?></td>
                    <td><?php echo htmlentities($result['noofSeats']); ?></td>
                    <td><?php echo htmlentities($result['creationDate']); ?></td>
                    <td>
<a href="edit-course.php?id=<?php echo ($result['id']); ?>">
<button class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button></a>
<a href="course.php?id=<?php echo $result['id'];?>&del=delete" 
onClick="return confirm('Are you sure you want to delete?') "><button class="btn btn-danger">Delete</button> </a>                        
                    </td>
                  </tr>

<?php  $cnt++;
 } ?>           
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
     </div>       
  </div>
</div>
<?php include('includes/footer.php'); ?>
<!-- FOOTER SECTION ENDS HERE -->
<!-- javascript at the bottom to reduce the loading time -->
<script src="assets/js/jquery-1.11.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>

<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0){
    header('location:index.php');
}else
{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <title>Enroll History </title>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
<?php include('includes/header.php'); ?>
<?php
  if($_SESSION['login'] !=""){
      include('includes/menu.php');
  }
?>
  <div class=content-wrapper>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line"> Enroll History </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Enroll History
              </div>
              <div class="panel-body">
                <div class="table-responsive table-bodered">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Course Name</th>
                          <th>Session</th>
                          <th>Department</th>
                          <th>Level</th>
                          <th>Semester</th>
                          <th>Enrollment Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
 <?php
 $sql= mysqli_query($con, "SELECT courseenrolls.course as cid, course.courseName cusname, session.session as session, department.department as department, level.level as level, courseenrolls.enrollDate as edate, semester.semester as sem FROM courseenrolls join course on course.id=courseenrolls.course join session on session.id=courseenrolls.session join department on department.id=courseenrolls.department join level on level.id=courseenrolls.level join semester on semester.id=courseenrolls.semester WHERE courseenrolls.studentRegno='".$_SESSION['login']."' ");
 $cnt=1;
 while($row=mysqli_fetch_array($sql))
 {
 ?>
                        <tr>
                          <th><?php echo $cnt; ?></th>
                          <th><?php echo htmlentities($row['cusname']); ?></th>
                          <th><?php echo htmlentities($row['session']); ?></th>
                          <th><?php echo htmlentities($row['department']); ?></th>
                          <th><?php echo htmlentities($row['level']); ?></th>
                          <th><?php echo htmlentities($row['sem']); ?></th>
                          <th><?php echo htmlentities($row['edate']); ?></th>
                          <th><a href="print.php?id=<?php echo $row['cid']; ?>" target="_blank">
    <button class="btn btn-primary"><i class="fa fa-print"></i>Print</button></a>
                            
                            </th>
                        </tr>
<?php 
$cnt++;
 }
?>
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

<!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
<?php
session_start();
error_reporting();
include("includes/config.php");
if(strlen($_SESSION['adlogin'])==0){
    header("location:index.php");
}else
{
    if(isset($_GET['del'])){
        $reg=$_GET['id'];
        
        $query=mysqli_query($con, "DELETE FROM students WHERE StudentRegno='$reg'");
        if($query){
        $_SESSION['msg']="Student Record deleted!!";
        }
    }
    if(isset($_GET['pass'])){
        $password="Test@123";
        $newpassword=md5($password);
        $reg=$_GET['id'];
        $query=mysqli_query($con, "UPDATE students SET password='$newpassword' WHERE StudentRegno='$reg'");
        if($query){
        $_SESSION['msg']="Password Reset. New password is Test@123";
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Admin | Manage Student</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css"/>
  <link rel="stylesheet" href="assets/css/font-awesome.css"/>
  <link rel="stylesheet" href="assets/css/style.css"/>
</head>
  <body>
<?php include("includes/header.php"); ?>    
<?php if($_SESSION['adlogin']!=""){
    include("includes/menubar.php");
} ?>
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
            <h3 class="page-head-line">Manage Students</h3>
        </div>
<font color="red" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>        
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive table-bordered">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Reg No</th>
                        <th>Pincode</th>
                        <th>Student Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
    $cnt=1;
    $query=mysqli_query($con, "SELECT * FROM students");
    while($row=mysqli_fetch_array($query))
    {
?>
                      <tr>
                        <td><?php echo $cnt ?></td>
                        <td><?php echo htmlentities($row['StudentRegno']); ?></td>
                        <td><?php echo htmlentities($row['pincode']); ?></td>
                        <td><?php echo htmlentities($row['studentName']); ?></td>
                        <td>
<a href="edit-student-profile.php?id=<?php echo $row['StudentRegno']; ?>"><button class="btn btn-primary"><i class="fa fa-edit">EDIT</i></button></a>
<a href="manage-students.php?id=<?php echo $row['StudentRegno'];?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><button class="btn btn-danger">DELETE</button> </a>
<a href="manage-students.php?id=<?php $row['StudentRegno']; ?>&pass=password"><button class="btn btn-default">RESET PASSWORD</button></a>
                       
                        </td>
                      </tr>
<?php 
$cnt++;
    }?>                              
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>


<?php } ?>
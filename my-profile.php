<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login']=="")){
    header('location:index.php');
} else{
    
  if(isset($_POST['submit'])){
      $name=$_POST['studentname'];    
      $cgpa=$_POST['cgpa'];
      $photo=$_FILES["photo"]["name"];
      move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
      $update=mysqli_query($con, "UPDATE students SET studentName='$name', cgpa='$cgpa', studentPhoto='$photo' WHERE StudentRegno='".$_SESSION['login']."' ");
      if($update){
        $_SESSION['msg']="Your update was successful !!";
      } else{
        $_SESSION['msg']="Your update was not successful!!";
      }
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Student Profile</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.css" />
  <link rel="stylesheet" href="assets/css/style.css"  />
</head>

<body>
<?php include('includes/header.php'); ?>
<?php 
  if($_SESSION['login']!=""){
    include('includes/menubar.php');
  }
?>
<div class="content-wrapper">
  <div class="container">
    <div class="row" >
      <div class="col-md-10">
        <h2 class="page-head-line">Student Profile</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Student Profile
          </div>
         
 <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></font>
 <?php  
 $sql=mysqli_query($con, "SELECT * FROM students WHERE StudentRegno='".$_SESSION['login']."'");
 $cnt=1;
 while($row=mysqli_fetch_array($sql))
 { ?>
            <div class="panel-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="studentname"> Student Name</label>
                <input type="text" class="form-control" name="studentname"  id="studentname" value="<?php echo htmlentities($row['studentName']); ?>" />
              </div>

              <div class="form-group">
                <label for="studentregno"> Student Reg No</label>
                <input type="text" class="form-control" name="studentregno" id="studentregno" value="<?php echo htmlentities($row['StudentRegno']); ?>" readonly />
              </div>

              <div class="form-group">
                <label for="pincode"> Pincode</label>
                <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo htmlentities($row['pincode']); ?>" required />
              </div>

              <div class="form-group">
                <label for="CGPA">CGPA  </label>
                <input type="text" class="form-control" id="cgpa" name="cgpa"  value="<?php echo htmlentities($row['cgpa']);?>" required />
              </div> 

              <div class="form-group">
                <?php  if($row['studentPhoto']==""){ ?> 
                <img src="studentphoto/noimage.png" width="200" height="200" alt="imageFile not found" > <?php } else { ?>
                <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']); ?>" width="200" height="200" alt="imageFile not found" > <?php } ?>
              </div>
              
              <div class="form-group">
                <label for="photo"> Upload New Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" value="<?php echo htmlentities($row['studentPhoto']); ?>" />
              </div>
              
            <?php } ?>
              <button type="submit" name="submit" id="submit" class="btn btn-info">UPDATE</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php include('includes/footer.php'); ?>
  <script src="assets/js/jquery-1.11.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
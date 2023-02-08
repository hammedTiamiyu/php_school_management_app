<?php
session_start();
include("includes/config.php");

if(strlen($_SESSION['adlogin'])==0){
  header("location:index.php");
}else
{
  $reg=intval($_GET['id']);
  if(isset($_POST['submit'])){
    $regid=intval($_GET['id']);
      $cgpa=$_POST['cgpa'];
    $studentname=$_POST['studentname'];
    $photo=$_FILES["photo"]["name"];
    //echo $photo;
    //return;
    move_uploaded_file($_FILES["photo"]["tmp_name"],"../studentphoto/".$_FILES["photo"]["name"]);
    $update=mysqli_query($con, "UPDATE students SET studentName='$studentname', cgpa='$cgpa', studentPhoto='$photo'  WHERE StudentRegno='$regid'");

   
    if($update){
      $_SESSION['msg']="Records updated successfully";
    } else{
      $_SESSION['msg']="Error updating student record";
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Edit-Student Record</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css"/>
  <link rel="stylesheet" href="assets/css/font-awesome.css"/>
  <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php include("includes/header.php"); ?>
<?php
  if($_SESSION['adlogin']!=""){
    include("includes/menubar.php");
  }
?>
<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3 class="page-head-line"> EDIT STUDENT RECORD</div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Edit Records
          </div>
<?php
  $query=mysqli_query($con, "SELECT * FROM students WHERE StudentRegno='$reg'");
  while($row=mysqli_fetch_array($query))
  {
?>
          <div class="panel-body">
            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>  
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for=studentregno>Student Reg No</label>
                <input type="text" name="studentregno" class="form-control" value="<?php echo htmlentities($row['StudentRegno']); ?>" placeholder="Student Reg No" required/>
              </div>
              <div class="form-group">
                <label for=pincode>Pincode</label>
                <input type="text" name="pincode" class="form-control" value="<?php echo htmlentities($row['pincode']); ?>"  readonly/>
              </div>
              <div class="form-group">
                <label for=studentname>Student Name</label>
                <input type="text" name="studentname" class="form-control" value="<?php echo htmlentities($row['studentName']); ?>" placeholder="Student Name" required/>
              </div>
              <div class="form-group">
                <label for=cgpa>CGPA</label>
                <input type="text" name="cgpa" class="form-control" value="<?php echo htmlentities($row['cgpa']); ?>" placeholder="cgpa" required/>
              </div>
              <div class="form-group">
                <label for="studentphoto">Student Photo</label>
                <?php if($row['studentPhoto']=="")
                { ?>                
                <img src="../studentphoto/noimage.png" width="200" height="200"  ><?php } else{ ?>
                <img src="../studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200"/><?php } ?>
              </div>
              <div class="form-group">
                <label for="studentphoto">Upload New Photo</label>
                <input type="file" class="form-control" name="photo" id="photo" value="<?php echo htmlentities($row['studentPhoto']); ?>"/>
              </div>
              <?php } ?>
              <button name="submit" type="submit" class="btn btn-primary">SUBMIT</button>     
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php } ?>
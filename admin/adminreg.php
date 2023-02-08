<?php 
session_start();
include("includes/config.php");
if(isset($_POST['submit'])){

    $reg=$_POST['regno'];
    $password=md5($_POST['password']);
    date_default_timezone_set('Africa/Lagos');
    $currentTime=date('d-m-Y h:i:s A',time());


    $adquery=mysqli_query($con, "INSERT INTO admin(username, password,updationDate) VALUES('$reg','$password', '$currentTime') ");
    echo mysqli_error($con);
    if($adquery){
        $_SESSION['mesg']= "Registration successful";
    }else{
        $_SESSION['mesg']= "Registration wasnot successful";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <title>Admin Creation Page</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<?php include("includes/header.php");?>

<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h4 class="page-head-line"> Admini Registration Portal</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
      <font color="green" align="center"><?php echo htmlentities($_SESSION['mesg']); ?><?php echo htmlentities($_SESSION['mesg']=""); ?></font>          
        <form method="post" name="adminreg">
          <div class="form-group">
            <label for="regno">Reg no</label>
            <input type="text" name="regno" class="form-control" placeholder="admin reg no" />            
          </div>
          <div class="form-group">
            <label for="password">Reg no</label>
            <input type="password" name="password" class="form-control" placeholder="admin password " />            
          </div>
          <button name="submit" class="btn btn-info">SUBMIT</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
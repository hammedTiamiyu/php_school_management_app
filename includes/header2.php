<?php
session_start();
error_reporting(0);
include("includes/config.php");
if($_SESSION['login']!="")
{ ?>
<header>
    <div class="container">
      <div class="col-md-15">
          <strong>Welcome: <?php echo  htmlentities($_SESSION['studentname']); ?></strong>
          &nbsp; &nbsp;
          <strong>Last Login: <?php
      $query= mysqli_query($con,"SELECT * FROM userlog WHERE studentRegno='".$_SESSION['login']."' order by id desc limit 1,1");
            $row=mysqli_fetch_array($query);
            echo $row['userip']; ?> at <?php echo $row['loginTime']; ?>        
          </strong>
      </div>
    </div>
</header>
<?php } ?>
<!-- HEADER ENDS HERE -->

<div class="navbar navbar-inverse ">
    <div class="container">
        <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color:#fff; font-size:24px;4px; line-height:24px; ">

                   Online Course Registration
                </a>

        </div>

            <div class="left-div">
                <i class="fa fa-user-plus login-icon" ></i>
            </div>
    </div>

</div>
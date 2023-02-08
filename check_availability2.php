<?php
session_start();
require_once('includes/config.php');

if(!empty($_POST['cid'])){
    $cid=$_POST['cid'];
    $reg=$_SESSION['login'];
    $check=mysqli_query($con, "SELECT studentRegno FROM courseenrolls WHERE course='$cid' and studentRegno='$reg' ");
    $count=mysqli_num_rows($check);
    if($count>0){
        echo "<span style='color: red'>Already applied for this course</span>";
        echo "<script>$('#submit').prop('disabled',true)</script>";
    }        
}
if(!empty($_POST['cid'])){
    $cid=$_POST['cid'];
    $checkCourse=mysqli_query($con, "SELECT noofSeats FROM course WHERE ID='$cid'");
    $array=mysqli_fetch_array($checkCourse);
    $noofseat=$array['noofSeats'];
    $checkEnrolls=mysqli_query($con, "SELECT * FROM courseenrolls WHERE course='$cid' ");
    $row=mysqli_num_rows($checkEnrolls);
    
    if($row >= $noofseat ){
        echo "<span style='color: red'>No seat is available for this course. All seats are occupied.</span>";
        echo "<script>$('#submit').prop('disabled',true)</script>";
    }
}
?>
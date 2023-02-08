<?php
    include("includes/config.php");
    $query=mysqli_query($con, "SELECT * FROM students limit 2 ");
    $row=mysqli_fetch_assoc($query);
   // echo "<h2>" Good Morning "</h2>";
    $json=json_encode($row);

    //$decode=json_decode($json);
    echo $json;
    
    
?>

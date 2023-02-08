<?php
session_start();
$_SESSION['adlogin']=="";
session_unset();
//session_destroy();
$_SESSION['errmsg']="You are logge out";
?>
<script language="javascript">
document.location="index.php";
</script>

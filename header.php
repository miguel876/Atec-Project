<header>
  <?php
@session_start();
   ?>
<div class="sticky-top">
  <div class="row">
<div class="col-6">
  <div id="img">
    <?php
if(@$_SESSION["type"]=='4'){
     ?>
  <a href="backoffice.php"><img src="Images/atec.png" width=170px height=50px class="img-fluid p-3"></a>
<?php
}
else{
?>
<a href="index.php?page=2"><img src="Images/atec.png" width=170px height=50px class="img-fluid p-3"></a>
<?php
}
 ?>

</div>
</div>
<?php

if(@$_SESSION["id"]){
?>
  <div class="col-6">
<form method="post">
<div class="logout">
  <input type="submit" name="logout" value="Logout" class="btn btn-link">
</div>
<?php
if(isset($_POST["logout"])){
echo '<meta http-equiv="refresh" content="0;url=login.php">';
  session_destroy();
}
}
?>
</form>
</div>
</div>
</header>

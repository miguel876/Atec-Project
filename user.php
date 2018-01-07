<html>


<?php
include 'database/conn.php';
if(@$_SESSION["type"]=='4'){
  $id=@$_REQUEST["ped"];
  $_SESSION["userid"]=$id;
  if($id>0){
?>
<div class="row">
  <div class="col-3">
  </div>
  <div class="col-5">

    <div class="btnmenu4">
    <a href="index.php?page=9" class="btn2 btn-link btn-sm float-left">Editar</a>
    </div>

    <?php
    $sql2="SELECT type FROM utilizadores WHERE id='$id'";
    $result=mysqli_query($conn, $sql2);
    if(mysqli_num_rows($result) >0){
      while($row= mysqli_fetch_assoc($result)){
        if($row["type"]=='2'){
     ?>

<div class="btnmenu">
<a href="backoffice.php" class="btn btn-link btn-sm float-right">Voltar</a>
</div>
<?php
}
else{
?>

<div class="btnmenu">
<a href="index.php?page=7" class="btn btn-link btn-sm float-right">Voltar</a>
</div>

<?php
}}}
 ?>
  </div>
  <div class="col-4 pl-4">

  </div>
</div>

<?php
$sql2="SELECT type FROM utilizadores WHERE id='$id'";
$result=mysqli_query($conn, $sql2);
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){
    if($row["type"]=='1'){
 ?>

<div class="row">
  <div class="col-3">
  </div>
  <div class="col-5">
<div class="btnmenu4">
<a href="index.php?page=10" class="btn2 btn-link btn-sm float-left">Pedidos</a>
</div>
</div>
</div>
<?php
}}}


$sql="SELECT firstname, lastname, email, type from utilizadores WHERE id='$_SESSION[userid]'";
$result= mysqli_query($conn, $sql);
$sqltot="SELECT COUNT(id) total FROM pedidos WHERE id_utilizador='$_SESSION[userid]'";
$resultot=mysqli_query($conn, $sqltot);
$rowtot= mysqli_fetch_assoc($resultot);

if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

echo "<div class=row>
<div class=col-3>
</div>
    <div class=col-6>
  <div id=cardped>
  <div class=card style=width: 60rem;>
    <div class=card-body>
    <div class='row'>
    <div class='col-9'>
      <h4 class=card-title></h4>
      </div>


        </div>
      <p class=card-text>
  <div class=form-group>
    <div class=row>
    <div class=col-3>
    </div>
        <div class=col-6>

<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Nome</b></h6></label>
      <div class=col-sm>
      ".$row["firstname"]." ".$row["lastname"]."
      </div>
</div>
</div>
</div>
<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>E-mail</b></h6></label>
      <div class=col-sm>
      ".$row["email"]."
      </div>
</div>
</div>
</div>
";
if($row["type"]=='1'){

echo "
<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Número de Pedidos</b></h6></label>
      <div class=col-sm>
      ".$rowtot["total"]."
      </div>
      </div>
</div>
</div>
";
}
}

 echo "
 </p>
</div>
</div>
</div>
</div>
</div>";
  }

}
}else{
  echo 'Nao tem autorização para aceder a esta página!';
}
include 'database/disc.php';
include 'footer.php';
 ?>


</html>

<html>


<?php
include 'database/conn.php';
if(@$_SESSION["type"]){
  $id=@$_REQUEST["ped"];
  $_SESSION["edit"]=$id;
  if($id>0){
?>
<div class="row">
  <div class="col-3">
  </div>
  <div class="col-5">

<?php
if($_SESSION["type"]=='4'){
?>
<div class="btnmenu4">
<a href="index.php?page=6" class="btn2 btn-link btn-sm float-left">Editar</a>
</div>

  <?php
}else if($_SESSION["type"]=='1'){

?>

<div class="btnmenu">
<a href="index.php?page=4" class="btn btn-link btn-sm float-right">Voltar</a>
</div>
<?php
}

if($_SESSION["type"]=='3' || $_SESSION["type"]=='4'){
  if(@$_SESSION["userid"]){
    $id=$_SESSION["userid"];
  echo"
  <div class='btnmenu'>
  <a href=index.php?page=8&ped=$id class='btn btn-link btn-sm float-right'>Voltar</a>
  </div>
  ";
}else{
    ?>
  <div class="btnmenu">
  <a href="index.php?page=2" class="btn btn-link btn-sm float-right">Voltar</a>
  </div>


<?php
}
}
 ?>

  </div>
  <div class="col-4 pl-4">

  </div>
</div>
<?php

$sql="SELECT id, nome, tipo, data, estado, de, ate, das, ashoras, observacoes, outrasobs, obsdiretor FROM pedidos WHERE id=$id";
$result= mysqli_query($conn, $sql);

if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

  //  echo "<tr><td>""</td><td>".$row["ate"]."</td></tr><tr><td>".$row["das"]."</td><td>".$row["ashoras"]."</td></tr>
//    <tr><td></td></tr>";

echo "<div class=row>
<div class=col-3>
</div>
    <div class=col-6>
  <div id=cardped>
  <div class=card style=width: 60rem;>
    <div class=card-body>
    <div class='row'>
    <div class='col-9'>
      <h4 class=card-title>Pedido</h4>
      </div>
      <div class='col-3 mt-1'>"
        .$row["data"]."
        </div>
        </div>
      <p class=card-text>
  <div class=form-group>
    <div class=row>
    <div class=col-3>
    </div>
        <div class=col-3>

<div class='form-group row'>
    <label class=col-sm-4 col-form-label><h6><b>De</b></h6></label>
    <div class=col-sm-8>"
    .$row["de"]."
    </div>
  </div>

</div>
<div class=col-4>
  <div class='form-group row'>
      <label class=col-sm-4 col-form-label><h6><b>Até</b></h6></label>
      <div class=col-sm-8>
      ".$row["ate"]."
      </div>
    </div>

</div>
</div>
<div class=row>
<div class=col-3>
</div>
<div class=col-3>
  <div class='form-group row'>
      <label class=col-sm-4 col-form-label><h6><b>Das</b></h6></label>
      <div class=col-sm-8>
      ".$row["das"]."
      </div>
</div>
</div>
<div class=col-4>
  <div class='form-group row'>
      <label class=col-sm-4 col-form-label><h6><b>Ás</b></h6></label>
      <div class=col-sm-8>
      ".$row["ashoras"]."
      </div>
</div>
</div>
</div>


<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Tipo</b></h6></label>
      <div class=col-sm>
      ".$row["tipo"]."
      </div>
</div>
</div>
</div>
<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Observações</b></h6></label>
      <div class=col-sm>
      ".$row["observacoes"]."
      </div>
</div>
</div>
</div>
<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Outras Observações</b></h6></label>
      <div class=col-sm>
      ".$row["outrasobs"]."
      </div>
      </div>
</div>
</div>
";

if($row["estado"]=='1' || $row["estado"]=='2'){
echo "<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Observações Diretor</b></h6></label>
      <div class=col-sm>
      ".$row["obsdiretor"]."
      </div>
      </div>
</div>
</div>";

}
echo
"</div>";

if($_SESSION["type"]=='3' || $_SESSION["type"]=='4'){

echo "
<div class=row>
<div class=col>
  <div class=form-group row>
      <label class=col-sm col-form-label><h6><b>Pedido por</b></h6></label>
      <div class=col-sm>
      ".$row["nome"]."
      </div>
</div>
</div>
</div>

";
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
}else{
  echo "Nao tem autorização para aceder a esta página!";
}
include 'database/disc.php';
include 'footer.php';
 ?>


</html>

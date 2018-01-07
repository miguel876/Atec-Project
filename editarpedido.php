<?php
include 'database/conn.php';
if(@$_SESSION["type"]=='4'){
  ?>
<div class="row">
  <div class="col-3">
  </div>
  <div class="col-6">
<form method="post">
<div class="btnm4">
<input type="submit" class="btn2 btn-link btn-sm float-left" value="Confirmar" name="confirmar">
</div>

<div class="btnm">
<input type="submit" class="btn btn-link btn-sm float-right" value="Voltar" name="cancelar">
</div>

  </div>
  <div class="col-3 pl-4">

  </div>
</div>
<?php
$id=$_SESSION["edit"];

if($id>0){
$sql="SELECT id, nome, tipo, data, estado, de, ate, das, ashoras, observacoes, outrasobs, obsdiretor FROM pedidos WHERE id=$id";
$result= mysqli_query($conn, $sql);

if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){
?>
<div class='row'>
  <div class='col'>

    <div class="row">
      <div class="col-xl">
    <div id="cardped">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h4 class="card-title">Pedido</h4>
        <p class="card-text">
    <div class="form-group">
      <div class="row">
          <div class="col">

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">De</label>
      <div class="col-sm-10">
        <input type="text" value="<?php echo $row['de'] ?>" name="de" class="form-control mt-1">
      </div>
    </div>

  </div>
  <div class="col">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Até</label>
        <div class="col-sm-10">
          <input type="text" name="ate" value="<?php echo $row['ate'] ?>" class="form-control mt-1">
        </div>
      </div>

  </div>
  </div>
  <div class="row">
  <div class="col">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Das</label>
        <div class="col-sm-10">
          <input type="text" name="das" value="<?php echo $row['das'] ?>" class="form-control mt-2">
        </div>
  </div>
  </div>
  <div class="col">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Ás</label>
        <div class="col-sm-10">
          <input type="text" name="as" value="<?php echo $row['ashoras'] ?>" class="form-control mt-2">
        </div>
  </div>
  </div>
  </div>
  <select name="tipo" class="form-control mt-2">
    <option value="Compensação" selected>Compensação</option>
    <option value="Férias">Férias</option>
    <option value="Horas Fléxiveis">Horas Fléxiveis</option>
  </select>
  <textarea name="observacoes" class="form-control mt-2" rows="3"><?php echo $row['observacoes'] ?></textarea>
  <textarea name="outrasobs" class="form-control mt-2" rows="2"><?php echo $row['outrasobs'] ?></textarea>
    </div>


   </p>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>

<?php
}}
 ?>
 <script>
 function popupSuccessEdit(){
   alert("Pedido editado com sucesso!");
 }
 </script>
  <?php
  if(isset($_POST["confirmar"])){
    include 'database/conn.php';
    if(empty($_POST["de"]) ||empty($_POST["ate"]) || empty($_POST["das"]) || empty($_POST["as"]) || empty($_POST["observacoes"]) || empty($_POST["outrasobs"])){
      echo 'Insira todos os dados corretamente!';
    }
    else{
      $obs=mysqli_escape_string($conn, $_POST["observacoes"]);
      $obsout=mysqli_escape_string($conn, $_POST["outrasobs"]);

      if(strpos($obs,'/')!==false ||strpos($obs,';')!==false ||strpos($obs,'(')!==false ||strpos($obs,')')!==false ||strpos($obs,'{')!==false ||strpos($obs,'}')!==false ||strpos($obs,';')!==false){
          echo "Caractéres inválidos!";
  }
  else if(strpos($obsout,'/')!==false ||strpos($obs,';')!==false ||strpos($obs,'(')!==false ||strpos($obs,')')!==false ||strpos($obs,'{')!==false ||strpos($obs,'}')!==false ||strpos($obs,';')!==false){
      echo "Caractéres inválidos!";
  }
  else{
    $sql=mysqli_query($conn,"UPDATE pedidos SET de='".$_POST['de']."', ate='".$_POST['ate']."', das='".$_POST['das']."', ashoras='".$_POST['as']."', observacoes='$obs', outrasobs='$obsout', tipo='".$_POST['tipo']."' WHERE id='$id'");
      echo '<script>popupSuccessEdit()</script>';
      include 'database/disc.php';

  }
}
  }
  else if(isset($_POST["cancelar"])){
    header("Location: index.php?page=5&ped=$id");
  }

}else{
  echo 'Erro!';
}
}else{
  echo 'Nao tem autorização para aceder a esta página!';
}

include 'footer.php';
 ?>
</div>
</div>

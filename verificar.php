<?php
if(@$_SESSION["type"]=='2'){
 ?>
 <div class="row">
   <div class="col-9">
     <div class="btnmenu3">
     <a href="index.php?page=2" class="btn btn-link btn-sm float-right">Voltar</a>
     </div>
   </div>
   <div class="col-3">

</div>
</div>

<div class="row">
  <div class="col-10">
<?php
include 'database/conn.php';
//Pedidos dependentes---

$id=$_REQUEST["id"];

if($id>0){
$sql="SELECT data, nome, de, ate, das, ashoras, observacoes, estado, obsdiretor, outrasobs FROM pedidos WHERE id='$id'";
$result= mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

echo "<div class=row>
<div class=col-4>
</div>
    <div class=col-6>
<div id=card>
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
    <div class=col-2>
    </div>
        <div class=col-4>


  <div class='form-group row'>
      <label class=col-sm-4 col-form-label><b>De</b></label>
      <div class=col-sm-8>
        ".$row["de"]."
      </div>
    </div>
  </div>

  <div class=col-4>
    <div class='form-group row'>
        <label class=col-sm-4 col-form-label><b>Até</b></label>
        <div class=col-sm-8>
        ".$row["ate"]."
        </div>
      </div>
  </div>
  </div>

  <div class=row>
  <div class=col-2>
  </div>
  <div class=col-4>
    <div class='form-group row'>
        <label class=col-sm-4 col-form-label><b>Das</b></label>
        <div class=col-sm-8>
        ".$row["das"]."
        </div>
  </div>
  </div>

  <div class=col-4>
    <div class='form-group row'>
        <label class=col-sm-4 col-form-label><b>Ás</b></label>
        <div class=col-sm-8>
          ".$row['ashoras']."
        </div>
  </div>
  </div>
  </div>
  <div class=row>
  <div class=col>

        <label class=col-sm col-form-label><b>Observações</b></label>
        <div class=col-sm>
          ".$row['observacoes']."
        </div>

  </div>
  </div>
  <div class='row mt-2'>
  <div class='col'>

        <label class=col-sm col-form-label ><b>Outras observações</b></label>
        <div class=col-sm>
          ".$row['outrasobs']."
        </div>

  </div>
  </div>
  ";
if($row["estado"]=='0'){
  echo "
  <div class='row mt-3'>
  <div class=col>

        <label class=col-sm col-form-label><b>Observações Diretor</b></label>


  </div>
  </div>
";
}

echo "
        <form method=post>
        ";

if($row["estado"]=='0'){
        echo "
<textarea name=obsdiretor class='form-control mt-2' rows=2 placeholder= Observações></textarea>
  <input type=submit name=aceitar value=Aceitar class='btn btn-primary btn-sm mt-2 w-100'></p>
    <input type=submit name=recusar value=Recusar class='btn btn-outline-primary btn-sm  w-100'></p>
";
}else{
  echo "  <div class=row>
    <div class=col>

          <label class='col-sm col-form-label mt-2'><b>Observações Diretor</b></label>
          <div class=col-sm>
            ".$row['obsdiretor']."
          </div>

    </div>
    </div>";
}

echo "
</form>
    </div>

    </p>
  </div>
  </div>
  </div>
</div>
</div>";
}
}
}else{
  echo 'Erro!';
}
if(isset($_POST["aceitar"])){
include 'database/conn.php';

$obsdir=$_POST["obsdiretor"];
if(strpos($obsdir,'/')!==false ||strpos($obsdir,';')!==false ||strpos($obsdir,'(')!==false ||strpos($obsdir,')')!==false ||strpos($obsdir,'{')!==false ||strpos($obsdir,'}')!==false ||strpos($obsdir,';')!==false){
    echo "Caractéres inválidos!";
}
else{
  mysqli_query($conn, "UPDATE pedidos SET obsdiretor='$_POST[obsdiretor]', estado='1'  WHERE id='$_REQUEST[id]'");
//  mysqli_query($conn, "UPDATE pedidos SET warning='1' WHERE id_utilizador='$_SESSION[id]' AND id='$row[id]'");

echo '<meta http-equiv="refresh" content="0;url=index.php?page=2">';
include 'database/disc.php';
}
}

if(isset($_POST["recusar"])){
  include 'database/conn.php';
  if(strpos($obsdir,'/')!==false ||strpos($obsdir,';')!==false ||strpos($obsdir,'(')!==false ||strpos($obsdir,')')!==false ||strpos($obsdir,'{')!==false ||strpos($obsdir,'}')!==false ||strpos($obsdir,';')!==false){
      echo "Caractéres inválidos!";
  }else{
  mysqli_query($conn, "UPDATE pedidos SET obsdiretor='$_POST[obsdiretor]', estado='2'  WHERE id='$_REQUEST[id]'");
  echo '<meta http-equiv="refresh" content="0;url=index.php?page=2">';
include 'database/disc.php';
}
}
 ?>

 <?php
}else{
echo 'Acesso negado!';

}
  ?>
</div>
</div>

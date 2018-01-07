<!DOCTYPE html>
<html>

<body>
<?php
  @session_start();
@$type=$_SESSION['type'];

//Utilizador normal
if(@$_SESSION['type']=='1'){
?>
<div class="row">
  <div class="col-3">

  </div>
  <div class="col-9">
    <div class="btnmenu4">
    <a href="index.php?page=4" class="btn2 btn-link btn-sm float-left">Pedidos</a>
    </div>
</div>
</div>

<form method="post">
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
      <input type="date" name="de" class="form-control mt-1 text-muted font-italic">
    </div>

<div class="col">
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Até</label>
      <div class="col-sm-10">
        <input type="date" name="ate" class="form-control mt-1 text-muted font-italic">
      </div>
    </div>

</div>
</div>
<div class="row">
<div class="col">
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Das</label>
      <div class="col-sm-10">
        <input type="time" name="das" placeholder="12:00"class="form-control mt-2 text-muted">
      </div>
</div>
</div>
<div class="col">
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Ás</label>
      <div class="col-sm-10">
        <input type="time" name="as" placeholder="19:00" class="form-control mt-2 text-muted">
      </div>
</div>
</div>
</div>
<select name="tipo" class="form-control mt-2">
  <option value="Compensação">Compensação</option>
  <option value="Férias">Férias</option>
  <option value="Horas Fléxiveis">Horas Fléxiveis</option>
</select>
<textarea name="observacoes" class="form-control mt-2" placeholder="Observações" rows="3"></textarea>
<textarea name="outrasobs" class="form-control mt-2" rows="2"  placeholder=" Outras observações" ></textarea>
<input type="submit" name="enviar" value="Enviar" class="btn btn-outline-primary w-100 mt-3">
  </div>

 </p>
</div>
</div>
</div>
</div>
</div>
</form>

<script>
function popupSuccess(){
  alert("Pedido enviado com sucesso! Por favor aguarde a resposta!");
}
</script>

<?php
if(isset($_POST["enviar"])){
  include 'database/conn.php';
  if(empty($_POST["de"]) || empty($_POST["ate"]) || empty($_POST["das"]) || empty($_POST["as"])){
    echo 'Insira todos os dados corretamente!';
  }
  else{
    $data= date("Y/m/d");
    $tipo= $_POST["tipo"];
    $name= $_SESSION["name"];
    $id=$_SESSION["id"];
    $obs=$_POST["observacoes"];
    $obsout=$_POST["outrasobs"];

    if(strpos($obs,'/')!==false ||strpos($obs,';')!==false ||strpos($obs,'(')!==false ||strpos($obs,')')!==false ||strpos($obs,'{')!==false ||strpos($obs,'}')!==false ||strpos($obs,';')!==false  ){
        echo "Caractéres inválidos!";
}
else if(strpos($obsout,'/')!==false ||strpos($obs,';')!==false ||strpos($obs,'(')!==false ||strpos($obs,')')!==false ||strpos($obs,'{')!==false ||strpos($obs,'}')!==false ||strpos($obs,';')!==false  ){
    echo "Caractéres inválidos!";
}
else{
    mysqli_query($conn, "INSERT INTO pedidos (de, ate, das, ashoras, tipo, data, nome, observacoes, outrasobs, obsdiretor, estado, id_utilizador, warning) VALUES('$_POST[de]','$_POST[ate]','$_POST[das]','$_POST[as]','$tipo','$data','$name','$_POST[observacoes]', '$_POST[outrasobs]', '','0','$id','0')");

    echo '<script>popupSuccess()</script>';

    include 'database/disc.php';
}

  }
}

 ?>

<!-- Janela popup Warning de pedidos respondidos  -->
<script>
function popupSuccessWindow(){
  alert("O seu pedido foi aceite!");
}
</script>
<script>
function popupFailureWindow(){
  alert("O seu pedido foi rejeitado!");
}
</script>
<?php
include 'database/conn.php';
$sql="SELECT warning, estado, id FROM pedidos WHERE id_utilizador='$_SESSION[id]'";
$result= mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

    if($row["estado"]=='1' && $row["warning"]=='0'){

      echo '<script>popupSuccessWindow()</script>';
      mysqli_query($conn, "UPDATE pedidos SET warning='1' WHERE id_utilizador='$_SESSION[id]' AND id='$row[id]'");

}
else if($row["estado"]=='2' && $row["warning"]=='0'){

  echo '<script>popupFailureWindow()</script>';
  mysqli_query($conn, "UPDATE pedidos SET warning='1' WHERE id_utilizador='$_SESSION[id]' AND id='$row[id]'");

}
  }
}
include 'database/disc.php';
 ?>


<?php
}

//Utilizador diretor
else if(@$_SESSION['type']=='2'){
include 'database/conn.php';
?>
<script>
function popupWindow2(){
  alert("Tem pedidos por responder!");
}
</script>

<?php
  $sql="SELECT estado, id FROM pedidos";
  $result= mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) >0){
    while($row= mysqli_fetch_assoc($result)){

if($_SESSION["warn"]=='0'){
      if($row["estado"]=='0'){
        echo '<script>popupWindow2()</script>';
        $_SESSION["warn"]='1';
}
  }
    }
  }

echo "<nav class='nav nav-tabs' id='myTab' role='tablist'>
  <a class='nav-item nav-link active text-primary' id='pendentes' data-toggle='tab' href='#nav-pendentes' role='tab' aria-controls='nav-home' aria-selected='true'>Pendentes</a>
  <a class='nav-item nav-link text-primary' id='aceites' data-toggle='tab' href='#nav-aceites' role='tab' aria-controls='nav-profile' aria-selected='false'>Aceites</a>
  <a class='nav-item nav-link text-primary' id='recusados' data-toggle='tab' href='#nav-recusados' role='tab' aria-controls='nav-contact' aria-selected='false'>Recusados</a>
</nav>
<div class='tab-content' id='nav-tabContent'>
<div class='tab-pane fade show active' id='nav-pendentes' role='tabpanel' aria-labelledby='pendentes'>
";

//Pedidos Pendentes
$sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE estado='0' ORDER BY id DESC";
$result= mysqli_query($conn, $sql);

echo "<table class='table table-hover'>";
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

    echo "<tr><td><a href=index.php?page=3&id=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";

  }

}
echo "</table></div>";

echo "<div class='tab-pane fade' id='nav-aceites' role='tabpanel' aria-labelledby='aceites'>";

//Pedidos Aceites
$sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE estado='1' ORDER BY id DESC";
$result= mysqli_query($conn, $sql);

echo "<table class='table table-hover'>";
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

    echo "<tr><td><a href=index.php?page=3&id=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";

  }
}
echo "</table></div>";

echo "<div class='tab-pane fade' id='nav-recusados' role='tabpanel' aria-labelledby='recusados'>";

//Pedidos Rejeitados
$sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE estado='2' ORDER BY id DESC";
$result= mysqli_query($conn, $sql);

echo "<table class='table table-hover'>";
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

    echo "<tr><td><a href=index.php?page=3&id=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";

  }

}
echo "</table></div>";

 ?>
</div>

  <?php
}
//Recursos Humanos e Admin

else if(@$_SESSION["type"]=='3' || @$_SESSION["type"]=='4'){

    $_SESSION["refresh"]='0';
include 'database/conn.php';
  echo "<nav class='nav nav-tabs' id='myTab' role='tablist'>
    <a class='nav-item nav-link text-primary' id='pendentes' data-toggle='tab' href='#nav-pendentes' role='tab' aria-controls='nav-home' aria-selected='false'>Pendentes</a>
    <a class='nav-item nav-link text-primary' id='aceites' data-toggle='tab' href='#nav-aceites' role='tab' aria-controls='nav-profile' aria-selected='false'>Aceites</a>
    <a class='nav-item nav-link text-primary' id='recusados' data-toggle='tab' href='#nav-recusados' role='tab' aria-controls='nav-contact' aria-selected='true'>Recusados</a>
    <form class='navbar-form navbar-left' method='post'>
       <div class=input-group>
         <input type=text class=form-control placeholder=Search name=searchm>
           <input type=submit value='Search' name='search' >
       </div>
     </form>

";

if($_SESSION["type"]=='4'){
  echo "<a href='backoffice.php' class='nav-item nav-link text-primary text-dark'>Voltar</a>";
}
    echo"
  </nav>

  <div class='tab-content' id='nav-tabContent'>
  <div class='tab-pane fade' id='nav-pendentes' role='tabpanel' aria-labelledby='pendentes'>
  ";

  //Pedidos Pendentes
  $sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE estado='0' ORDER BY id DESC";
  $result= mysqli_query($conn, $sql);

  echo "<table class='table table-hover'>";
  if(mysqli_num_rows($result) >0){
    while($row= mysqli_fetch_assoc($result)){

      echo "<tr><td><a href=index.php?page=5&ped=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";

    }

  }
  echo "</table></div>";

  echo "<div class='tab-pane fade' id='nav-aceites' role='tabpanel' aria-labelledby='aceites'>";
  //Pedidos Aceites
  $sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE estado='1' ORDER BY id DESC";
  $result= mysqli_query($conn, $sql);

  echo "<table class='table table-hover'>";
  if(mysqli_num_rows($result) >0){
    while($row= mysqli_fetch_assoc($result)){

      echo "<tr><td><a href=index.php?page=5&ped=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";

    }

  }
  echo "</table></div>";

  echo "<div class='tab-pane fade' id='nav-recusados' role='tabpanel' aria-labelledby='recusados'>";

  //Pedidos Rejeitados
  $sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE estado='2' ORDER BY id DESC";
  $result= mysqli_query($conn, $sql);

  echo "<table class='table table-hover'>";
  if(mysqli_num_rows($result) >0){
    while($row= mysqli_fetch_assoc($result)){

      echo "<tr><td><a href=index.php?page=5&ped=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";

    }

  }
  echo "</table></div>";

  //echo "<div class='tab-pane fade' id='nav-search' role='tabpanel' aria-labelledby='search'>";

  //Search
  if(isset($_POST["search"])){

    include 'database/conn.php';

    $search=$_POST["searchm"];
    if(empty($_POST["searchm"])){
      echo 'Insira algo para procurar!';
    }
  else if(strpos($search,'/')!==false ||strpos($search,';')!==false ||strpos($search,'(')!==false ||strpos($search,')')!==false ||strpos($search,'{')!==false ||strpos($search,'}')!==false ||strpos($search,';')!==false){
      echo "Caractéres inválidos!";
  }
  else{
    $sql="SELECT id, nome, tipo, data, estado FROM pedidos WHERE nome LIKE '%$search%'";
    $result= mysqli_query($conn, $sql);

    echo "<table class='table table-hover'>";
    if(@mysqli_num_rows($result) >0){
      while($row= mysqli_fetch_assoc($result)){

        echo "<tr><td><a href=index.php?page=5&ped=".$row["id"]." class='text-primary'>".$row["nome"]."</a></td><td>".$row["tipo"]."</td><td>".$row["data"]."</td></tr>";
        $_SESSION["refresh"]=='1';
      }

    }else{
      echo 'Erro na pesquisa!';
    }
    echo "</table></div>";
  }
    }
include 'database/disc.php';

}

else {
  echo '<div style="text-align:center;"> Nao tem autorização para aceder a esta página!</div>';
}

?>
</body>
</html>

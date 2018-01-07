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
<div class="row">
  <div class="col-3">
  </div>
  <div class="col-5">
<div class="btnm4">
<input type="button" value="Apagar" class="btn2 btn-link btn-sm float-left" onClick="confirmDelete()" name="apagar">
</div>
</div>
</div>
<?php
$id=$_SESSION["userid"];

if($id>0){
$sql="SELECT id, firstname, lastname, email FROM utilizadores WHERE id='$id'";
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
        <p class="card-text">
    <div class="form-group">
      <div class="row">
          <div class="col">

            <div class="row">
            <div class="col">
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Primeiro Nome</label>
                  <div class="col-sm-8">
                    <input type="text" name="first" value="<?php echo $row['firstname'] ?>" class="form-control mt-2">
                  </div>
                </div>
              </div>
            </div>

  <div class="row">
  <div class="col">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Último Nome</label>
        <div class="col-sm-8">
          <input type="text" name="last" value="<?php echo $row['lastname'] ?>" class="form-control mt-2">
        </div>
  </div>
  </div>
</div>

  <div class="row">
  <div class="col">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-8">
          <input type="text" name="email" value="<?php echo $row['email'] ?>" class="form-control mt-2">
        </div>
  </div>
  </div>
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
   alert("Utilizador editado com sucesso!");
 }
 </script>

 <script type="text/javascript">
 function confirmDelete(){

   var confirmar;
   var conf= confirm("Tem a certeza que deseja eliminar o usuário?");

   if(conf==true){
     confirm=1;
    window.location.href="index.php?page=9&conf="+confirm;

   }
   else{

   }

 }
 </script>
<?php
$conf= @$_GET["conf"];

if($conf=='1'){
  include 'database/conn.php';
  $sql=mysqli_query($conn,"UPDATE utilizadores SET isDeleted='1', type='0' WHERE id='$id'");
    header("Location: index.php?page=7");
    include 'database/disc.php';
}
  if(isset($_POST["confirmar"])){
    include 'database/conn.php';
    if(empty($_POST["first"]) ||empty($_POST["last"]) || empty($_POST["email"])){
      echo 'Insira todos os dados corretamente!';
    }
    else{
      $first=mysqli_escape_string($conn, $_POST["first"]);
      $last=mysqli_escape_string($conn, $_POST["last"]);
      $email=mysqli_escape_string($conn, $_POST["email"]);

      if(strpos($first,'/')!==false ||strpos($first,';')!==false ||strpos($first,'(')!==false ||strpos($first,')')!==false ||strpos($first,'{')!==false ||strpos($first,'}')!==false ||strpos($first,';')!==false){
          echo "Caractéres inválidos!";
  }
  else if(strpos($last,'/')!==false ||strpos($last,';')!==false ||strpos($last,'(')!==false ||strpos($last,')')!==false ||strpos($last,'{')!==false ||strpos($last,'}')!==false ||strpos($last,';')!==false){
      echo "Caractéres inválidos!";
  }
  else if(strpos($email,'/')!==false ||strpos($email,';')!==false ||strpos($email,'(')!==false ||strpos($email,')')!==false ||strpos($email,'{')!==false ||strpos($email,'}')!==false ||strpos($email,';')!==false){
      echo "Caractéres inválidos!";
  }
  else{
    $sql=mysqli_query($conn,"UPDATE utilizadores SET firstname='".$first."', lastname='".$last."', email='".$email."' WHERE id='$_SESSION[userid]'");
      echo '<script>popupSuccessEdit()</script>';
      include 'database/disc.php';
  }
}
  }else if(isset($_POST["cancelar"])){
    header("Location: index.php?page=8&ped=$id");
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

<div class="row">
  <div class="col">
    <div class="card" style="width: 40rem;">
      <div class="card-body">
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Repita a Password</label>
    <input type="password" class="form-control" name="repassword" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Firstname</label>
    <input type="text" class="form-control" name="firstname" placeholder="First Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Lastname</label>
    <input type="text" class="form-control" name="lastname" placeholder="Last Name">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Email">
  </div>
  <select name="tipo" class="form-control mt-2">
    <option value="1">Formador</option>
    <option value="2">Diretor</option>
    <option value="3">Recursos Humanos</option>
  </select>
  <input type="submit" name="registar" class="btn btn-primary btn-sm mt-3 w-100" value="Registar">
</form>
</div>
</div>
</div>

<script>
function registerSuccess(){
  alert("Conta registada com sucesso!");
    window.location.href="backoffice.php";
}
</script>

<?php
if(isset($_POST["registar"])){
  include 'database/conn.php';
  $username= mysqli_escape_string($conn, $_POST["username"]);
  $password= mysqli_escape_string($conn, $_POST["password"]);
  $firstname= mysqli_escape_string($conn, $_POST["firstname"]);
  $lastname= mysqli_escape_string($conn, $_POST["lastname"]);
  $email= mysqli_escape_string($conn, $_POST["email"]);

$checked=0;
//Verificar se o username já existe
$sqlall="SELECT username FROM utilizadores";
$result=mysqli_query($conn, $sqlall);
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){
    if($username===$row["username"]){
      echo 'O username já está em uso!';
      $checked=1;
    }
  }
}

$checkeddir=0;
//Verificar se o tipo diretor já existe
if($_POST["tipo"]==2){
$sqltipo="SELECT type FROM utilizadores";
$result=mysqli_query($conn, $sqltipo);
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){
    if($row["type"]==$_POST["tipo"]){
      echo 'Já existe uma conta Diretor!';
      $checkeddir=1;
    }
  }
}
}

if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["repassword"]) || empty($_POST["email"]) || empty($_POST["firstname"]) || empty($_POST["lastname"])){
  echo 'Insira todos os campos respetivamente!';
}else if($_POST["password"]!=$_POST["repassword"]){
  echo 'As passwords não correspondem!';

  //Validações anti-injection
}else if(strpos($username,'/')!==false ||strpos($username,';')!==false ||strpos($username,'(')!==false ||strpos($username,')')!==false ||strpos($username,'{')!==false ||strpos($username,'}')!==false ||strpos($username,'<')!==false || strpos($username,'>')!==false){
    echo "Caractéres inválidos!";
}else if(strpos($password,'/')!==false ||strpos($password,';')!==false ||strpos($password,'(')!==false ||strpos($password,')')!==false ||strpos($password,'{')!==false ||strpos($password,'}')!==false||strpos($password,'<')!==false ||strpos($password,'>')!==false){
    echo "Caractéres inválidos!";
}else if(strpos($firstname,'/')!==false ||strpos($firstname,';')!==false ||strpos($firstname,'(')!==false ||strpos($firstname,')')!==false ||strpos($firstname,'{')!==false ||strpos($firstname,'}')!==false||strpos($firstname,'<')!== false ||strpos($firstname,'>')!==false){
    echo "Caractéres inválidos!";
}else if(strpos($lastname,'/')!==false ||strpos($lastname,';')!==false ||strpos($lastname,'(')!==false ||strpos($lastname,')')!==false ||strpos($lastname,'{')!==false ||strpos($lastname,'}')!==false||strpos($lastname,'<')!== false ||strpos($lastname,'>')!==false){
    echo "Caractéres inválidos!";
}else if(strpos($email,'/')!==false ||strpos($email,';')!==false ||strpos($email,'(')!==false ||strpos($email,')')!==false ||strpos($email,'{')!==false ||strpos($email,'}')!==false||strpos($email,'<')!== false ||strpos($email,'>')!==false){
    echo "Caractéres inválidos!";

    //Validação email
}else if(!strpos($email,'@') && !strpos($email, '.')){
  echo 'Insira um email válido!';
}
else{
  if($checked==0){
    if($checkeddir==0){
  mysqli_query($conn,"INSERT INTO utilizadores (username, password, firstname, lastname, email, type, isDeleted) VALUES('$username','$password','$firstname', '$lastname', '$email', '$_POST[tipo]','0')");
  echo '<script>registerSuccess()</script>';
  include 'database/disc.php';
}
}
}
}
 ?>
 </div>

<main>
<?php
@$id=$_REQUEST["page"];
//Validação contra injections
if($id>0){
switch($id){

  case '2':
   include 'formulario.php';
   break;

  case '3':
   include 'verificar.php';
   break;

   case '4':
   include 'pedidos.php';
   break;

   case '5':
   include 'pedido.php';
   break;

   case '6';
   include 'editarpedido.php';
   break;

   case '7';
   include 'gestaousers.php';
   break;

   case '8';
   include 'user.php';
   break;

   case '9';
   include 'edituser.php';
   break;

   case '10';
   include 'pedidosuser.php';
   break;

   case '11';
   include 'register.php';
   break;

   default:
   echo' Nao tem autorização para aceder a esta página!';
   break;
}

}else{
if($_SESSION["type"]=='4'){
  echo '<div style="text-align:middle;">Caracteres não são válidos como parâmetro!</div>';
}else{
    echo ' Nao tem autorização para aceder a esta página!';
}

}


?>
</main>

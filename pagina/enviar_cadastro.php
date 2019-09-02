<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <link rel="shortcut icon" href="favicon.ico">

    <title>Login</title>
     
    <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
      <link href="css/bootstrap-theme.css" rel="stylesheet" media="screen">
  	  <link href="css/theme.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    
 
  </head>

<body style="color: rgb(0, 0, 0);" alink="#ee0000" link="#0000ee" vlink="#551a8b">

<!-- Carregando o CSS do Bootstrap -->
<div style="background-color: rgb(2, 131, 214); height: 205px;" class="jumbotron">
<div style="text-align: center;"><span style="font-weight: bold;"></span><br>
<span style="font-weight: bold;"></span></div>
<div style="text-align: center;"><span style="font-weight: bold;"></span><big style="font-family: Cooper Black; color: rgb(255, 255, 255);"><big><big><big><big>DICOM Safe</big></big></big></big></big><br>
<span style="font-weight: bold;"></span></div>
</div>

 <div align=center>
<button type="button" class="btn btn-primary" onClick="location.href='login.php'">Retornar ao Login</button>  
</div>
 <br>

<?php
include "config.php"; //aqui inserimos as váriaveis da página de configuração

$db   = mysqli_connect ($host, $login_db, $senha_db,$database); //conectamos ao mysql
$tabela= "users";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
	$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
	$login = (isset($_POST['login'])) ? $_POST['login'] : '';
	$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
	$senha2 = (isset($_POST['senha2'])) ? $_POST['senha2'] : '';
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';
}

$sql = "SELECT * FROM `$tabela` WHERE login = '$login'";
$sql2 = "SELECT * FROM `$tabela` WHERE email = '$email'";

$pesquisar = mysqli_query($db,$sql); //conferimos se o login escolhido já não foi cadastrado
$contagem = mysqli_num_rows($pesquisar); //traz o resultado da consulta acima

$pesquisar2 = mysqli_query($db,$sql2); //conferimos se o email escolhido já não foi cadastrado
$contagem2 = mysqli_num_rows($pesquisar2); //traz o resultado da consulta acima
$errors = "";
if ( $contagem == 1 ) {
  $errors .= "Login escolhido já cadastrado.<br>"; //se o login já existir, ele adiciona o erro
  }
if ( $contagem2 == 1 ) {
  $errors .= "Email já cadastrado.<br>"; //se o email já existir, ele adiciona o erro
  }
if ( $login == "" ) {
  $errors .= "Você não digitou um login<br>"; //confere se o campo login não ficou vazio
  }

if ( $senha == "" ) {
  $errors .= "Você não digitou uma senha<br>"; //confere se o campo senha não ficou vazio
  }

if ( $senha != $senha2 ) {
  $errors .= "Você digitou 2 senhas diferentes.<br>"; //adiciona o erro caso o usuário digitou 2 senhas diferentes
  }

if ( $errors == "" ) { //checa se houve ou não erros no cadastro
  
  $sql="INSERT INTO `$tabela` (nome, login, senha,email,tipo_usuario) VALUES('$nome','$login','$senha','$email','2')";
  $cadastrar = mysqli_query( $db , $sql); //insere os campos na tabela

        if ( $cadastrar == 1 ) {
          echo "<div align=center><font size=2 face=Verdana, Arial, Helvetica, sans-serif><br><br><br>Cadastro com sucesso.</font></div>"; //se cadastrou com sucesso o usuário aparece essa mensagem
          } 
		  else {
         echo "<div align=center><font size=2 face=Verdana, Arial, Helvetica, sans-serif><br><br><br>Ocorreu um erro no servidor ao tentar se cadastrar.</font></div>"; //caso houver um erro quanto as configurações aparece essa mensagem
  			}
  		} else {
        echo "<div align=center><font size=2 face=Verdana, Arial, Helvetica, sans-serif>Ocorreu os seguintes erros ao tentar se cadastrar:<br><br>$errors</font></div>"; //mostra os erros do usuário, caso houver
        }
?>
 
</body>
</html>
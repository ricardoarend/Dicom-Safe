
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

	<div class="container">
	 
      <form method="post" action="valida.php" class="form-signin" role="form">
        <h2 class="form-signin-heading">Login </h2>
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="text" name="usuario" maxlength="50" class="form-control" placeholder="Login" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="senha" maxlength="50" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        <br>
        
        <button type="button" class="btn btn-primary" onClick="location.href='cadastrar.php'">Registrar</button> 
         
        <!-- <button type="button" class="btn btn-primary" onClick="location.href=''">Recuperar Senha</button> -->
        </form>
      
       
        
    </div> <!-- /container -->
   
 </body>
</html>
     
 
 
  




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <link rel="shortcut icon" href="favicon.ico">

    <title>Registrar</title>
     
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

<div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Regitro de Usuários</h3>
			 <form name="cadastrar" method="post" action="enviar_cadastro.php">
				<div class="form-group col-lg-12">
					<label>Nome</label>
					<input type="text" name="nome" class="form-control" id="nome" value="">
				</div>                
                <div class="form-group col-lg-6">
					<label>Login</label>
					<input type="text" name="login" class="form-control" id="login" value="">
				</div>				
                <div class="form-group col-lg-6">
					<label>Email </label>
					<input type="text" name="email" class="form-control" id="email" value="">
				</div>	                
				<div class="form-group col-lg-6">
					<label>Password</label>
					<input type="password" name="senha" class="form-control" id="senha" value="">
				</div>				
				<div class="form-group col-lg-6">
					<label>Repita o Password</label>
					<input type="password" name="senha2" class="form-control" id="senha2" value="">
				</div>	
                 <p>	
                     <button type="button" class="btn btn-default" onClick="location.href='login.php'">Voltar</button>	 
                     
				     <button type="submit" class="btn btn-primary" >Registrar</button>
                     </form>
                  </p>     
                    
			 </div>
		</div>
	</section>
</div>


</body>
</html>
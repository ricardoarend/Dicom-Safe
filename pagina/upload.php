<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/bootstrap-theme.css" rel="stylesheet" media="screen">
  <link href="css/theme.css" rel="stylesheet">
  <title>Dicom Safe</title>
  <link rel="shortcut icon" href="favicon.ico">
</head>

<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
if(isset($_POST["botao"])){ 
	expulsaVisitante();
}
?>

<body style="color: rgb(0, 0, 0);" alink="#ee0000" link="#0000ee" vlink="#551a8b">

<!-- Carregando o CSS do Bootstrap -->
<div style="background-color: rgb(2, 131, 214); height: 205px;" class="jumbotron">
<div style="text-align: center;"><span style="font-weight: bold;"></span><br>
<span style="font-weight: bold;"></span></div>
<div style="text-align: center;"><span style="font-weight: bold;"></span><big style="font-family: Cooper Black; color: rgb(255, 255, 255);"><big><big><big><big>DICOM Safe</big></big></big></big></big><br>
<span style="font-weight: bold;"></span></div>
</div>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="main.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="upload.php">Upload</a></li>
        <li><a href="consulta.php">Consulta</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <div class="control-group">
  			<label class="control-label"></label>
 				 <div class="controls">
 			 <form action="" method="post">
   		 		<button id="botao" name="botao" class="btn btn-primary">Logout</button>
                 </form>
 	    		 </div>
       </div>
     </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 <div id="wrap">

    	 <form action="inclui_metadado.php" method="post" enctype="multipart/form-data"> 
         <input type="file" 
         name="arquivo" 
         size="40"  
         id="arquivo" 
         value="30000"/>
        </a>
        <br>
        <input type="submit"  value="Enviar"> 
		<input type="reset" value="Apagar">
        </form>   
 
  </div>
<br>
<br>
</body>
</html>
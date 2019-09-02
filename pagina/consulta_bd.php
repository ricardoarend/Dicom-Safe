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

<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
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
      <a class="navbar-brand" href="http://localhost/pagina/main.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/pagina/upload.php">Upload</a></li>
        <li class="active"><a href="http://localhost/pagina/consulta.php">Consulta</a></li>
      </ul>
      </ul><form method="GET" action="consulta_bd.php" class="navbar-form navbar-left" role="search">
        <div class="form-group"> 
          <input type="text" id="consulta" name="consulta" maxlength="255" class="form-control" placeholder="Search">
        </div> 
        <button type="submit" class="btn btn-default">Submit</button>
      </form>       
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
 
 
<?PHP
 
include "config.php";
require_once('class_dicom.php');

$busca = $_GET['consulta'];

// conecta ao banco de dados

$con = new mysqli($host, $login_db, $senha_db, $database);

if ($con->connect_error) {
  trigger_error('Database connection failed: '  . $con->connect_error, E_USER_ERROR);
}

$sql = $con->query("SELECT * FROM metadado WHERE nome_imagem ='$busca' OR nome_paciente LIKE '%$busca%'");
 

if(mysqli_num_rows($sql) == 0){
	echo " Erro! Esta imagem Não Existe";
	 mysqli_close($con);
	exit();
}
else{
	
  while($exibe =  mysqli_fetch_array($sql)){	
  
  $imagem=$exibe['nome_imagem'];
  $temp= "imagens/$imagem.dcm";
  $temp2="imagens/$imagem.jpg";
 
   echo "<a href='download.php?arquivo=$temp'>Baixar DCM</a> ";    echo "&nbsp &nbsp <a href='download.php?arquivo=$temp2'>Baixar JPEG</a> ";
   echo "<br>";

  
  
    echo "<img src= imagens/$imagem.tn.jpg <br><br>";  
    echo "<br>";
 
 //$exibe =  mysqli_fetch_array($sql);
 
 	echo "Data do Exame: ";
    echo  $exibe['data_exame'] ;
	echo "<br>";
	
	echo "Instituição: ";
	echo  $exibe['local_exame'] ;
	echo "<br>";
	
	echo "Operador: ";
	echo  $exibe['operador_exame'] ;
	echo "<br>";
	
	echo "Paciente: ";
	echo  $exibe['nome_paciente'] ;
	echo "<br>";

 		  		
	echo "ID Paciente: ";
	echo  $exibe['id_paciente'] ;
	echo "<br>";
		
	echo "Data de Nascimento: ";
	echo  $exibe['birth_paciente'] ;
	echo "<br>";
			
	echo "Sexo: ";
	echo  $exibe['sexo_paciente'] ;
	echo "<br>";
			
	echo "Idade: ";
	$exibe['idade_paciente'] = str_replace('Y', ' Anos', $exibe['idade_paciente']);
	echo  $exibe['idade_paciente'] ;
	echo "<br>";
			
	echo "Região Examinada: ";
	echo  $exibe['regiao_exame'] ;
	echo "<br><br><br>";
	 
  }
  mysqli_close($con);
}

?>
</div>
<br>
<br>
</body>
</html>
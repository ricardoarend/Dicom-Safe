
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
<div style="text-align: center;"><span style="font-weight: bold;"></span><big style="font-family: Cooper Black; color: rgb(255, 255, 255);">
<big><big><big><big>DICOM Safe</big></big></big></big></big><br>
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
        <li class="active"><a href="http://localhost/pagina/upload.php">Upload</a></li>
        <li><a href="http://localhost/pagina/consulta.php">Consulta</a></li>
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


require_once('class_dicom.php');

//pega o nome do arquivo enviado e a extensão

$nome_real=$_FILES["arquivo"]["name"];
 
$extensao = pathinfo($nome_real, PATHINFO_EXTENSION);
$nome_base= pathinfo($nome_real, PATHINFO_FILENAME);


// testa o formato do arquivo
$exten['extensoes'] = array('dcm');
if (array_search($extensao, $exten['extensoes']) === false) {
	echo "Por favor, envie arquivos no formato DICOM (.dcm)";
	exit;
}
// salva uma copia do arquivo enviado na pasta imagens e cria variavel com o local

$nome_temporario=$_FILES["arquivo"]["tmp_name"];
copy($nome_temporario,"imagens/$nome_real");

$file = "imagens/$nome_real";
  
   
// conecta ao banco de dados
$host = "localhost"; $db = "ricardo"; $user = "ricardo"; $pass = "123";
$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
  trigger_error('Database connection failed: '  . $con->connect_error, E_USER_ERROR);
}


// testa se já tem uma imagem com mesmo nome no banco 
$sql = $con->query("SELECT * FROM metadado WHERE nome_imagem ='$nome_base'");
if(mysqli_num_rows($sql) > 0){
echo " Erro! Esta imagem ja existe";
 mysqli_close($con);
exit();
}

else{
// Gera um JPEG e uma Thumb da imagem e retira o .dcm dos nomes
$d = new dicom_convert;
$d->file = $file;
$d->dcm_to_jpg();
$d->dcm_to_tn();
$nomeAntigo ="imagens/$nome_real.jpg";
$novoNome = "imagens/$nome_base.jpg";

rename($nomeAntigo,$novoNome);

$nomeAntigo ="imagens/$nome_real.tn.jpg";
$novoNome = "imagens/$nome_base.tn.jpg";
rename($nomeAntigo,$novoNome);


// exibe o thumb na tela
$thumb = "imagens/$nome_base.tn.jpg";
echo "<img src= $thumb <br><br>";
 
system("ls -lsh $file*");

// pega os metadados da imagem e salva nas variaveis utilizando as tags
$d = new dicom_tag;
$d->file = $file;
print "Imagem Processada e Salva no Banco: " . $d->load_tags();
print $nome_real;

$tag10 = $d->get_tag('0008','0020');
$tag20 = $d->get_tag('0008','0080');
$tag30 = $d->get_tag('0008','1070');
$tag40 = $d->get_tag('0010','0010');
$tag50 = $d->get_tag('0010','0020');
$tag60 = $d->get_tag('0010','0030');
$tag70 = $d->get_tag('0010','0040');
$tag80 = $d->get_tag('0010','1010');
$tag90 = $d->get_tag('0018','0015');	

// Faz o Tratamento dos Metadados retirando Strings indesejadas e arrumando o formato das Datas 
$string = substr("$tag40", 0, 2);
if($string =='AS'){
	$tamanho = strlen($tag40);
	$tag40 = substr( $tag40 ,2,$tamanho);
	}
$tag40 = str_replace('^', ' ', $tag40);
$arr_replace = array('^', "'", '"', '`', '/', '\\', '?', ':', ';','TESTE','teste','Teste');
foreach($arr_replace as $replace) {
    $tag40 = str_replace($replace, '', $tag40);
    $tag50 = str_replace($replace, '', $tag50);
	}
$b_year = date('Y', strtotime($tag60));
$b_month = date('m', strtotime($tag60));
$b_day = date('d', strtotime($tag60));
  
$s_year = date('Y', strtotime($tag10));
$s_month = date('m', strtotime($tag10));
$s_day = date('d', strtotime($tag10));


// Pega o nome do usuário logado na sessão 

$username= $_SESSION['usuarioNome'];

//Faz a Inserção no Banco e fecha conexão 

$sql="INSERT INTO metadado (nome_imagem, usuario, data_exame, local_exame, operador_exame, nome_paciente, id_paciente, birth_paciente, sexo_paciente, idade_paciente,regiao_exame) VALUES ('$nome_base', '$username','$s_day/$s_month/$s_year','$tag20', '$tag30', '$tag40','$tag50','$b_day/$b_month/$b_year','$tag70','$tag80','$tag90')";
mysqli_query($con,$sql);
 
mysqli_close($con);
	
}

?>
</div>
</body>
</html>
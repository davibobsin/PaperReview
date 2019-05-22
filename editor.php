
<html>
<head>
	<meta charset="utf-8">
	<title>DOCGEN EDITOR</title>
	<!--<link rel="stylesheet" type="text/css" href="images/style.css">-->
	<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script language="JavaScript" src="script.js"></script>

	<script type="text/javascript">
	//<![CDATA[
	    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	//]]>
	</script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
	.titulo{
		padding:8px;
		display:block;
		border:none;
		border-bottom:1px solid #ccc;
		width:100%
		}
	</style>
</head>
<body>

<script language="javascript">
window.onload = function(e){ 
  setTimeout(function(){ $(".result").fadeOut(); }, 3000);
}
</script>


<?php
//---------------- VERIFICA SE FOI TENTADO SALVAR
if (isset($_POST['content_text']) && isset($_POST['filename']) && isset($_POST['title'])) // && isset($_POST['title'] && isset($_POST['filename'])) 
{
	$my_file = $_POST['filename'];
	$fp = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
	fwrite($fp,$_POST['title']."\n");
	fwrite($fp,$_POST['content_text']);
	echo "<div id=\"success\" class=\"result\">";
        echo "Documento \"".$_POST['filename']."\" salvo.";
	echo "</div>";
}
//---------------- TENTA ABRIR ARQUIVO
if(isset($_GET['filename']))
	$filename = $_GET['filename'];
	$fp = fopen($filename,'r') or die('Cannot open file:  '.$filename);
	$content = file_get_contents($filename);
	$title = strtok($content,"\n");
	$text = strtok("\0");

?>

	<form action="" method="post">
		<input type="hidden" name="filename" value="<?php echo $filename;?>"><br>
		<input class="titulo" type="text" name="title" value="<?php echo $title;?>"><br>

		<div id="sample">

		<textarea name="content_text" style="width:100%;">
		  <?php echo $text;?> 
		</textarea><br />
		</div>
		<input type="submit" value="Salvar" class="button"/>
	</form>

</body>
</html>



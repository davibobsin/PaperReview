<?php 
$info = file_get_contents("info.txt");
$title_page = strtok($info, "\n");
$desc_page = strtok("\0");
?>

<html>
<head>
	<title><?php echo $title_page;?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script language="JavaScript" src="script.js"></script>
</head>
<body>

<ul>
  <li><a class="trigger_upload" alt="oi"><img src="upload.png"></a></li>
  <li><a class="trigger_edit"><img src="edit.png"></a></li>
  <li><a class="trigger_info"><img src="info.png"></a></li>
</ul>


<div style="padding-top:50px;background-color:#39f;width=100%;"></div>

<?php
if(isset($_POST["upload"])) {
$error = "";
$target_dir = "./Artigos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    $error = $error."Sorry, file already exists.\n";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $error = $error."Sorry, your file is too large.\n";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "pdf") {
    $error = $error."Sorry, only PDF are allowed.\n";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error = $error."Sorry, your file was not uploaded.\n";
	echo "<div id=\"error\" class=\"result\">";
	echo $error;
	echo "</div>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	echo "<div id=\"success\" class=\"result\">";
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	echo "</div>";
	$my_file = 'Descricoes/'.basename($_FILES["fileToUpload"]["name"],".pdf").".txt";
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	chmod($handle, 0777);
	fwrite($handle, "NOME\nCRIADO");
    } else {
        $error = $error."<b>Sorry, there was an error uploading your file.</b>";
	echo "<div id=\"error\" class=\"result\">";
	echo $error;
	echo "</div>";
    }
}
}
echo "</div>";
?>

<?php
	echo "<h1>
		<a class=\"edit\" href=\"../docgen/editor.php?filename=".getcwd()."/info.txt"."\" target=\"_blank\">
			<img src=\"pencil.png\">
		</a>".$title_page."</h1>";
	echo "<p>".$desc_page."</p>";
?>

<script language="javascript">
window.onload = function(e){ 
  setTimeout(function(){ $(".result").fadeOut(); }, 3000);
}
</script>



<table border="1px">

<?php
$dir    = '.';
$files1 =  glob('./*.txt', GLOB_BRACE);
$files2 = scandir($dir, 1);

$artigos = glob('./Artigos/*.pdf',GLOB_BRACE);

foreach($artigos as &$fn)
{
	$name = basename($fn,'.pdf');
	$desc = './Descricoes/'.$name.'.txt';
	if(file_exists($desc))
	{
	
	$line = file_get_contents($desc);
	$title = strtok($line, "\n");
	$text = strtok("\0");
	echo "<td>
		<a class=\"edit\" href=\"editor.php?filename=".$desc."\" target=\"_blank\">
			<img src=\"pencil.png\">
		</a>
		<a href=\"".$fn."\" target=\"_blank\">".$title."</a>
		</td>";
	echo "<td>".$text."</td>";
	echo "</tr>";
	
	//$fclose($fp);
	}
}
unset($fn); 

?>

</table>


<div class="hover_info">

    <span class="helper"></span>
    <div>
        <div class="close_info">X</div>
        <h3>Editor utilizando <b>NicEdit</b>.<br></h3>
        <h3>Davi Ebert Bobsin.<br></h3>
        <h3>2019</h3>	
    </div>
</div>

<div class="hover_upload">

    <span class="helper"></span>
    <div>
        <div class="close_upload">X</div>
        
	
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="upload">
</form>
	
    </div>
</div>
</body>
</html>

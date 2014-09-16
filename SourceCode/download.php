<!DOCTYPE html>
<html>
<head>
<link href="Prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="Prettify/prettify.js"></script>
</head>
<style>
body {
	background-color:#D5D1D1;
	margin-left: 90px;
	margin-top: 15px;
	margin-right: 90px;
}
h3 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 18pt;
	color: navy;
	padding-top: 12px;
	padding-bottom: 3px;
}
</style>
<body onLoad="prettyPrint()">

<?php
//require_once('genFile.php');
$programText = base64_decode($_GET['sita']);
$filename = $_GET['aur'];
$output = base64_decode($_GET['gita']);
?>

<center>
<table width="100%">
	<tr>
		<th><h3>CODE</h3></th>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF"><pre class="prettyprint linenums:1" style="border: 1px solid #888;padding: 2px"><?php echo $programText;?></pre></td>
	</tr>
</table>

<table width="100%">
	<tr>
		<th><h3>OUTPUT</h3></th>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF"><pre class="prettyprint linenums:1" ><?php echo $output;?></pre></td>
	</tr>
</table>
</center>
<?php
/*$fileDL = generateFileName();
	if ($comp == 'Isee') {
		$fileExt = '.c';
		$file = fopen($fileDL.$fileExt, 'w', 1);
		fwrite($file, $programText);
		fclose($file);
	}
	elseif ($comp == 'IseeWithClass') {
		$fileExt = '.cpp';
		$file = fopen($fileDL.$fileExt, 'w', 1);
		fwrite($file, $programText);
		fclose($file);
	}
	elseif ($comp == 'oopsJava'){
		$fileExt = '.java';
		$file = fopen($fileDL.$fileExt, 'w', 1);
		fwrite($file, $programText);
		fclose($file);
	}
	else {
		
	}
*/
?>
<br><br>
<a style="text-decoration:none" href="fileDW.php?filename=<?php echo $filename;?>">Download</a>
</body>
</html>

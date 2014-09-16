<!DOCTYPE html>
<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="jquery-linedtextarea.js"></script>
<link href="jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
<body>
<?php 
$comp = @$_POST['compiler_list'];
if ($comp == 'Isee') {
	$redirectPage = "gccOnline.php";
}

else if($comp == 'IseeWithClass') {
	$redirectPage = "gppOnline.php";
}
else
	$redirectPage = "JavaOnline.php";
?>
<form name="form1" method="post" action="<?php echo $redirectPage;?>" target="content">
	<center>
	<textarea name = "text-area3" id = "text-area3" value = "<?php echo $text-area3?>" class = "formtextarea" cols="75" rows="27"><?php if (isset($_POST['text-area3'])) echo $_POST['text-area3'] ?></textarea>
	<script>
		$(function() { $("#text-area3").linedtextarea(); });
	</script>
	<br>
	<input type="submit" value="Run">
	</center>
</form>
</body>
</html>

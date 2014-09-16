<!DOCTYPE html>
<html>
<body>
<style>
body {
	background-color:#D5D1D1;
	margin-left: 25px;
}
</style>
<span style="font-family: monospace;">
<?php
	$data = @$_POST['text-area3'];
	$tempdata = htmlentities($data);
	$toBe = base64_encode($tempdata);
	$text = trim($data);
	preg_match_all('/(class)([\s\t ]+)(\w*)([\s\t\r\n ]*?)/', $text, $matches);
	$final = explode(" " ,$matches[0][0]);
	$classname = $final[1];
	$file = "$classname.java";
	$outputFile  = "$classname";
	$fp = fopen($file, "w") or die("");
	fwrite($fp, $data) or die("");
	fclose($fp);
	
	$descriptorspec = array(
		0 => array("pipe", "r"),
		1 => array("pipe", "w"),
		2 => array("pipe", "w")
	);
	
	$command = "javac ".$file;
	$process = proc_open($command, $descriptorspec, $pipes, dirname(__FILE__), NULL);

	if (is_resource($process)) {
		$stderr = stream_get_contents ($pipes[2]);
		fclose ($pipes[2]);
		echo "<br>";
		//var_dump($stderr);
		if (strlen($stderr) == 0) {
			$run_command = "java ".$outputFile;
			$run_process = proc_open($run_command, $descriptorspec, $pipes, dirname(__FILE__), NULL);
			$stdout = stream_get_contents ($pipes[1]);
			fclose ($pipes[1]);
			echo "<br><br>";
			echo "<font size=+1><b>"."OUTPUT:"."</b></font><br>";
			//var_dump($stdout);
			$tempout = htmlentities($stdout);
			$toBeOP = base64_encode($tempout);
			echo "<pre>".nl2br ($tempout)."</pre>";
			$stderr = stream_get_contents ($pipes[2]);
			fclose ($pipes[2]);
			if (strlen($stderr) != 0)
				echo "<br>"."Still some problem! ....";
		}
		else {
			echo "There were some compilation errors!"." "."Terminating program execution..."."<br>";
			echo "The errors are as follows:"."<br>";
			$temperr = htmlentities($stderr);
			$toBeERR = base64_encode($temperr);
			echo "<pre>".nl2br ($temperr)."</pre>";
		}
		$return_value = proc_close($process);
	}
?>
</span>
<br><br>
<a style="text-decoration:none" href="download.php?sita=<?php echo $toBe;?>&aur=<?php echo $file;?>&gita=<?php echo $toBeOP;?>" target="_blank">Share</a>
</body>
</html>

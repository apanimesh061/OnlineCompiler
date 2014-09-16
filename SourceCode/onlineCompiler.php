<!DOCTYPE html>
<html>
<head>
<script src="jquery-1.8.3.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="../edit_area/edit_area_full.js"></script>
<script src="tabSlideOut.js"></script>
<script type="text/javascript">
    $(function(){
        $('.slide-out-div').tabSlideOut({
            tabHandle: '.handle',                     //class of the element that will become your tab
            pathToTabImage: 'images/template.jpg', //path to the image for the tab //Optionally can be set using css
            imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
            imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
            tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
            speed: 500,                               //speed of animation
            action: 'hover',                          //options: 'click' or 'hover', action to trigger animation
            topPos: '15px',                          //position from the top/ use if tabLocation is left or right
            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
            fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
        });

    });
	$(function(){
        $('.slide-out-div1').tabSlideOut({
            tabHandle: '.handle1',                     //class of the element that will become your tab
            pathToTabImage: 'images/tut.jpg', //path to the image for the tab //Optionally can be set using css
            imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
            imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
            tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
            speed: 500,                               //speed of animation
            action: 'hover',                          //options: 'click' or 'hover', action to trigger animation
            topPos: '140px',                          //position from the top/ use if tabLocation is left or right
            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
            fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
        });

    });
	editAreaLoader.init ({
		id : "text-area3" ,syntax: "cpp" ,start_highlight: true
	});
	function newPopup(url) {
		popupWindow = window.open(
			url,'popUpWindow','height=600,width=600,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'
	    );
	}
	function CopyMe(oFileInput) {
		var filePath = oFileInput.value;
		fh = fopen(filePath, 0);
		if (fh!=-1) {
			length = flength(fh);
			str = fread(fh, length);
			fclose(fh);
		}
		document.getElementByID('text-area3').innerHTML = str;
	}
	/*function updateSave() {
		document.form1.action = "<?php echo $_SERVER['PHP_SELF'] ?>";
		document.getElementsByName("text-area3").innerHTML = "<?php Read("document.write(CopyMe(oFileInput));");?>";
		document.form1.submit();
		return true;
	}*/
</script>
<style type="text/css">      
    .slide-out-div {
        padding: 35px;
        width: 260px;
        background: #ccc;
        border: 1px solid #29216d;
    }
	.slide-out-div1 {
        padding: 35px;
        width: 260px;
        background: #ccc;
        border: 1px solid #29216d;
    }	
	body {
		background-color:#D5D1D1;
		margin-left: 28px;
		margin-top: 15px;
		margin-right: 15px;
	}
	a {
		font-family: Arial;  
        font-size: 15px;  
    }          
    a:link {
		color: #0000FF;
    }  
    a:visited {  
		color: #000000;  
    }
    a:active {  
		color: #666666;  
    }
    a:hover {  
		color: #FF0000;
    }
	input[type="file"] {
		border:1px dotted #000;
	}
</style>
</head>
<div class="slide-out-div1">
            <a class="handle1" href="http://link-for-non-js-users.html">Content</a>
            <h3>Contact me</h3>
            <p>Thanks for checking out my jQuery plugin, I hope you find this useful.
            </p>
            <p>This can be a form to submit feedback, or contact info</p>
</div>
<body>

<?php
function Read($file){
	echo file_get_contents($file);
};

/*function Write($file){
	$fp = fopen($file, "w");
	$data = $_POST["text_area3"];
	fwrite($fp, $data);
	fclose($fp);
};*/

$comp = @$_POST['compiler_list'];
if ($comp == 'Isee') {
	$redirectPage = "gccOnline.php";
?>
<div class="slide-out-div">
            <a class="handle" href="#"></a>
			<a style="text-decoration:none" href="#">BASIC PROGRAM STRUCTURE</a><br><br>
			<a style="text-decoration:none" href="#">CONTROL STRUCTURE</a><br><br>
			<a style="text-decoration:none" href="#">FUNCTIONAL STRUCTURE</a>
</div>
<?php
}
else if($comp == 'IseeWithClass') {
	$redirectPage = "gppOnline.php";
?>
<div class="slide-out-div">
            <a class="handle" href="#"></a>
			<a style="text-decoration:none" href="##">BASIC PROGRAM STRUCTURE</a><br><br>
			<a style="text-decoration:none" href="##">CONTROL STRUCTURE</a><br><br>
			<a style="text-decoration:none" href="##">FUNCTIONAL STRUCTURE</a>
</div>
<?php
}
else {
	$redirectPage = "JavaOnline.php";
?>
<div class="slide-out-div">
            <a class="handle" href="#"></a>
			<a style="text-decoration:none" href="###">BASIC PROGRAM STRUCTURE</a><br><br>
			<a style="text-decoration:none" href="###">CONTROL STRUCTURE</a><br><br>
			<a style="text-decoration:none" href="###">FUNCTIONAL STRUCTURE</a>
</div>
<?php
}
?>

<form name="form1" method="post" action="<?php echo $redirectPage;?>" target="content">
<textarea name = "text-area3" id = "text-area3" value = "<?php echo $text-area3;?>" class = "formtextarea" cols="78" rows="32"><?php if (isset($_POST['text-area3'])) echo $_POST['text-area3']; ?></textarea>
<br>
<input type="file" id="form1_field1" onchange="CopyMe(this);">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="Run" name="rubButton">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a style="text-decoration:none" href="JavaScript:newPopup('the_complete_reference_c++.pdf');">Help</a>
</form>
</body>
</html>

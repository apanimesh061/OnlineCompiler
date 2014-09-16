/* Cool Javascript Progress Bar for HTML Page Version 1.4
Written by: Jeff Baker on 9/6/07 
Copyright 2010 By Jeff Baker - 
www.seabreezecomputers.com
This javascript when called at the beginning of your HTML code
will pop up a progress bar in the middle of the screen and
dynamically show you the percentage of your images that are
loaded. Paste the following code just before </HEAD> in your
HTML document:

<script type="text/javascript" language="JavaScript" src="progress.js">
</script>  

Cross Browser Support: This javascript seems to work
fine in IE 6+, Firefox 1.5 and up, Safari 3.0, and Netscape 6+ */

/*  You may edit the following variables */
var bar_length = 300; // the bar will be this many pixels long
var bar_height = 30; // the bar will be this many pixels high
var bar_color = "red"; // the progress bar color
var bar_background = "white"; // the color of the empty part of bar
var bar_border = "blue";  // the color of the bar border
var window_background = "black"; // the color of the pop-up window
var window_border = "blue"; // the border color of pop-up window
var text_color = "blue"; // the color of the percentage text (50%)
var display_close_button = 1; // 1 = on; 0 = off
/*  Change display_close_button to 0 if you do not want the
closing x to appear on the progress bar pop up window.  However,
you may want to leave the close button on because every once in
a while there may be a mess up with the images (like one of
the images refuses to load) and then the progress bar may never
close by itself.  But regardless of having the close button
display or not, the user can still close the progress bar
window by clicking anywhere on it, but they may not know that
unless you display a close button.

/* the 'wait' variable below should only matter for older
browsers or browsers other than IE, Firefox, Netscape and Safari.
For these other browsers the progress bar will not close until
'wait' seconds have past.  If you have a fast loading page you
may want to set this to 4000 or smaller, but if you have a lot
of dial-up users visiting your website or you have a slow loading
page then you may want to change it to 7000 or higher.
Instead of relying on the timer to tell the progress bar to
close, you may want to just uncomment 'window.onload = saydone'
below, but only if you are not using a window.unload function. */
var wait = 5000; // How many milliseconds to wait for other browsers

//window.onload = saydone;

/* Do NOT edit anything below this point */

var more = 0; // Add more to the bar ever second
var doneyet = 0;  // changes to 1 when the DOM is done loading


function setup_bar()
{
	// Add 50 to the window_width so that it can have 25px borders
	window_width = bar_length + 50;
	// Add 50 to window_height so that is can have 25px borders
	window_height = bar_height + 50;
	
	if (document.all) // if IE
	{
		// Internet Explorer makes the bar two pixels too low
		bar_height2 = bar_height - 2; 
		// Internet Explorer makes empty_bar 4 pixels too thin
		bar_width2 = bar_length + 3;
	}
	else
	{
		bar_height2 = bar_height;
		bar_width2 = bar_length + 1;
	}
	
	/* Now we create the pop-up window for the progress bar.
	screen.height and screen.width gives us the height and width
	of the user's screen so that we can center the window in it. */
	document.write('<div id="bar_window" style="position: absolute;'
		+ 'top: ' + ((screen.height - window_height)/4) + 'px'
		+ ';left: ' + ((screen.width - window_width)/4) + 'px'
		+ ';border: 2px solid ' + window_border
		+ ';background-color: ' + window_background
		+ ';width: ' + window_width + 'px'
		+ ';height: ' + window_height + 'px'
		+ ';color: ' + text_color
		+ ';" onClick="close_bar()">');
	// Now we draw a closing x on the top right corner.
	// You can remove this if you want. But it lets the user
	// kind of know that if something messes up (like an image
	// is missing) so that the progress bar never finishes and
	// the progress bar window never closes then they can close
	// the progress bar window by clicking on the window (hence
	// the onClick="close_bar()" statement above.  Note: The
	// progress bar will usually close even on mess ups
	// in most browsers except IE.
	if (display_close_button)
	{
		document.write('<div style="position=absolute;'
			+ 'top: 0' + 'px'
			+ ';left: 0' + 'px'
			+ ';width: ' + (window_width - 3) + 'px'
			+ ';background-color: ' + window_background
			+ ';color: ' + text_color
			+ ';text-align: right'
			+ ';">');
		document.write('[X]</div>');
	}
	
	/* Now we create the empty part of the progress bar with its
	border */
	document.write('<div id="empty_bar" style="position: absolute;'
		+ 'top: ' + 25 + 'px'
		+ ';left: ' + 25 + 'px'
		+ ';border: 1px solid ' + bar_border
		+ ';background-color: ' + bar_background
		+ ';width: ' + bar_width2 + 'px'
		+ ';height: ' + bar_height + 'px'
		+ ';">');
	document.write('</div>'); // close DIV for empty_bar
	
	/* Now we create the part that will display the progress bar.
	At first it is the width of 0 because percent is 0. */
	document.write('<div id="bar" style="position: absolute;'
		+ 'top: ' + 26 + 'px'
		+ ';left: ' + 26 + 'px'
		+ ';background-color: ' + bar_color
		+ ';width: ' + 0 + 'px'
		+ ';max-width: ' + bar_width2 + 'px' // Bug fix from Martijn189 on 4/13/10
		+ ';height: ' + bar_height2 + 'px'
		+ ';">');
	document.write('</div>'); // close DIV for bar
	
	/*  Now we create the text part that will display the percent */
	document.write('<div id="percent" style="position: absolute;'
		+ 'top: ' + 25 + 'px'
		+ ';width: ' + window_width + 'px'
		+ ';text-align: center'
		+ ';vertical-align: middle'
		+ ';color: ' + text_color
		+ ';font-size: ' + bar_height + 'px'
		+ ';">');
	document.write('0%'); // Display 0%
	document.write('</div>');  // close DIV for percent
	
	document.write('</div>'); // close DIV for bar_window
	
		
} // end function setup_bar()

function progress_bar()
{

/* the following document element retreives the number of
images on the HTML document */
var image_count = document.getElementsByTagName("span").length;

/* the following variable gets an array of all the images
in the document */
var image_array = document.getElementsByTagName("span");

/* Each part of the progress bar will be bar_length divided by
image_count rounded. For example: If there are 5 images and
the total bar_length is 300 then each bar_part will be 60 */
var bar_part = Math.round(bar_length / image_count);

/* To display the correct percentage, bar_perc is 100 divided
by the number of images on the page rounded */
var bar_perc = Math.round(100 / 10);
	
	var new_width = 0; // Will become new width of progress bar
	var j = 0;  // count how many images are complete
	var percent = 0; // Add up the percentage
	
	for (var i = 0; i < image_count; i++)
	{
		/* The javascript variable 'complete' when used on an
		image element retrieves whether an image is done
		loading or not.  It returns true or flase */
		if (image_array[i].complete)
		{
			percent = percent + bar_perc;
			new_width = new_width + bar_part;
			j++;
		}
	}
	
	// If the new_width is not growing because an image is still
	// loading then we want to make the bar go up 1% every 1 second
	// as long as it has not reached the next bar_part
	 if (new_width <= parseFloat(document.getElementById('bar').style.width)
		&& new_width < (j*bar_part + bar_part))
	{
		more = more + .50;
		new_width = new_width + Math.round(more);	 
		percent = percent + Math.round(more);
	}
	else
		more = 0;  // reset more if we loaded next image 
	
	// The is so the percentage can never go past 100
	if (percent > 100) { percent = 100; } // Bug fix from Martijn189 on 4/13/10
	
	// Write the new percent in the progress bar window
	document.getElementById('percent').innerHTML = percent + '%';
	// Make the width of the bar wider so that it matches the percent
	document.getElementById('bar').style.width = new_width + 'px';
	
	//checkstate(); // need for safari
	//document.getElementById('bar').innerHTML = document.readyState;
	
	/* If all the images have not loaded then call this
	function again in 500ms.  There must be at least one
	image in the document or the progress bar window
	never closes */
	if (j < image_count || j == 0 || doneyet == 0)
		setTimeout('progress_bar();', 500); 
	else // if done then close the progress bar pop-up window
		setTimeout('close_bar();', 500); // in half a second
} // end function progress_bar()




function close_bar()
{
	//if done then close the progress bar pop-up window
	document.getElementById('bar_window').style.visibility = 'hidden';

}  // end function close_bar()




// If IE
if(document.readyState)	
{
	document.onreadystatechange=checkstate;
}
else if (document.addEventListener) // if Mozilla or Netscape
{
	document.addEventListener("DOMContentLoaded", saydone, false);
}

	
function checkstate()
{
	// Besides IE, Safari also can use document.readyState
	// but Safari does not support onreadystatechange, so
	// we will keep calling this function with progress_bar().
	
	// Check to see if document is not "complete" but
	// is loaded enough to be "interactive"
	if (document.readyState=="complete" ||
		document.readyState=="complete")
		doneyet = 1;

} // end function checkstate()

function saydone()
{
	doneyet = 1;
}  // end function saydone()

// for other browsers that don't have DOM complete variables
setTimeout('saydone();', wait);


setup_bar(); // call the function setup_bar() first
progress_bar(); // then call the progress_bar() function

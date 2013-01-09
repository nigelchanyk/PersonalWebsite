// JavaScript Document
var quotes = ['I always indent my code.', 'Keyboard failure. Strike F1 to continue.', '\' or \'1\' = \'1', 'Did you know that 68.7% of all statistics are made up?', 'I know all Greek letters, but I can\'t speak Greek.', 'Did I tell you that almost half of the people in my class are below the class median?', 'Have you ever tried "del C:\\Windows\\System32" in command prompt? (Just joking. Don\'t do it...)', 'Resize your current window, and you will understand what responsive web design is (if supported).'];
var quoteIndex = Math.floor(Math.random() * quotes.length) % quotes.length;
var animatingMenu = false;
var menuOpened = false;
var compatibleMode = false;
var lastWidth = 0;

function changeQuote() {
	if (window.innerWidth < 480)
		return;
	
	//iterate through all quotes
	var temp;
	do {
		temp = Math.floor(Math.random() * quotes.length) % quotes.length;
	} while (temp == quoteIndex);
	quoteIndex = temp;
	$('#quote').fadeOut('slow', function() {
		document.getElementById("quote").innerHTML = quotes[quoteIndex];
		$('#quote').fadeIn('slow');
	});
}

$(document).ready(function(){
	lastWidth = window.innerWidth;
	
	if (Modernizr.mq('only all')) {
		if (lastWidth < 480) {
			$("#quote").hide();
		}
		
		$("#topnav-div").click(function() {
			if (animatingMenu)
				return;
			if (window.innerWidth >= 600)
				return;
			
			if (menuOpened) {
				$("ul.topnav").slideUp('slow', function() { menuOpened = false; animatingMenu = false; });
			}
			else {
				$("ul.topnav").slideDown('fast', function() { menuOpened = true; animatingMenu = false; }).show();
			}
		});
	}
	else {
		var head  = document.getElementsByTagName('head')[0];
		var link  = document.createElement('link');
		link.rel  = 'stylesheet';
		link.type = 'text/css';
		link.href = 'css/compatible.css';
		link.media = 'screen';
		head.appendChild(link);
		
		if (typeof compatibleStyles == 'string') {
			link  = document.createElement('link');
			link.rel  = 'stylesheet';
			link.type = 'text/css';
			link.href = compatibleStyles;
			link.media = 'screen';
			head.appendChild(link);
		}
		
		compatibleMode = true;
		document.getElementById("responsive-status").innerHTML = "Responsive Web Design Not Supported";
	}
}); 

window.onload = function() {
	//initialize quote
	document.getElementById("quote").innerHTML = quotes[quoteIndex];
	if (typeof subInitFunction == 'function')
		subInitFunction();
}

window.onresize = function(event) {
	if (lastWidth >= 480 && window.innerWidth < 480) {
		$("#quote").stop(true, true).hide();
	}
	else if (lastWidth < 480 && window.innerWidth >= 480) {
		$("#quote").show();
	} else if (lastWidth >= 600 && window.innerWidth < 600) {
		$("ul.topnav").stop(true, true).hide();
	}
	else if (lastWidth < 600 && window.innerWidth >= 600) {
		menuOpened = false;
		animatingMenu = false;
		$("ul.topnav").show();
	}
	lastWidth = window.innerWidth;
	
	if (typeof subResizeFunction == 'function')
		subResizeFunction();
}

setInterval("changeQuote()", 7000);
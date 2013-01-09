var SlideSpeed = 500;
var eventEnabled = true;
var currentPosition = 0;
var imgSources = [
	[
		"images/resume_icon_bw.png",
		"images/code_icon_bw.png",
		"images/skills_icon_bw.png",
		"images/medal_icon_bw.png",
		"images/paper_plane_icon_bw.png",
		"images/briefcase_icon_bw.png",
		"images/hand_icon_bw.png",
		"images/golf_icon_bw.png"
	],
	[
		"images/resume_icon.png",
		"images/code_icon.png",
		"images/skills_icon.png",
		"images/medal_icon.png",
		"images/paper_plane_icon.png",
		"images/briefcase_icon.png",
		"images/hand_icon.png",
		"images/golf_icon.png"
	]
];
var imgId = [
"#resume-icon",
"#code-icon",
"#skills-icon",
"#medal-icon",
"#plane-icon",
"#briefcase-icon",
"#hand-icon",
"#golf-icon"
];

function CurrentMargin() {
	// get current margin of slider
	var currentMargin = $("#slider-wrapper").css("margin-left");

	// first page load, margin will be auto, we need to change this to 0
	if (currentMargin == "auto") {
		currentMargin = 0;
	}

	// return the current margin to the function as an integer
	return parseInt(currentMargin);
}

function NavigatorMouseEnter(index) {
	if (currentPosition != index)
		$(imgId[index]).attr("src", imgSources[1][index]);
}

function NavigatorMouseLeave(index) {
	if (currentPosition != index)
		$(imgId[index]).attr("src", imgSources[0][index]);
}

function NavigatorMouseClick(index) {
	if (eventEnabled && index != currentPosition) {
		eventEnabled = false;
		//change images
		$(imgId[index]).attr("src", imgSources[1][index]);
		$(imgId[currentPosition]).attr("src", imgSources[0][currentPosition]);
		//set coordinates for animation
		var newMargin = CurrentMargin() + (currentPosition - index) * $('#slider-container').width();
		var speed = SlideSpeed * Math.abs(currentPosition - index);
		currentPosition = index;
		$("#slider-wrapper").animate({ marginLeft: newMargin }, SlideSpeed, function () {
			$("#slider-container").animate({ height: $(".slide").eq(index).height() + "px" }, 100, function() { eventEnabled = true;});
		});
	}
}

var subInitFunction = function() {
	subResizeFunction();
};

var subResizeFunction = function() {
	if (!eventEnabled) {
		eventEnabled = true;
		$("#slider-wrapper").stop(true, true);
	}
	var newWidth = $("#slider-container").width();
	$(".slide").css("width", newWidth.toString());
	$("#slider-wrapper").css("width", (newWidth * 8).toString());
	$("#slider-wrapper").css("margin-left", (-currentPosition * newWidth).toString());
};
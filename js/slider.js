var Slider = (function () {
	//CLASS WIDE VARIABLES
	var slider = document.getElementById("nav2");
	//var buttons = document.getElementsByTagName("img");
	var buttons = document.getElementsByTagName("img"); 
	var leftArrow = document.getElementById("leftArrow"); 
	var rightArrow = document.getElementById("rightArrow"); 
	var projectPictures = document.getElementsByClassName("projectImage");
	var processPictures = document.getElementsByClassName("imagePanel");
	var arrowBox = document.getElementById("arrowBox");
	var projectNavLinks = document.querySelectorAll("#nav2 a");
	var processNavLinks = document.querySelectorAll("#nav3 a");
	var thePage;
	
	if(window.indicator) {var indicator = document.getElementById("indicator").children;}
	var animateWaitTime = 150;
	var fadeCount = 0;
	var slideSize = 960;
	var maxOpacity;
	var minOpacity;
	var useMax; 
	//setup();
	var slideNumber = 1;	//slide or "page"
	var sliderIndex = 0; //slider's "left" value
	slider.style.top = 0;
	slider.style.left = 0;	
	setup();
	var lastIndicator;


	
	//PRIVATE FUNCTIONS
	function setup(page, id, size, lowOpacity, highOpacity, useTheMax, sliderOffset) { console.log("Slider.setup()");
		if(page == "projects") { 
			thePage = page;
			rightArrow.style.display = "none";
			leftArrow.style.display = "none";
			
			arrowBox.addEventListener('mouseout', function() {
				rightArrow.style.display = "none";
				leftArrow.style.display = "none";
			}, false);

			arrowBox.addEventListener('mouseover', function() {
				if(slideNumber != 1) { leftArrow.style.display = "block" }
				if(slideNumber != slider.children.length) { rightArrow.style.display = "block" }
			}, false);
		};
		 
		if(page == "process") { 
			thePage = page;
			if(slideNumber == 1) { leftArrow.style.display = "none";};
			if(slideNumber == slider.children.length) { rightArrow.style.display = "none";};
		}; 
		
		if(page == "team") { 
			thePage = page;
			if(slideNumber == 1) { leftArrow.style.display = "none";};
			if(slideNumber == slider.children.length) { rightArrow.style.display = "none";};
		};
		
		if(page == 'philosophy') {
			
		}
		if(id) {
			slider = document.getElementById(id);
		} 
		
		if(size) { console.log("slideSize = " + size);
			slideSize = size;
		} 
		
		if(lowOpacity) {console.log("minOpacity: " + lowOpacity);
			minOpacity = lowOpacity;
		} 
		
		if(highOpacity) {console.log("maxOpacity: " + highOpacity);
			maxOpacity = highOpacity;
		} 
		
		if(sliderOffset) { 
			slider.style.left = sliderOffset + "px";
			sliderIndex = sliderOffset;
	 	};
		
		if(slideNumber == 1) { 
			if(indicator) {
				indicator[indicator.length - 1].style.backgroundColor = "#FFFFFF";
				lastIndicator = indicator.length - 1;
			}
		
		}
		
		if(useTheMax) { useMax = maxOpacity } else { useMax = minOpacity}; console.log("useMax = " + useMax);	
		
				if(window.arrowBox) {
					if(slideNumber == 1) { 
						leftArrow.style.display = "none";
					} else {
						leftArrow.style.opacity = useMax;
					}
					
					if(slideNumber == slider.children.length) {
						 rightArrow.style.display = "none";
					} else {
						rightArrow.style.opacity = useMax;
					}
				}
		}
		

	
	function buttonsOff() {
		buttons[0].style.opacity = 0; 
		buttons[1].style.opacity = 0;
		leftArrow.style.opacity = 0;
		rightArrow.style.opacity = 0;
	}

	
	function buttonsOn() { 
			buttons[0].style.opacity = useMax; 
			buttons[1].style.opacity = useMax;
			leftArrow.style.opacity = useMax;
			rightArrow.style.opacity =	useMax;
	}

	 function fadeIn() {	
		window.setTimeout(function() { 
			buttons[0].style.opacity = fadeCount; 
			buttons[1].style.opacity = fadeCount; 
			leftArrow.style.opacity = fadeCount;
			rightArrow.style.opacity = fadeCount;
			if(rightArrow.style.opacity >= useMax) { 
				buttonsOn();
				return 0;
			} else { 
			fadeCount += .07;
			}
		}, animateWaitTime);
	} 
	
	function patience(numPosts) { //numPosts = theSlide - slideNumber
		return (numPosts * 350) - (numPosts * 100);
	}
	
	function nextIndicator() { 
		if(window.indicator) {
			indicator[lastIndicator].style.backgroundColor = "#292828";
			indicator[currentIndicator()].style.backgroundColor = "#FFFFFF";	
		}
	}
	
	function nextNav() { 
	if(thePage == "process") { 
		//if(thePage == "projects") { var nav = projectNavLinks };
		if(thePage== "process") { var nav = processNavLinks };
		for(i=0; i < nav.length; i++) {
			console.log("NextNav():: nav[1] = " + nav[1] + "&& slideNumber = " + slideNumber);
			nav[i].style.color = "grey"; 
			nav[(slideNumber - 1)].style.color = "cyan";
		};
	} else { return 0; };		
}; 
	
		function moveSlide(direction, jumpTo) {
		if(!jumpTo) {jumpTo = 0}
		if(direction == "forward" && window.indicator) {
			lastIndicator = indicator.length - slideNumber++;
		} else if(direction == "backward" && window.indicator) {
			lastIndicator = indicator.length - slideNumber--;
		} else if(direction == "jump" && window.indicator) {
			lastIndicator = indicator.length - slideNumber;
			slideNumber = jumpTo;
		} else {
			if(direction == "forward") {slideNumber++};
			if(direction == "backward") {slideNumber--};
			if(direction == "jump") {slideNumber = jumpTo}
		}
	};
	
	function currentIndicator() {
		console.log("currentIndicator= " + indicator.length + " - " + slideNumber);
		return indicator.length - slideNumber;
	}
	
	
	
function fadeIn() {				
	console.log("FADEIN(): rightArrow.opacity = " + rightArrow.style.opacity);
	buttons[0].style.opacity = fadeCount; 
	buttons[1].style.opacity = fadeCount; 
	leftArrow.style.opacity = fadeCount;
	rightArrow.style.opacity = fadeCount;
	fadeCount += .07;
}
	 

	
	//PUBLIC METHODS
	return {
			next: function() { 
				if(slideNumber == (slider.children.length)) { 
					return 0;
				} else { 
					sliderIndex -= slideSize;
					buttonsOff();
					slider.style.left = sliderIndex + "px";
					//slideNumber++;
					moveSlide("forward");
					nextIndicator();
					nextNav();
					if(leftArrow.style.display == "none") { leftArrow.style.display = "block" }
					if(slideNumber == slider.children.length) { rightArrow.style.display = "none" }
					window.setTimeout(function() {
						var buttonFade1 = setInterval(function() {
							if(rightArrow.style.opacity >= useMax) { 
								clearInterval(buttonFade1);
							} else {
								fadeIn();
							}
						}, animateWaitTime);
					}, 250)
				}
				fadeCount = 0;
				
			},
			
			prev: function() { 
				if(slideNumber == 1) {
					return 0;
				} else {
					sliderIndex += slideSize;
					buttonsOff();
					slider.style.left = sliderIndex + "px";
					moveSlide("backward");
					nextIndicator();
					nextNav();
					if(slideNumber == 1) {leftArrow.style.display = "none";}
					if(rightArrow.style.display == "none") { rightArrow.style.display = "block" }
					
					window.setTimeout(function() {
						var buttonFade2 = setInterval(function() {
							if(rightArrow.style.opacity >= useMax ) {
								clearInterval(buttonFade2);
							} else {
								fadeIn();
							}
						}, animateWaitTime);
					}, 250)
				}
				fadeCount = 0;
				
			},
			
			setSlider: function(page, id, size, lowOpacity, highOpacity, useMax, offSet) {
				setup(page, id, size, lowOpacity, highOpacity, useMax, offSet);
			},
			
			gotoSlide: function(theSlide) {
				if(theSlide == slider.children.length) { rightArrow.style.display = "none" }
				if(theSlide > 1) {leftArrow.style.display = "block"}
				if(theSlide == slideNumber) {return 0; }
				if(theSlide > slideNumber) { console.log("gotoSlide()");
					var distance = (theSlide - slideNumber) * slideSize;  console.log("GOTO: moving distance: " + distance);
					sliderIndex -= distance;
					buttonsOff();
					slider.style.left = sliderIndex + "px"; console.log("GOTO: slider.left: " + slider.style.left);
					//slideNumber = theSlide; 
					moveSlide("jump", theSlide);
					nextIndicator();
					nextNav();
					window.setTimeout(function() {
						var buttonFade1 = setInterval(function() {
							if(rightArrow.style.opacity >= useMax) {
								clearInterval(buttonFade1);
							} else {
							fadeIn();
							}
						}, animateWaitTime);
					}, 350);				
					fadeCount = 0; 
					
				} else if(theSlide < slideNumber) { 
					var distance = (slideNumber - theSlide) * slideSize; 
					sliderIndex += distance; 
					buttonsOff();
					slider.style.left = sliderIndex + "px";
					moveSlide("jump", theSlide);
					nextIndicator();
					nextNav();
					
					//Animate left and right buttons fading in and out
					window.setTimeout(function() {
						var buttonFade1 = setInterval(function() {
							if(rightArrow.style.opacity >= useMax) {
								clearInterval(buttonFade1);
							} else {
								fadeIn();
							}
						}, animateWaitTime);
					}, 350);				
					fadeCount = 0;
				}
			},
		};
})();


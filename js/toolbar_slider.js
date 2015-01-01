var toolbarSlider = (function() {
	var tSlider = document.getElementById('toolbarDrop');
	var tSliderRect = tSlider.getBoundingClientRect();
	var tSliderStart = tSliderRect;
	var nav = document.getElementById('nav2');
	var rightArrow = document.getElementById("toolbarRightArrow");
	var leftArrow = document.getElementById("toolbarLeftArrow");
	var index = 225; //toolbarDrop.style.left == 225px 
	var slideDistance = 300;
	
	function nextDates() {
		index -= slideDistance;
		tSlider.style.left = index + "px";
		toolbarSlider.buttons(); 
	};
	
	function prevDates() {
		index += slideDistance;
		tSlider.style.left = index + "px";
		toolbarSlider.buttons();
	}
	
	return {
		next: function() {
			nextDates();
		},
		
		prev: function() {
			prevDates();
		},
		
		buttons: function() {
			if((index - slideDistance) <= -(nav.clientWidth) || (index - slideDistance) <= -(870 - nav.clientWidth)) { //next move is too far to the left
				rightArrow.style.opacity = 0;
				window.setTimeout(function() {rightArrow.style.display = "none"}, 500);
			}
			
			if(index < 0) { //slider is currently off to the left
				leftArrow.style.display = "block";
				leftArrow.style.opacity = 1;
			}
			
			if((index + slideDistance) > 225 ) { //next move is too far to the right
				leftArrow.style.opacity = 0;
				window.setTimeout(function() {leftArrow.style.display = "none"}, 500);
			}
			
			/*
			*slider is visible, from the right
			*870 == secondaryNav.style.width
			*/
			if(index >= (870 - nav.clientWidth) || leftArrow.style.opacity == 0) { 
				rightArrow.style.display = "block";
				rightArrow.style.opacity = 1;
			}
		},
		
		buttonsOff: function() {
			rightArrow.style.opacity = 0;
			leftArrow.style.opacity = 0;
			window.setTimeout(function() {
				leftArrow.style.display = "none"; 	
				rightArrow.style.display = "none";
			}, 500);
		},

		buttonsOn: function() {
			//rightArrow.style.display = "block";
			//leftArrow.style.display = "block";
			rightArrow.style.opacity = 1;
			leftArrow.style.opacity = 1; 
			
		},
		
		getIndex: function() {
			return index;
		},
	};
		
	
})();

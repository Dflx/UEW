var projectBar = document.getElementById("toolbarDrop");
var processBar = document.getElementById("processDrop");


var projectButton;
var processButton;

function transitionsOff() {
	projectBar.style.transition = "none";
	processBar.style.transition = "none";
}

function transitionsOn() {
	projectBar.style.transition = "top 1s, left 2s";
	processBar.style.transition = "top 1s, left 2s";
}

function buttonsOff() {
	//rightArrow.style.opacity = 0;
	//leftArrow.style.opacity = 0;
}

function buttonsOn() {
	//rightArrow.style.display = "block";
	//leftArrow.style.display = "block";
	//rightArrow.style.opacity = 1;
	//leftArrow.style.opacity = 1; 
	
}
	
	
function dropProjects(theId, thePage) {
	projectButton = document.getElementById(theId);
	if(thePage == 'projects') {
		projectButton.style.color = "cyan";
		buttonsOn();
		if(projectBar.style.top != "10px") {
			projectBar.style.top = "10px";
			processBar.style.top = "-20px";
			transitionsOn();

			
		} else {
			transitionsOn();
			projectBar.style.top = "-20px";
			buttonsOff();
		}
		
	} else {
	
		if(thePage != 'projects') {
			projectButton.style.color = "#FFFFFF";
			buttonsOn();
		}
		
		if(projectBar.style.top != "10px") { //process bar is NOT down
			transitionsOn();
			projectBar.style.top = "10px";
		} else {
			projectBar.style.top = "-20px";
			projectButton.style.color = "grey";
			buttonsOff();
			//processBar.style.top = "10px";
		}
		
		if(processBar.style.top == "10px") { //process bar is down
			//transitionsOff();
			processBar.style.top = "-20px";
			if(thePage != "process") {
				processButton.style.color = "grey";
			}
			projectBar.style.top = "10px";
			buttonsOn();
			transitionsOn();
		}
	}
}


function dropProcess(theId, thePage) {
	processButton = document.getElementById(theId);
	if(thePage == 'process') {
		processButton.style.color =  "cyan";
		if(processBar.style.top != "10px") {
			processBar.style.top = "10px";
			projectBar.style.top = "-20px";
			buttonsOff();
			
		} else {
			transitionsOn();
			processBar.style.top = "-20px";
		}
		
	} else {
	
		if(thePage != 'process') {
			processButton.style.color = "#FFFFFF";
			if(processBar.style.top != "10px") { //process bar is NOT down
				processBar.style.top = "10px"; 
			} else {
				transitionsOn();
				processBar.style.top = "-20px";
				processButton.style.color = "grey";
				//projectBar.style.top = "10px";
			}
			
			if(projectBar.style.top == "10px") { //project bar is down
				//transitionsOff();
				projectBar.style.top = "-20px"; 
				if(thePage != "projects") { 
					projectButton.style.color = "grey";
					buttonsOff();
				}
				processBar.style.top = "10px";
				transitionsOn();
			}
		}
	}
}



	
var projectBar=document.getElementById("toolbarDrop");var processBar=document.getElementById("processDrop");var projectButton;var processButton;function transitionsOff(){projectBar.style.transition="none";processBar.style.transition="none"}function transitionsOn(){projectBar.style.transition="top 1s";processBar.style.transition="top 1s"}function dropProjects(theId){var theButton=document.getElementById(theId);projectButton=theButton;if(projectBar.style.top!="10px"){if(processButton){processButton.style.color="grey";transitionsOff();processBar.style.top="-20px"}projectBar.style.top="10px";theButton.style.color="cyan";processButton=0}else{transitionsOn();projectBar.style.top="-20px";theButton.style.color="grey";theButton.addEventListener('mouseover',function(){theButton.style.color="#FFFFFF"},false);theButton.addEventListener('mouseout',function(){theButton.style.color="grey"},false);projectButton=0}}function dropProcess(theId){var theButton=document.getElementById(theId);processButton=theButton;if(processBar.style.top!="10px"){if(projectButton){projectButton.style.color="grey";transitionsOff();projectBar.style.top="-20px"}processBar.style.top="10px";theButton.style.color="cyan";projectButton=0}else{transitionsOn();processBar.style.top="-20px";theButton.style.color="grey";theButton.addEventListener('mouseover',function(){theButton.style.color="#FFFFFF"},false);theButton.addEventListener('mouseout',function(){theButton.style.color="grey"},false);processButton=0}}
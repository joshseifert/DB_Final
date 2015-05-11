//These functions provide instantaneous warnings if the user enters out of range data. These are just warnings, if the user chooses
//to submit invalid data, it gets caught in the "submitlift()" function. These mostly exist to display funny messages to the user.
function checkweight(){
  var weight = document.getElementById("weight").value;
  if(weight == "")
    document.getElementById("weightstatus").innerHTML = "<span class='badData'>You gotta enter a weight, bro.</span>";
  else if(weight < 1)
    document.getElementById("weightstatus").innerHTML = "<span class='badData'>Ain't gonna get swole without that weight. Give me at least 1 pound.</span>";
  else if(weight > 1000)
    document.getElementById("weightstatus").innerHTML = "<span class='badData'>You'd put Arnold himself to shame...if that number wasn't a lie. Under 1000 pounds, bro.</span>";
  else
    document.getElementById("weightstatus").innerHTML = "";
}
function checkreps(){
  var reps = document.getElementById("reps").value;
  if(reps < 1 && reps != "")
    document.getElementById("repsstatus").innerHTML = "<span class='badData'>No reps = no gains, boss. Give me at least 1 good pump.</span>";
  else if(reps > 100 && reps != "")
    document.getElementById("repsstatus").innerHTML = "<span class='badData'>Dude, you gotta up your weight if you're busting out over 100 reps. Try again.</span>";
  else
    document.getElementById("repsstatus").innerHTML = "";
}  
function checksets(){
  var sets = document.getElementById("sets").value;
  if(sets < 1 && sets != "")
    document.getElementById("setsstatus").innerHTML = "<span class='badData'>I know you got at least 1 set in you.</span>";
  else if(sets > 100 && sets != "")
    document.getElementById("setsstatus").innerHTML = "<span class='badData'>You ain't fooling anyone, tough guy. Over 100 sets? Try again.</span>";
  else
    document.getElementById("setsstatus").innerHTML = "";
}  
function checknotes(){
  var notes = document.getElementById("notes").value;
  if(notes == "")
    document.getElementById("notesstatus").innerHTML = "<span class='badData'>Like most things in life, lifting is 95% mental, 25% physical. It works best if you take notes.</span>";
  else
    document.getElementById("notesstatus").innerHTML = "";
}  

//Validates user input, sends AJAX request to enter information into database.  
  function submitlift(){	
//This first line of code (querySelector) via http://stackoverflow.com/questions/15839169/how-to-get-value-of-selected-radio-button
  var lift = document.querySelector('input[name="lift"]:checked').value;		
  var weight = document.getElementById("weight").value;
  var reps = document.getElementById("reps").value;
  var sets = document.getElementById("sets").value;
  var notes = document.getElementById("notes").value;
//Lift and Weight are required. Other fields are optional
  if(lift == "NULL" || weight == "")
    document.getElementById("status").innerHTML = "<span class='badData'>You're missing a required field. Select a lift, choose a weight.</span>";
//Weight must be betweeen 1 and 1000, inclusive
  else if(weight < 1 || weight > 1000)
    document.getElementById("status").innerHTML = "<span class='badData'>This ain't rocket surgery. Keep your weight in range.<span>";
//If reps are entered, they must be between 1 and 100, inclusive
  else if(reps != "" && (reps < 1 || reps > 100))
    document.getElementById("status").innerHTML = "<span class='badData'>This ain't rocket surgery. Keep your reps in range.</span>";
//If sets are entered, they must be between 1 and 100, inclusive
  else if(sets != "" && (sets < 1 || sets > 100))
    document.getElementById("status").innerHTML = "<span class='badData'>This ain't rocket surgery. Keep your sets in range.</span>";
//If passes all the checks, data is valid, sent to PHP
  else{ 
 	var ajax = new XMLHttpRequest();
	ajax.open("POST", "main.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
          if(ajax.responseText != "success")
            document.getElementById("status").innerHTML = ajax.responseText;
          else{
            document.getElementById("status").innerHTML = "<span class='goodData'>Your feats of strength are recorded for the ages!<span>";
// Message is displayed for 3 seconds, code on the following line from
// http://stackoverflow.com/questions/22655144/how-to-display-a-message-for-a-few-seconds-and-then-disappear-in-javascript
			setTimeout(function(){document.getElementById("status").innerHTML="";},3000);
		  }
        }
      }
      ajax.send("lift="+lift+"&weight="+weight+"&reps="+reps+"&sets="+sets+"&notes="+notes);
  }
}

//These functions adapted from tutorials by Adam Khoury @ developphp.com
function upload(){
	var file = document.getElementById("upFile").files[0];
	var formData = new FormData();
	formData.append("upFile", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progress, false);
	ajax.addEventListener("load", complete, false);
	ajax.addEventListener("error", error, false);
	ajax.addEventListener("abort", abort, false);
	ajax.open("POST", "../final/upload.php");
	ajax.send(formData);
}
function progress(evt){
	var percent = (evt.loaded / evt.total) * 100;
	document.getElementById("bar").value = Math.round(percent);
	document.getElementById("upStatus").innerHTML = Math.round(percent)+"%";
}
function complete(evt){
	document.getElementById("upStatus").innerHTML = evt.target.responseText;
	document.getElementById("bar").value = 0;
}
function error(evt){
	document.getElementById("upStatus").innerHTML = "Upload Failed";
}
function abort(evt){
	document.getElementById("upStatus").innerHTML = "Upload Aborted";
}
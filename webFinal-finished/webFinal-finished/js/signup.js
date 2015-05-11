//See if username is taken
function checkusername(){
  var username = document.getElementById("username").value;
  if(username != ""){
    document.getElementById("usernamestatus").innerHTML = 'Checking user name availability...';
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "signup.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
      if(ajax.readyState == 4 && ajax.status == 200)
        document.getElementById("usernamestatus").innerHTML = ajax.responseText;
    }
    ajax.send("usernamecheck="+username);
  }
}
//Checks that the user's two 'password' fields are equal
function checkpassword(){
  var p1 = document.getElementById("pass1").value;
  var p2 = document.getElementById("pass2").value;
  if(p1 != p2)
    document.getElementById("pwstatus").innerHTML = "<span class='badData'>Make sure your passwords are the same.</span>";
  else
    document.getElementById("pwstatus").innerHTML = "";
}
//Validates user data, registers account
function signup(){
  var username = document.getElementById("username").value;
  var password1 = document.getElementById("pass1").value;
  var password2 = document.getElementById("pass2").value;
  var status = document.getElementById("status");
//If user does not enter all fields
  if(username == "" || password1 == "" || password2 == ""){
    status.innerHTML = "<span class='badData'>There's only 3 fields. It's not too much to ask that you fill them all.<span>";
  }
  else if(password1 != password2){
    status.innerHTML = "<span class='badData'>Your passwords don't match.</span>";
  } 
  else {
    status.innerHTML = 'Registering, please wait.';
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "signup.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
      if(ajax.readyState == 4 && ajax.status == 200) {
        if(ajax.responseText != "success")
          status.innerHTML = ajax.responseText;
		else
          document.getElementById("signupform").innerHTML = "Account Successfully Created! <br /> <a href='login.php'>Click here</a> to start logging your pump.";
      }
    }
    ajax.send("username="+username+"&password="+password1);
  }
}
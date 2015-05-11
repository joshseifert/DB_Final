function login(){
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  if(username == "" || password == "")
    document.getElementById("status").innerHTML = '<span class="badData">Gotta enter a username AND password. Don\'t want posers ruinings your stats.</span>';
  else {
    document.getElementById("status").innerHTML = 'Logging in. Please wait...';
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "login.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.onreadystatechange = function() {
      if(ajax.readyState == 4 && ajax.status == 200) {
        if(ajax.responseText == "error")
          document.getElementById("status").innerHTML = "<span class='badData'>Error, bro. Try again.</span>";
		else
          window.location = "main.php";
      }
    }
    ajax.send("username="+username+"&password="+password);
  }
}
function username_check() {
  var username = document.getElementById("UserUsername").value;
  if( username ){
    document.getElementById("hint").innerHTML = '正在检查。。。';
    document.getElementById("submit-button").disabled = true;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("hint").innerHTML = xmlhttp.responseText;
        document.getElementById("submit-button").disabled = false;
      }
    }
    xmlhttp.open("GET", "../check/" + username, true);
    xmlhttp.send();
  }
}
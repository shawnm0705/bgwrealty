function username_check(user_id) {
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
    if( user_id ){
      xmlhttp.open("GET", "../check/" + username + '?user_id=' + user_id, true);
    }else{
      xmlhttp.open("GET", "../check/" + username, true);
    }
    xmlhttp.send();
  }
}
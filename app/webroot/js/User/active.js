function active(id,status){
    document.getElementById("btn-active").disabled = true;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("active").innerHTML = xmlhttp.responseText;
        document.getElementById("btn-active").disabled = false;
      }
    }
 	xmlhttp.open("GET", "../../users/active/" + id + '?status=' + status, true);
    xmlhttp.send();
}
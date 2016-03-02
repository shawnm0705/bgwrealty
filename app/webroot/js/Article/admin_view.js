function change_s(id,status_b){
    document.getElementById("btn-status").disabled = true;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("status").innerHTML = xmlhttp.responseText;
        document.getElementById("btn-status").disabled = false;
      }
    }
    if(status_b){
    	var status = 'APPROVAL';
    }else{
    	var status = 'DRAFT';
    }
 	xmlhttp.open("GET", "../change_s/" + id + '?status=' + status, true);
    xmlhttp.send();
}
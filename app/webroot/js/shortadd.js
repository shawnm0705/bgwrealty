function shortadd() {
  var name = document.getElementById("TagName").value;
  var cate_id = document.getElementById("TagPoemtagcateId").value;
  if (name && cate_id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/xietiao/poemtags/shortadd", true);
    //-----------------xmlhttp.open("POST", "/poemtags/shortadd", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("data[Poemtag][name]=" + name + "&data[Poemtag][poemtagcate_id]=" + cate_id);
    document.getElementById("TagName").value = '';
  }
}

function poemtags() {
  document.getElementById("poemtags").innerHTML = '<h2>加载中。。。请稍候。。。</h2>';
  setTimeout(function(){}, 1000);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("poemtags").innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "/xietiao/poems/poemtags", true);
  //-----------------xmlhttp.open("GET", "/poems/poemtags", true);
  xmlhttp.send();
};

function poemtags_edit( id ) {
  document.getElementById("poemtags").innerHTML = '<h2>加载中。。。请稍候。。。</h2>';
  setTimeout(function(){}, 1000);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("poemtags").innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "/xietiao/poems/poemtagsedit/" + id, true);
  //-----------------xmlhttp.open("GET", "/poems/poemtagsedit/" + id, true);
  xmlhttp.send();
};
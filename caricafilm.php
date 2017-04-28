<?php
/**
 * LOAD THE PAGE WITHIN THE LIST OF THE FILMS WITH CURL
 * AFTER THAT, IT LOADS THE INFORMATION OF THE FILM THROUGH THE PHP PAGE "GETINFOFILM.PHP",
 * AND IT DOES AN AJAX REQUEST DUE TO STORE ALL THE INFORMATION OF THE FILM (LINK, TITLE, ETC..) TO THE DATABASE (THROUGH "SETDATI.PHP")
 *
 * (THIS PAGE WAS RAN ONLY THE FIRST TIME IN ORDER TO FILL THE DATABASE)
 */

// inizializzo cURL
$ch = curl_init();
// imposto la URL della risorsa remota da scaricare
curl_setopt($ch, CURLOPT_URL, "http://www.altadefinizione01.blue/lista-film-streaming-in-hd/");
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);

// imposto che non vengano scaricati gli header


// eseguo la chiamata
$output = curl_exec($ch);
echo $output;
// chiudo cURL
curl_close($ch);

?>


<body id=body>
</body>


<script>
var body = document.getElementById("body");
var ul = body.getElementsByTagName("ul")[2];
var li = ul.getElementsByTagName("li");



var xhr = [];
for(var j=0;j<li.length;j++){
  (function(j){
    xhr[j] = new XMLHttpRequest();
    var link = li[j].getElementsByTagName("a")[0];
    url = "getInfoFilm.php?link="+link;
    xhr[j].open("GET",url,true);
    xhr[j].onreadystatechange = function(){
      if (xhr[j].readyState == 4 && xhr[j].status == 200) {
        var risposta = xhr[j].responseText;
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = risposta.replace(/<script(.|\s)*?\/script>/g, '');
        var titolo = tempDiv.getElementsByClassName("single_head")[0].getElementsByTagName("h1")[0].innerHTML;
        var frame = tempDiv.getElementsByTagName("iframe")[0];
        var link = frame.getAttribute("src");
        var locandina = tempDiv.getElementsByClassName("attachment-135x195 size-135x195 wp-post-image")[0].getAttribute("src");
        var generearray = tempDiv.getElementsByClassName("meta_dd limpiar")[0].getElementsByTagName("a");
        var genere = "";
        for (var h = 0; h < generearray.length; h++) {
          genere = genere + generearray[h].textContent + ",";
        }
        var trama = tempDiv.getElementsByClassName("entry-content")[0].getElementsByTagName("p")[0].textContent;
        var voto = tempDiv.getElementsByClassName("dato")[0].getElementsByTagName("b")[0].innerText;
        var durata = tempDiv.getElementsByClassName("data")[0].getElementsByClassName("meta_dd")[1].innerText;
        var anno = tempDiv.getElementsByClassName("data")[0].getElementsByClassName("meta_dd")[2].innerText;
        var arrayattori = tempDiv.getElementsByClassName("meta_dd limpiar")[1].getElementsByTagName("a");
        var attori = "";
        for (var i = 0; i < arrayattori.length; i++) {
          attori = attori + arrayattori[i].textContent + ",";
        }
        var xhr2 = [];
        xhr2[j] = new XMLHttpRequest();
        url2 = "setDati.php?titolo="+titolo+"&link="+link+"&genere="+genere+"&trama="+trama+"&locandina="+locandina+"&voto="+voto+"&anno="+anno+"&durata="+durata;
        xhr2[j].open("GET",url2,true);
        xhr2[j].send();
        var divLink = document.createElement('div');
        divLink.innerHTML = titolo + " ---> CARICATO";
        body.appendChild(divLink);
      }
    }
    xhr[j].send();
  })(j);
}



</script>

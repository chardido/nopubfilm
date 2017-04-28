<?php
/**
 * DO THE SAME OPERATION OF 'CARICAFILM.PHP', BUT ONLY FOR THE LAST FILMS (WHICH ARE ON THE HOMEPAGE)
 * (NOTE THAT IT DO AN AJAX REQUEST TO A DIFFERENT PAGE COMPARED TO 'CARICAFILM.PHP')
 */

// inizializzo cURL
$ch = curl_init();
// imposto la URL della risorsa remota da scaricare
curl_setopt($ch, CURLOPT_URL, "http://www.altadefinizione01.blue/");
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);

// imposto che non vengano scaricati gli header


// eseguo la chiamata
$output = curl_exec($ch);
echo $output;
// chiudo cURL
curl_close($ch);


$conn = mysql_connect('localhost', 'nopubfilm', '') or die("CONNESSIONE DATABASE FALLITA");
mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET CHARACTER SET utf8');
$query = "SELECT DISTINCT link FROM Altadefinizione WHERE genere = 'Ultimi Inseriti' ORDER BY nome";
$result = mysql_query($query) or die("SELECT FALLITA");

$numero_film_recenti = mysql_num_rows($result);

if($numero_film_recenti >= 100){
  $query2 = "DELETE FROM `Altadefinizione` WHERE genere = 'Ultimi Inseriti'";
  mysql_query($query2) or die("CANCELLAZIONE FALLITA");
}

?>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body id=body>
</body>


<script>
var body = document.getElementById("body");
var ul = body.getElementsByClassName("cover_kapsul");


var xhr = [];
for(var j=0;j<ul.length;j++){
  (function(j){
    xhr[j] = new XMLHttpRequest();
    var link = ul[j].getElementsByTagName("a")[0];
    url = "getInfoFilm.php?link="+link;
    xhr[j].open("GET",url,true);
    xhr[j].onreadystatechange = function(){
      if (xhr[j].readyState == 4 && xhr[j].status == 200) {
        var risposta = xhr[j].responseText;
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = risposta
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
        url2 = "setDatiRecenti.php?titolo="+titolo+"&link="+link+"&genere="+genere+"&trama="+trama+"&locandina="+locandina+"&voto="+voto+"&anno="+anno+"&durata="+durata+"&attori="+attori;
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

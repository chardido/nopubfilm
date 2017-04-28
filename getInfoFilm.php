<?php
/**
 * THIS PAGE RETURNS THE INFO OF THE SELECTED FILM
 */
// inizializzo cURL
$ch = curl_init();
$link = $_GET['link'];

// imposto la URL della risorsa remota da scaricare
curl_setopt($ch, CURLOPT_URL, $link);
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

<body id='body'>
</body>

<script>
var titolo = document.getElementsByClassName("single_head")[0].getElementsByTagName("h1")[0].innerHTML;
var frame = document.getElementsByTagName("iframe")[0];
var link = frame.getAttribute("src");
var locandina = document.getElementsByClassName("attachment-135x195 size-135x195 wp-post-image")[0].getAttribute("src");
var genere = document.getElementsByClassName("meta_dd limpiar")[0].getElementsByTagName("a")[0].textContent;
var trama = document.getElementsByClassName("entry-content")[0].getElementsByTagName("p")[0].textContent;
var voto = document.getElementsByClassName("a")[2].textContent;
var attori = document.getElementsByClassName("meta_dd limpiar")[1].getElementsByTagName("a");


</script>

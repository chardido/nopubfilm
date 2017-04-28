<?php
/**
 * THIS IS THE PAGE OPENED BY "CARICAFILM.PHP" THAT STORES THE INFORMATION OF A SINGLE FILM INTO THE DATABASE
 */
$titolo = $_GET['titolo'];
$link = $_GET['link'];
$stringageneri = $_GET['genere'];
$trama = $_GET['trama'];
$locandina = $_GET['locandina'];
$voto = $_GET['voto'];
$stringaattori = $_GET['attori'];
$anno = $_GET['anno'];
$durata = $_GET['durata'];
$data = getdate();
$date = $data['mday']."/".$data['mon']."/".$data['year'];



$attori = explode(",",$stringaattori);
$generi = explode(",",$stringageneri);

$conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET CHARACTER SET utf8');
foreach ($generi as $genere) {

  $pos = strpos($genere," - Altadefinizione01");
  if($pos != 0){
    $genere = substr($genere,0,$pos);
  }


  if($genere == "Film (Tutti i film)" || $genere == "cinema" || $genere == "Prossimamente" || $genere == "Ultimi Film Aggiunti su Altadefinizione01")
    continue;
  foreach ($attori as $attore) {
    $query = "INSERT INTO Altadefinizione VALUES ('$titolo','$link','$genere','$trama','$locandina','Si','MEGAHD',0,0,'$attore',0,'$voto','$anno','$durata','$date')";
    $result = mysql_query($query) or die("QUERY FALLITA: ".mysql_error());

  }
}

echo $titolo." INSERITO";
?>

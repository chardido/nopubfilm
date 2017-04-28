<?php
/**
 * THIS IS THE PAGE OPENED BY "CARICAFILMRECENTI.PHP" THAT STORES THE INFORMATION OF A SINGLE FILM (RECENT FILM) INTO THE DATABASE
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
print_r($attori);

$conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET CHARACTER SET utf8');
$queryRimuoveAttore = "DELETE FROM Altadefinizione WHERE attore = ''";
foreach ($generi as $genere) {

  $pos = strpos($genere," - Altadefinizione01");
  if($pos != 0){
    $genere = substr($genere,0,$pos);
  }


  if($genere == "Film (Tutti i film)" || $genere == "cinema" || $genere == "Prossimamente su Altadefinizione01" || $genere == "Ultimi Film Aggiunti su Altadefinizione01" || $genere == "Ultimi Film Aggiunti")
    continue;
  foreach ($attori as $attore) {
    echo $attore. " ";
    $query = "INSERT INTO Altadefinizione VALUES ('$titolo','$link','$genere','$trama','$locandina','Si','MEGAHD',0,0,'$attore',0,'$voto','$anno','$durata','$date')";
    $query2 = "INSERT INTO Altadefinizione VALUES ('$titolo','$link','Ultimi Inseriti','$trama','$locandina','Si','MEGAHD',0,0,'$attore',0,'$voto','$anno','$durata','$date')";
    $result = mysql_query($query2) or die("QUERY ULTIMI INSERITI: ".mysql_error());
    $result = mysql_query($query) or die("QUERY NORMALE: ".mysql_error());

  }
}

mysql_query($queryRimuoveAttore) or die("RIMOZIONE ATTORE NULLO FALLITA".mysql_error());


echo $titolo." INSERITO ";
?>

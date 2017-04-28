<?php
/**
 * THIS PAGE OPENS THE LINK OF THE FILM (THE END-LINK) WITH CURL.
 * AFTER THAT, IT REMOVES THE ADS THROUGTH A SCRIPT
 */

// inizializzo cURL
$ch = curl_init();

if(isset($_GET['link'])){
  $link = $_GET['link'];
  $titolo = $_GET['titolo'];
}

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

$categoria = $_GET['categoria'];
$conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
$query = "SELECT Trama,locandina FROM Altadefinizione WHERE link = '$link' LIMIT 1";
$result = mysql_query($query) or die("QUERY FALLITA");
$row = mysql_fetch_assoc($result);

/* INCREMENTO VISIONE */
$conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
$query2 = "SELECT visioni FROM Altadefinizione WHERE link = '$link'";
$result2 = mysql_query($query2) or die("QUERY FALLITA");
$row2 = mysql_fetch_assoc($result2);
$visioni = $row2['visioni']+1;

$query3 = "UPDATE Altadefinizione SET visioni = '$visioni' WHERE link = '$link'";
mysql_query($query3) or die("QUERY FALLITA");




function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

?>

<head>
  <title> <?php echo $titolo; ?> </title>
    <link type="text/css" rel="stylesheet" href="assets/css/allcss.css">
</head>




<script src="toastr.js"></script>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script>

//for iframes:
$.each($('iframe'), function() {
    this.contentWindow.open = function (url, windowName, windowFeatures) {
        //iframe window.open caught!
    };
});

//for window:
window.open = function (url, windowName, windowFeatures) {
    //window.open caught!
};


var bodyChildren = document.body.children;
var divFilm = bodyChildren[0];
var divChildren = divFilm.children;
divFilm.removeChild(divChildren[0]);
divFilm.removeChild(divChildren[0]);




</script>



<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="statistiche free" ><script  type="text/javascript" >
try {Histats.start(1,3335940,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3335940&101" alt="statistiche free" border="0"></a></noscript>
<!-- Histats.com  END  -->

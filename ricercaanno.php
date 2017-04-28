<?php
/**
 * THIS IS A SIMPLE SEARCH PAGE THAT SEARCH FOR ALL THE FILMS OF THE YEAR GIVEN
 */


if(isset($_GET['ordine'])){
  $anno1 = $_GET['anno'];
  $ordine = $_GET['ordine'];
  $conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
  mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
//$conn = mysql_connect('localhost','root','') or die("CONNESSIONE DATABASE FALLITA");
//mysql_select_db('nopubfilm') or die("SELEZIONE DATABASE FALLITA");
  mysql_query("SET NAMES 'utf8'");
  mysql_query('SET CHARACTER SET utf8');
  if(strcmp($ordine,"anno") == 0) {
    $query = "SELECT DISTINCT nome, link,Trama,locandina,genere,funzionante,sito,voto,votanti,imdb,anno FROM Altadefinizione WHERE anno = '$anno1' ORDER BY anno DESC";
  }
  if(strcmp($ordine,"nome") == 0) {
    $query = "SELECT DISTINCT nome, link,Trama,locandina,genere,funzionante,sito,voto,votanti,imdb,anno FROM Altadefinizione WHERE anno = '$anno1' ORDER BY nome";
  }
  if(strcmp($ordine,"voto") == 0){
    $query = "SELECT DISTINCT nome, link,Trama,locandina,genere,funzionante,sito,voto,votanti,imdb,anno FROM Altadefinizione WHERE anno = '$anno1' ORDER BY imdb DESC" ;
  }
  $result = mysql_query($query) or die("QUERY FALLITA");
  $i = 0;
}else {
  $anno1 = $_GET['anno'];
  $conn = mysql_connect('localhost', 'nopubfilm', '') or die("CONNESSIONE DATABASE FALLITA");
  mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
  mysql_query("SET NAMES 'utf8'");
  mysql_query('SET CHARACTER SET utf8');
  $query = "SELECT DISTINCT nome,link,trama,locandina,funzionante,sito,voto,votanti,imdb,anno FROM Altadefinizione WHERE anno = '$anno1' ORDER BY nome;";
  $result = mysql_query($query) or die("QUERY FALLITA");
  $i = 0;
}
?>

<head>
  <title> Risultato della ricerca </title>
  <link rel='stylesheet' href='/stileIndexNuovo.css'>

  <link rel='stylesheet' href='/stileCategoria.css'>
  <script type="text/javascript" src="/ .js"></script>




  <meta charset="utf-8">
  <!--Meta Tag-->
  <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <!--Meta Tag-->

  <script type="text/javascript" src="webslide/js/jquery.min.js"></script>

  <!--Bootstrap-->
  <link rel="stylesheet" href="webslide/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="webslide/bootstrap/js/bootstrap.min.js"></script>
  <!--Bootstrap-->

  <!--Main Menu File-->
  <link rel="stylesheet" type="text/css" media="all" href="webslide/css/demo.css">
  <link rel="stylesheet" type="text/css" media="all" href="webslide/css/color-theme.css">
  <link rel="stylesheet" type="text/css" media="all" href="webslide/css/webslidemenu.css">
  <script type="text/javascript" language="javascript" src="webslide/js/webslidemenu.js"></script>
  <!--Main Menu File-->

  <!-- font awesome -->
  <link rel="stylesheet" href="webslide/font-awesome/css/font-awesome.min.css">
  <!-- font awesome -->
  <style type="text/css">
    .back-to-top {
      cursor: pointer;
      position: fixed;
      bottom: 0;
      right: 20px;
      display:none;
    }

    @media only screen and (max-width: 768px) {
      /* For mobile phones: */
      .divCategoria{
        width: 100px;
        height: 150px;
        margin-left: -5px;

      }
      .divCategoria img {
        width: 100px;
        height: 146px;
      }
      .titolo{
        width: 96px;
        height: auto;
        font-size: 0.8em;
      }
      .anno{
        margin-top: -146px;
        width: 50px;
        height: auto;
        font-size: 1em;
      }
      .voto{
        margin-top: -35px;
        margin-left:0px;
        width: 96px;
        height: auto;
        font-size: 0.8em;
      }
    }
  </style>


</head>

<body style="background-color: black; color: white; font-size: medium;">

<div style="text-align: center;"> <a href='index.php'><img src='img/logo.png'></a> </div>
<div style="text-align: center;">
  <a href='https://www.facebook.com/nopubfilm/'><img src='img/seguicifb.png'></a>
</div>

<br>

<div class="wsmenucontainer clearfix">
  <div class="wsmenuexpandermain slideRight"><a id="navToggle" class="animated-arrow slideLeft" href="#"><span></span></a></div>
  <div class="wsmenucontent overlapblackbg"></div>
  <div class="header">

    <!--Menu HTML Code-->
    <nav class="wsmenu slideLeft clearfix">
      <ul class="mobile-sub wsmenu-list">
        <li><a href="/index.php"><i class="fa fa-home"></i><span class="hometext">&nbsp;&nbsp;Home</span></a></li>
        <li><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Sfoglia Film <span class="arrow"></span><!--<span class="highlighter">23</span>--></a>
          <ul class="wsmenu-submenu">
            <li><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#"><i class="fa fa-angle-right"></i>Categorie</a>
              <ul class="wsmenu-submenu-sub">
                <?php
                $conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
                mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
                //$conn = mysql_connect('localhost','root','') or die("CONNESSIONE DATABASE FALLITA");
                //mysql_select_db('nopubfilm') or die("SELEZIONE DATABASE FALLITA");
                $query2 = "SELECT genere FROM Altadefinizione GROUP BY genere LIMIT 1,18446744073709551615";
                $result2 = mysql_query($query2) or die("QUERY FALLITA");
                $i = 0;
                while($h = mysql_fetch_array($result2, MYSQL_ASSOC)){
                  printf("<li><a href=\"categoria.php?categoria=%s\"><i class=\"fa fa-angle-right\"></i>%s </a></li>", $h['genere'],$h['genere']);
                }
                ?>
              </ul>
            </li>
            <li><a href="/topvisti.php"><i class="fa fa-angle-right"></i>I pi&ugrave; visti</a></li>
            <li><a href="/topvoti.php"><i class="fa fa-angle-right"></i>I pi&ugrave; votati</a></li>


          </ul>
        </li>
        <li><span class="wsmenu-click"></span><a href="/chiSiamo.php"><i class="fa fa-user"></i>&nbsp;&nbsp;Chi siamo? </a>
        </li>
        <li><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#"><i class="fa fa-question"></i>&nbsp;&nbsp;Richiedi/Segnala <span class="arrow"></span><!--<span class="highlighter">23</span>--></a>
          <ul class="wsmenu-submenu">
            <li><a href="/richiestaFilm.php"><i class="fa fa-angle-right"></i>Richiesta Film</a></li>
            <li><a href="/segnalaFilm.php"><i class="fa fa-angle-right"></i>Segnala Film</a></li>
          </ul>
        </li>
        <li><span class="wsmenu-click"></span><a href="/categoria.php?categoria=Ultimi%20Inseriti"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Ultimi film inseriti </a>
        <li><span class="wsmenu-click"></span><a href="/attoriconsigliati.php"><i class="fa fa-group"></i>&nbsp;&nbsp;Attori consigliati </a>

        <li style="width: 240px;"><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#"><i class="fa fa-search"></i>&nbsp;&nbsp;Ricerca <span class="arrow"></span><!--<span class="highlighter">23</span>--></a>
          <ul class="wsmenu-submenu">
            <li>
              <form class="navbar-form" role="search" method="post" action="ricerca.php">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Per titolo" name="nome" id="srch-term">
                  <div class="input-group-btn">
                    <button style="height: 34px;" class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </li>
            <li>
              <form class="navbar-form" role="search" method="get" action="ricercaattore.php">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Per attore" name="nome" id="srch-term">
                  <div class="input-group-btn">
                    <button style="height: 34px;" class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </li>
            <li>
              <form class="navbar-form" role="search" method="get" action="ricercaanno.php">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Per anno" name="anno" id="srch-term">
                  <div class="input-group-btn">
                    <button style="height: 34px;" class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!--Menu HTML Code-->


  </div>
</div>
<br>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <form action="" method="get">
      Ordina:
      <div class="btn-group">
          <a class="btn btn-default <?php if(strcmp($ordine,'nome')==0){echo 'active';} ?>" href="/ricercaanno.php?ordine=nome&anno=<?php echo $anno1; ?>">Per Titolo</a>
          <a class="btn btn-default <?php if(strcmp($ordine,'voto')==0){echo 'active';} ?>" href="/ricercaanno.php?ordine=voto&anno=<?php echo $anno1; ?>">Per Voto</a>
      </div>
    </form>
  </div>
  <div class="col-md-3"></div>
</div>

<div id='header'> <br>Risultati della ricerca con parole chiave: <span><?php echo $anno1; ?><span> </div><br>

<?php
if($result){
  while($r = mysql_fetch_array($result, MYSQL_ASSOC)){
    $titolo = $r['nome'];
    $link = $r['link'];
    $locandina = $r['locandina'];
    $voto = $r['imdb'];
    $anno = $r['anno'];

    printf("<div id='$titolo' class='divCategoria'><a href='schedaFilm.php?link=%s&titolo=%s'><img width='175' height='246' src='%s'></a><div class='anno'><span><a href='ricercaanno.php?anno=%s'>%s</a></span></div><div class='voto'><span> VOTO: %s</span></div><div class='titolo'><span>%s</span></div></div>", $link,$titolo,$locandina,$anno,$anno,$voto,$titolo);

  }
}

?>

<a id="back-to-top" href="#" class="btn btn-lg btn-primary back-to-top"
   role="button" title="" data-toggle="tooltip" data-placement="top">
  <span class="fa fa-arrow-circle-up fa-5"></span>
</a>

</body>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<script type="text/javascript">
  $(document).ready(function(){
    $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
      } else {
        $('#back-to-top').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
      $('#back-to-top').tooltip('hide');
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });

    $('#back-to-top').tooltip('show');
  });
</script>


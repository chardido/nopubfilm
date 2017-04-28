<?php
/**
 * SIMPLE PHP PAGE THAT SHOW STATICALLY SOME ACTORS CHOSEN BY ME
 */
?>
<head>
  <title>NoPubFilm - Attori consigliati</title>
  <link rel='stylesheet' href='stileIndexNuovo.css'>
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />

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

  <style>
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
      .nomeCat{
        margin-top:-50px;
        width: 96px;
        height: auto;
        font-size: 0.8em;
      }
    }
  </style>
</head>

<body style="background-color: black; color: white; font-size: medium;">
  <div id='divAlto'> <a href=''><img src='img/attoriconsigliati.jpg'></img></a> </div>
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
          <li><span class="wsmenu-click"></span><a href="/attoriconsigliati.php" class="active"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Attori consigliati </a>

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
    Seleziona l'attore desiderato per vedere quali film in cui ha recitato sono presenti su #NoPubFilm! <br><br>


<!--MATT DAMON-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Matt Damon'><img width='175' height='246' src='attori/mattdamon.jpg'></img></a><div class='nomeCat'>MATT DAMON</div></div>
<!--GEORGE CLOONEY-->
<div class='divCategoria'><a href='ricercaattore.php?nome=George Clooney'><img width='175' height='246' src='attori/georgeclooney.jpg'></img></a><div class='nomeCat'>GEORGE CLOONEY</div></div>
<!--BRAD PITT-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Brad Pitt'><img width='175' height='246' src='attori/bradpitt.jpg'></img></a><div class='nomeCat'>BRAD PITT</div></div>
<!--STEVE BUSCEMI-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Steve Buscemi'><img width='175' height='246' src='attori/stevebuscemi.jpg'></img></a><div class='nomeCat'>STEVE BUSCEMI</div></div>
<!--TIM ROTH-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Tim Roth'><img width='175' height='246' src='attori/timroth.jpg'></img></a><div class='nomeCat'>TIM ROTH</div></div>
<!--RUSSELL CROWE-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Russell Crowe'><img width='175' height='246' src='attori/russellcrew.jpg'></img></a><div class='nomeCat'>RUSSELL CROWE</div></div>
<!--LEONARDO DICAPRIO-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Leonardo DiCaprio'><img width='175' height='246' src='attori/leonardodicaprio.jpg'></img></a><div class='nomeCat'>LEO DICAPRIO</div></div>
<!--DENZEL WASHINGTON-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Denzel Washington'><img width='175' height='246' src='attori/denzelwashington.jpg'></img></a><div class='nomeCat'>D. WASHINGTON</div></div>
<!--WILL SMITH-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Will Smith'><img width='175' height='246' src='attori/willsmith.jpg'></img></a><div class='nomeCat'>WILL SMITH</div></div>
<!--MICHAEL DOUGLAS-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Michael Douglas'><img width='175' height='246' src='attori/michaeldouglas.jpg'></img></a><div class='nomeCat'>MICHAEL DOUGLAS</div></div>
<!--CLINT EASTWOOD-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Clint Eastwood'><img width='175' height='246' src='attori/clinteastwood.jpg'></img></a><div class='nomeCat'>CLINT EASTWOOD</div></div>
<!--JACK NICHOLSON-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Jack Nicholson'><img width='175' height='246' src='attori/jacknicholson.jpg'></img></a><div class='nomeCat'>JACK NICHOLSON</div></div>
<!--MARCELLO MASTROIANNI-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Marcello Mastroianni'><img width='175' height='246' src='attori/marcellomastroianni.jpg'></img></a><div class='nomeCat'>M. MASTROIANNI</div></div>
<!--TOM CRUISE-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Tom Cruise'><img width='175' height='246' src='attori/tomcruise.jpg'></img></a><div class='nomeCat'>TOM CRUISE</div></div>
<!--AL PACINO-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Al Pacino'><img width='175' height='246' src='attori/alpacino.jpg'></img></a><div class='nomeCat'>AL PACINO</div></div>
<!--ROBERT DE NIRO-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Robert De Niro'><img width='175' height='246' src='attori/robertdeniro.jpg'></img></a><div class='nomeCat'>ROBERT DE NIRO</div></div>
<!--JOE PESCI-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Joe Pesci'><img width='175' height='246' src='attori/joepesci.jpg'></img></a><div class='nomeCat'>JOE PESCI</div></div>
<!--KEVIN SPACEY-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Kevin Spacey'><img width='175' height='246' src='attori/kevinspacey.jpg'></img></a><div class='nomeCat'>KEVIN SPACEY</div></div>
<!--SAMUEL JACKSON-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Samuel L. Jackson'><img width='175' height='246' src='attori/samueljackson.jpg'></img></a><div class='nomeCat'>SAMUEL JACKSON</div></div>
<!--JOHNNY DEPP-->
<div class='divCategoria'><a href='ricercaattore.php?nome=Johnny Depp'><img width='175' height='246' src='attori/johnnydepp.jpg'></img></a><div class='nomeCat'>JOHNNY DEPP</div></div>
<!--JOHN TRAVOLTA-->
<div class='divCategoria'><a href='ricercaattore.php?nome=John Travolta'><img width='175' height='246' src='attori/johntravolta.jpg'></img></a><div class='nomeCat'>JOHN TRAVOLTA</div></div>

</body>



<meta charset="utf-8">
<?php
/**
 * THIS PAGE SHOW THE INFO OF THE SELECTED FILM AND LET YOU TO WATCH IT
 */
$link = $_GET['link'];
$titolo = $_GET['titolo'];

$conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET CHARACTER SET utf8');
$querytitolo = "SELECT DISTINCT nome FROM Altadefinizione WHERE link = '$link'";
$query = "SELECT DISTINCT Trama FROM Altadefinizione WHERE link = '$link'" ;
$query8 = "SELECT DISTINCT attore FROM Altadefinizione WHERE link = '$link'" ;
$query3 = "SELECT DISTINCT genere FROM Altadefinizione WHERE link = '$link'" ;
$query4 = "SELECT DISTINCT locandina FROM Altadefinizione WHERE link = '$link'" ;
$query5 = "SELECT DISTINCT imdb FROM Altadefinizione WHERE link = '$link'" ;
$query6 = "SELECT DISTINCT anno FROM Altadefinizione WHERE link = '$link'" ;
$query7 = "SELECT DISTINCT durata FROM Altadefinizione WHERE link = '$link'" ;

$result = mysql_query($query) or die("QUERY FALLITA");
$result8 = mysql_query($query8) or die("QUERY FALLITA");
$result3 = mysql_query($query3) or die("QUERY FALLITA");
$result4 = mysql_query($query4) or die("QUERY FALLITA");
$result5 = mysql_query($query5) or die("QUERY FALLITA");
$result6 = mysql_query($query6) or die("QUERY FALLITA");
$result7 = mysql_query($query7) or die("QUERY FALLITA");
$resulttitolo = mysql_query($querytitolo) or die("QUERY FALLITA");

$trama = mysql_fetch_array($result, MYSQL_ASSOC);
$locandina = mysql_fetch_array($result4, MYSQL_ASSOC);
$voto = mysql_fetch_array($result5, MYSQL_ASSOC);
$anno = mysql_fetch_array($result6, MYSQL_ASSOC);
$durata = mysql_fetch_array($result7, MYSQL_ASSOC);
$nome = mysql_fetch_array($resulttitolo, MYSQL_ASSOC);


?>

<head>
    <title>Scheda film: <?php echo $nome['nome']; ?></title>


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

</head>

<body style="background-color: black; color: white;">
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
                <li><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#" ><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Categorie <span class="arrow"></span><!--<span class="highlighter">23</span>--></a>
                    <ul class="wsmenu-submenu">
                        <?php
                        $conn = mysql_connect('localhost','nopubfilm','') or die("CONNESSIONE DATABASE FALLITA");
                        mysql_select_db('my_nopubfilm') or die("SELEZIONE DATABASE FALLITA");
                        //$conn = mysql_connect('localhost','root','') or die("CONNESSIONE DATABASE FALLITA");
                        //mysql_select_db('nopubfilm') or die("SELEZIONE DATABASE FALLITA");
                        $query2 = "SELECT genere FROM Altadefinizione GROUP BY genere LIMIT 1,18446744073709551615";
                        $result2 = mysql_query($query2) or die("QUERY FALLITA");
                        $i = 0;
                        while($h = mysql_fetch_array($result2, MYSQL_ASSOC)){
                            $genere = $h['genere'];
                            printf("<li><a href=\"categoria.php?categoria=%s\"><i class=\"fa fa-angle-right\"></i>%s </a></li>", $genere,$genere);
                        }
                        ?>
                    </ul>
                </li>
                <li><span class="wsmenu-click"></span><a href="/chiSiamo.php"><i class="fa fa-user"></i>&nbsp;&nbsp;Chi siamo? </a>
                </li>
                <li><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#" ><i class="fa fa-question"></i>&nbsp;&nbsp;Richiedi/Segnala <span class="arrow"></span><!--<span class="highlighter">23</span>--></a>
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
<h1 class="align-center" style="text-align: center" id="titolo"><?php echo $nome['nome']; ?></h1>
<br> <br> <br>

<div class="row" style="text-align: center">
    <img src="<?php echo $locandina['locandina']; ?>">
</div>

<br>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">Trama:</div>
    <div class="col-md-6">
        <?php
        $tram = $trama['Trama'];
        if(strcmp(substr($tram,-13)," Fonte Trama!") == 0){
            echo substr($trama['Trama'],0,-13);
        }else{
            echo $tram;
        }


        ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">Categoria:</div>
    <div class="col-md-6">
        <?php
        $cat = "";
        $i = 0;
        while ($categorie = mysql_fetch_array($result3,MYSQL_ASSOC)){
            $cat = $cat . ", <a href='/categoria.php?categoria=" . $categorie['genere']."'>".$categorie['genere']."</a>";
        }
        echo substr($cat,2);
        ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">Attori:</div>
    <div class="col-md-6">
        <?php
        $atto = "";
        $i = 0;
        while ($attori = mysql_fetch_array($result8,MYSQL_ASSOC)){
            $atto = $atto . ", <a href='/ricercaattore.php?nome=".$attori['attore']."'>".$attori['attore']."</a>";
        }
        echo substr($atto,2);
        ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">Anno:</div>
    <div class="col-md-6">
        <a href="ricercaanno.php?anno=<?php echo $anno['anno'];?>"><?php echo $anno['anno'];?></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">Durata:</div>
    <div class="col-md-6">
        <?php echo $durata['durata'];?> minuti
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">Voto IMDB:</div>
    <div class="col-md-6">
        <?php echo $voto['imdb'];?>/10
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="film2.php" method="get">
            <input type="hidden" name="link" value="<?php echo $link;?>">
            <input type="hidden" name="titolo" value="<?php echo $titolo;?>">
            <button type="submit" class="btn btn-primary btn-lg btn-block">VAI AL FILM</button>
        </form>
    </div>

    <!-- <a href="<?php echo "/film2.php?link=$link&titolo=$titolo;"?>"><h1>VAI AL FILM</h1></a> -->
</div>
<div class="row" style="text-align: center;">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="javascript:history.go(-1)">
            <button type="submit" class="btn btn-primary btn-lg btn-block">TORNA INDIETRO</button>
        </form>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">
        <h3>Commenti</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div id="disqus_thread"></div>
    </div>
</div>

</body>


<script>


    var titolo = document.getElementById("titolo").textContent;

    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */

     var disqus_config = function () {
     this.page.url = window.location.href;  // Replace PAGE_URL with your page's canonical URL variable

     this.page.identifier = titolo; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
     };

    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//nopubfilm.disqus.com/embed.js';

        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="statistiche free" ><script  type="text/javascript" >
        try {Histats.start(1,3335940,4,0,0,0,"");
            Histats.track_hits();} catch(err){};
    </script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3335940&101" alt="statistiche free" border="0"></a></noscript>
<!-- Histats.com  END  -->



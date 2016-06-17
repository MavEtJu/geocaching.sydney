<?php

$config = readconfig();
header1();
foreach ($config as $code => $data) {
    area($code, $data["x"], $data["y"], $data["dx"], $data["dy"]);
}
header2();
foreach ($config as $code => $data) {
    showlink($code, $data["name"], $data["location"], $data["url"]);
}
header3();

function header1()
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>New South Wales Trails Map</title>
    <style type="text/css">
	body {
	    padding: 0;
	    margin: 0;
	}
	#map ul {
	    padding: 0;
	    margin: 0;
	}

	#map {
	   margin:0;
	   padding:0;
	   width:1226px;
	   height:1049px;
	   background:url(nsw-trails.png) top left no-repeat #fff;
	   background-position: 0px,0px;
	   font-family:arial, helvetica, sans-serif;
	   font-size:8pt;
	}

        #map li {
	    margin:0;
	    padding:0;
	    list-style:none;
	}
	
	#map li a {
	    position:absolute;
	    display:block;
	    text-decoration:none;
	    color:#000;
	}
	
	#map li a span { display:none; }
	
	#map li a:hover span {
	    position:relative;
	    display:block;
	    width:200px;
	    left:20px;
	    top:20px;
	    border:1px solid #000;
	    background:#fff;
	    padding:5px;
	    filter:alpha(opacity=80);
	    opacity:0.8;
	}
<?php
}

function area($classname, $x, $y, $dx, $dy)
{
?>
    #map a.<?= $classname ?> {
	left:<?= $x ?>px;
	top:<?= $y ?>px;
	width:<?= $dx ?>px;
	height:<?= $dy ?>px;
    }
<?php
}

function header2()
{
?>
    </style>
    </head>
    <body>

    <ul id="map">
<?php
}

function showlink($classname, $title, $location, $url)
{
?>
    <li>
    <a class="<?= $classname ?>" href="<?= $url ?>" target="_blank" title="<?= $classname ?>"><span><b><?= $title ?></b><br><?= $location?></span></a>
    </li>
<?php
}

function header3()
{
?>
    </ul>
    </body>
</html>
<?php
}

function readconfig()
{
    $config = array();

    $l = file_get_contents("nsw-trails.txt");
    $lines = explode("\n", $l);
    $current = array();
    foreach ($lines as $l) {
	$ws = explode(": ", $l);

	// code: hpmpt
	// coordinates: 700,600
	// size: 35x56
	// name: Harry Potter MPT
	// location: Bumbaldry
	// url: https://www.geoc

	if ($ws[0] == "coordinates") {
	     $xy = explode(",", $ws[1]);
	     $current["x"] = $xy[0];
	     $current["y"] = $xy[1];
	     continue;
	}
	if ($ws[0] == "size") {
	     $dxy = explode("x", $ws[1]);
	     $current["dx"] = $dxy[0];
	     $current["dy"] = $dxy[1];
	     continue;
	}
	if ($ws[0] == "code") {
	     $current["code"] = $ws[1];
	     continue;
	}
	if ($ws[0] == "name") {
	     $current["name"] = $ws[1];
	     continue;
	}
	if ($ws[0] == "location") {
	     $current["location"] = $ws[1];
	     continue;
	}
	if ($ws[0] == "url") {
	     $current["url"] = $ws[1];
	     $config[$current["code"]] = $current;
	     $current = array();
	     continue;
	}
    }

    return $config;
}

<?php

createfeed();

function meta($c)
{
    $name = "Episode $c.meta";
    if (!file_exists($name))
	return array();
    $l = file_get_contents($name);
    $ls = explode("\n", $l);
    $meta = array();
    foreach ($ls as $l) {
	if ($l == "")
	    continue;
	$words = explode(": ", $l);
	$cmd = array_shift($words);
	$l = join(": ", $words);
	$meta[$cmd] = $l;
    }

    return $meta;
}


function createfeed()
{
    $items = "";
    $itemtemplate = file_get_contents("feed.item");

    $lastPubdate = "";
    $i = 0;
    do {
	$i++;

	$meta = meta($i);
	if (count($meta) == 0)
	    break;

	$urlbase = "https://geocaching.sydney/podcast";
	$mp3 = preg_replace("/ /", "%20","$urlbase/$meta[MP3]");
	$stat = @stat($meta["MP3"]);
	$link = preg_replace("/ /", "%20","$urlbase/index.php?episode=$i");

	$desc = "<p>$meta[Title]</p><p>Links and the full text can be found at the episode information at <a href=\"$link\">$link</a></p><p><ul>";
	$l = file_get_contents("Episode $i.links");
	$ls = explode("\n", $l);
	foreach ($ls as $l) {
	    if ($l == "") break;
	    $words = explode(" ", $l);
	    $url = array_shift($words);
	    $l = join(" ", $words);
	    $desc .= "<li><a href=\"$url\">$l</a>";
	}
	$desc .= "</ul></p>";

	$item = $itemtemplate;
	$item = preg_replace("/@@NUMBER@@/", $i, $item);
	$item = preg_replace("/@@TITLE@@/", $meta["Title"], $item);
	$item = preg_replace("/@@LINK@@/", $link, $item);
	$item = preg_replace("/@@MP3@@/", $mp3, $item);
	$item = preg_replace("/@@MP3SIZE@@/", $stat["size"], $item);
	$item = preg_replace("/@@MP3DURATION@@/", $meta[Duration], $item);
	$item = preg_replace("/@@PUBDATE@@/", $meta[Pubdate], $item);
	$item = preg_replace("/@@DESCRIPTION@@/", $desc, $item);

	$lastPubdate = $meta["Pubdate"];

	$items .= $item;
    } while (1);

    $feedtemplate = file_get_contents("feed.header");
    $feedtemplate = preg_replace("/@@ITEMS@@/", $items, $feedtemplate);
    $feedtemplate = preg_replace("/@@BUILDDATE@@/", $lastPubdate, $feedtemplate);

    echo "$feedtemplate\n";

}

<?php

html_header();
html_intro();
html_communities();
html_maps();
html_footer();


function html_intro()
{
?>
	<div class="center header">Geocaching in Sydney</div>
	<p>
	Welcome to Sydney! Are you looking for the right place to
	search for a geocache or do you want to get in contact with
	the local Geocaching communities? This is the right place
	to be!
	</p>

	<p>
	There are two different sources for Geocaching in Australia:
	The first one is the Groundspeak Geocaching.com site, the
	second one is the Geocaching Australia site. Both sides
	support web-based interaction and GPX based downloads.
	</p>
<?php
}

function html_communities()
{
?>
	<div class="center header">Communities</div>
	<p>
	The following Geocaching communities have formed in the
	greater Sydney area:
	</p>
<?php
	showlinks("communities.txt");
?>
	<p>
	The following Geocaching communities are on NSW state level
	and Australia wide:
	</p>
<?php
	showlinks("associations.txt");
?>
	<p />
<?php
}

function html_events()
{
?>
	<div class="center header">Events</div>
<?php
}

function html_maps()
{
?>
	<div class="center header">Maps</div>
	<p>
	Foo
	</p>
<?php
	showlinks("maps.txt");
?>
<?php
}

function html_header()
{
?>
<!doctype html>
<html><head>
    <title>Geocaching in Sydney</title>
    <link rel="stylesheet" text="text/css" href="site.css">
</head><body>
<?php
}

function html_footer()
{
?>
</body></html>
<?php
}

function showlinks($filename)
{
    $a = file_get_contents($filename);
    $as = explode("\n", $a);
    for ($i = 0; $i < count($as); $i += 2) {
    	if ($as[$i] == "")
	    continue;

	$key = $as[$i];
	$ref = $as[$i + 1];
	$ref = str_replace("&", "&amp;", $ref);
?>
	<div><?= $key ?> [ <a href="<?= $ref ?>">link</a> ]</div>
<?php
    }
}

?>

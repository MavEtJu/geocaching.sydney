<?php

html_header();
html_google_content();
if (isset($_REQUEST["episode"]) == FALSE) {
    html_intro();
    html_podcasts();
} else {
    html_episode($_REQUEST["episode"]);
}
html_footer();

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

function html_episode($c)
{
    echo "<h1>Geocaching in Sydney - $c</h1>\n";

    $meta = meta($c);
    echo "<p>$meta[Date] - $meta[Title]</p>\n";

    echo "<h2>Links</h2>\n";
    echo "<ul>\n";
    $l = file_get_contents("Episode $c.links");
    $ls = explode("\n", $l);
    foreach ($ls as $l) {
	if ($l == "") break;
	$words = explode(" ", $l);
	$url = array_shift($words);
	$l = join(" ", $words);
	echo "<li><a href=\"$url\">$l</a>\n";
    }
    echo "</ul>\n";
    echo "<a href=\"index.php\">Back to overview</a>";

    echo "<h2>Full Text</h2>\n";
    readfile("Episode $c.html");
}

function html_intro()
{
?>
    <img src="Geocaching in Sydney.png" width="320" align="right" />
    <div class="intro">
    <div class="header center">Geocaching in Sydney Podcast</div>
    <p>
    Welcome to Geocaching in Sydney, an irregular podcast about my geocaching adventures in the greater Sydney area.
    </p><p>
    The inspiration for this podcast came from my fascination of radio documentaries in which people travel through a town or city and explain what it is they are seeing or what they are doing. Together with the background sounds it creates the beautiful environment which the story gets told in. 
    </p>
    <p>
    You can find this podcast on <a href="https://itunes.apple.com/au/podcast/geocaching-in-sydney/id1263814202">iTunes</a> or as the <a href="feed.xml">RSS feed</a>.
    </p>
    Stay in contact with me: @mavetju on Twitter and Instagram, "Edwin Groothuis" on Facebook!
    <p>
    </div>
<?php
}

function html_podcasts()
{
?>
    <div class="intro">
    <div class="header center">Episodes</div>
<ul>
<?php
    $i = 0;
    do {
	$i++;
	$meta = meta($i);
	if (count($meta) == 0)
	    break;
    } while (1);

    date_default_timezone_set("Australia/Sydney");
    do {
	$i--;

	$meta = meta($i);
	if (count($meta) == 0)
	    break;

	echo "<li>[ <a href=\"$meta[MP3]\">MP3</a> | <a href=\"index.php?episode=$i\">Text</a> ] Episode $i ($meta[Date]) $meta[Title]";
    } while ($i > 0);

?>
</ul>
    </div>


<?php
}


function html_acknowledgements()
{
?>
   <div class="acknowledgements">
   	<div class="header center">Acknowledgements and contact details</div>
	<p>
	Background image obtained from Wikipedia: https://en.wikipedia.org/wiki/Geocaching#/media/File:Geocaching.svg 
	</p>
	<p>
	Maps obtained from Google Search: https://www.google.com/
	</p>
	<p>
	Top 10 lists obtained via the Groundspeak geocaching.com website.
	</p>
	<p>
	For questions, suggestions or feedback, you can contact me at: <a href="mailto:geocaching at mavetju dot org">geocaching at mavetju dot org</a>
	</p>
   </div>
<?php
}

function html_header()
{
?>
<!doctype html>
<html><head>
    <title>Geocaching in Sydney</title>
    <link rel="stylesheet" text="text/css" href="/site.css">
    <link rel="icon" type="image/png" href="/images/geocaching-logo-32x32.png">
    <meta name="description" content="Geocaching in Sydney">
    <meta name="keywords" content="geocaching,sydney,nsw">
    <meta name="author" content="Edwin Groothuis">
    <meta charset="utf-8">
<?php
    html_google_head();
?>

    <script type="text/javascript">
    function showmap($s) {
	document.getElementById("map").src = $s;
    }
    </script>
</head><body>
<?php
}

function html_footer()
{
?>
</body></html>
<?php
}

function html_google_head()
{
    html_google_head_ad();
    html_google_head_analytics();
}

function html_google_head_ad()
{
?>
    <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-33184807-1']);
    _gaq.push(['_trackPageview']);
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script>
<?php
}

function html_google_head_analytics()
{
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71758515-1', 'auto');
  ga('send', 'pageview');

</script>
<?php
}

function html_google_content()
{
?>
    <div class="google">
<script type="text/javascript"><!--
google_ad_client = "pub-0772703927761169";
/* 120x240, created 3/26/08 */
google_ad_slot = "3899828405";
google_ad_width = 120;
google_ad_height = 240;
//-->
</script>
<script type="text/javascript"
src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
    </div>
<?php
}

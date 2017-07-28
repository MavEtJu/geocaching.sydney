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

function html_episode($c)
{
    readfile("Geocaching in Sydney - $c.html");
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
    date_default_timezone_set("Australia/Sydney");
    do {
	$i++;
	$name = sprintf("Geocaching in Sydney - $i.mp3");
	if (file_exists($name) == FALSE)
	    break;
	$s = stat($name);
	$ctime = strftime("%d %B %y", $s["ctime"]);
	echo "<li>Episode $i ($ctime) [ <a href=\"$name\">MP3</a> | <a href=\"index.php?episode=$i\">Text</a> ]";
    } while (1);

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

<?php

html_header();
html_google_content();
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
	The following Geocaching communities are outside the greater Sydney area:
	</p>
<?php
	showlinks("communities-outside.txt");
?>
	<p />
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
    <link rel="icon" type="image/png" href="images/geocaching-logo-32x32.png">
    <meta name="description" content="Geocaching in Sydney">
    <meta name="keywords" content="geocaching,sydney,nsw">
    <meta name="author" content="Edwin Groothuis">
<?php
    html_google_head();
?>
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
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
    </div>
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

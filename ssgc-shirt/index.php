<html><head>
<title>Sutherland Shire Geocaching t-shirt order form</title>
<head><body>

<h1>Sutherland Shire Geocaching t-shirt order form</h1>

<p>
(Click to zoom in)
<br>
<a href="polo.jpg" target="_blank">
<img src="polo.jpg" width="480" />
</a>
<br>
NanaNel wears a size 18, Wazza9 wears a size L.
</p>

<?php
    if (isset($_REQUEST["submit"])) {
        if (isset($_REQUEST["name"]) && $_REQUEST["name"] != "" &&
            isset($_REQUEST["gcname"]) && $_REQUEST["gcname"] != "" &&
            isset($_REQUEST["firstname"]) && $_REQUEST["firstname"] != "" &&
            isset($_REQUEST["email"]) && $_REQUEST["email"] != "" &&
            isset($_REQUEST["size"]) && $_REQUEST["size"] != "")
	    email();
	else
	    form();
    } else {
	form();
    }
?>

</body></html>
<?php

function form()
{
?>
<p>
This order form will forward the details towards NanaNel who will take care of the ordering.
<br>
The price is 32 dollar, to be paid when receiving the shirt.
</p>

<p>
<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">

<table border="0">
<tr>
    <td align="right">Your real name, not for on the shirt:</td>
    <td><input type="text" name="name" placeholder="Edwin Groothuis"
    	<?= isset($_REQUEST["name"]) ? "value=\"$_REQUEST[name]\"" : "" ?>
    ></td>
</tr>
<tr>
    <td align="right">Your geocaching name, for on the shirt:</td>
    <td><input type="text" name="gcname" placeholder="Team MavEtJu"
    	<?= isset($_REQUEST["gcname"]) ? "value=\"$_REQUEST[gcname]\"" : "" ?>
    ></td>
</tr>
<tr>
    <td align="right">Your name, for under the geocaching name:</td>
    <td><input type="text" name="firstname" placeholder="Edwin"
    	<?= isset($_REQUEST["firstname"]) ? "value=\"$_REQUEST[firstname]\"" : "" ?>
    ></td>
</tr>
<tr>
    <td align="right">Your email address, so we can email you:</td>
    <td><input type="text" name="email" placeholder="edwin@mavetju.org"
    	<?= isset($_REQUEST["email"]) ? "value=\"$_REQUEST[email]\"" : "" ?>
    ></td>
</tr>
<tr>
    <td align="right">Do you need it before the Red Center Experience:</td>
    <td><input type="text" name="redcenter" value="no"></td>
</tr>
</table>

<table border="0">
<tr>
    <th align="left">Children</th>
    <th align="left">Ladies</th>
    <th align="left">Men</th>
</tr>

<?php

    $children = ["6", "8", "10", "12", "14", "16"];
    $ladies = ["12", "14", "16", "18", "20", "22", "24", "26"];
    $mens = ["XS", "S", "M", "L", "XL", "XXL", "XXXL", "XXXXL", "XXXXXL"];
    $max = max(count($children), max(count($lieds), count($mens)));

    for ($i = 0; $i < $max; $i++) {
?>
 	<tr>
	<td>
<?php
	    if (isset($children[$i])) {
?>
		<input type="radio" name="size" value="child_<?= $children[$i] ?>" size="3" align="right"> <?= $children[$i] ?>
<?php
	    }
	    echo "</td><td>\n";
	    if (isset($ladies[$i])) {
?>
		<input type="radio" name="size" value="ladies_<?= $ladies[$i] ?>" size="3" align="right"> <?= $ladies[$i] ?>
<?php
	    }
	    echo "</td><td>\n";
	    if (isset($mens[$i])) {
?>
		<input type="radio" name="size" value="men_<?= $mens[$i] ?>" size="3" align="right"> <?= $mens[$i] ?>
<?php
	    }
?>
	</td>
	</tr>
<?php
    }

?>
</table>

<input type="submit" name="submit" value="Yes, order this one for me!">

</form>
<?php
}

function email()
{
    $fout = fopen("log", "a+");
    fprintf($fout, "%s\t%s\t%s\t%s\t%s\t%s\t%s\n",
	    $_SERVER["REMOTE_ADDR"],
            $_REQUEST["name"],
            $_REQUEST["gcname"],
            $_REQUEST["firstname"],
            $_REQUEST["email"],
            $_REQUEST["size"],
            $_REQUEST["redcenter"]);
    fclose($fout);

?>
    <p>
    Thank you! We have registered the following for you:
    </p>
    <table>
    <tr>
        <td align="right">Your name:</td>
	<td><?= $_REQUEST["name"] ?></td>
    </tr>
    <tr>
        <td align="right">Your geocaching name:</td>
	<td><?= $_REQUEST["gcname"] ?></td>
    </tr>
    <tr>
        <td align="right">Your first name:</td>
	<td><?= $_REQUEST["firstname"] ?></td>
    </tr>
    <tr>
        <td align="right">Your email address:</td>
	<td><?= $_REQUEST["email"] ?></td>
    </tr>
    <tr>
        <td align="right">Your requested size:</td>
	<td><?= $_REQUEST["size"] ?></td>
    </tr>
    <tr>
        <td align="right">Before the Red Center experience?</td>
	<td><?= $_REQUEST["redcenter"] ?></td>
    </tr>
    </table>

    <p>
    An email is now on its way to NanaNel and to you.
    </p>
<?php

    $message = "From: $_REQUEST[name]\r\n" .
    		"Geocaching name: $_REQUEST[gcname]\r\n" .
    		"First name: $_REQUEST[firstname]\r\n" .
    		"Email: $_REQUEST[email]\r\n" .
    		"Size: $_REQUEST[size]\r\n" .
    		"Before Red Center: $_REQUEST[redcenter]\r\n";

    mail("ssgc-tshirt@mavetju.org", "[SSGC Polo] Order from $_REQUEST[name]", $message);
    mail($_REQUEST["email"], "[SSGC Polo] Order from $_REQUEST[name]", $message);
    mail("warwick_janelle@yahoo.com.au", "[SSGC Polo] Order from $_REQUEST[name]", $message);
}

?>

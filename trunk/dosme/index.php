<html>
<head>
<title>d0z.me</title>
<link href="css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/tracking.js">
</script>

<script>
function clear_field(el) {
if(el.defaultValue==el.value) el.value=""
}
</script>
</head>

<body>
<p>
<pre>
     __  _______                             
 .--|  ||   _   |.-----.    .--------..-----.
 |  _  ||.  |   ||-- __| __ |        ||  -__|
 |_____||.  |   ||_____||__||__|__|__||_____|
        |:  1   |                            
        |::.. . |                            
        `-------'                            

</pre>
by Ben Schmidt (<a href="http://twitter.com/_supernothing" target="_blank">supernothing</a>) of <a target="_blank" href="http://spareclockcycles.org">spareclockcycles.org</a>
</p>

<?php
    require_once("../config.php");
    require_once($PHP_INCLUDE_PATH."db_functions.php");
    if($_POST){
	    $link = $_POST['link'];
	    $target = $_POST['target'];
        $method = 0;
        if($_POST['method']=='GET'){
            $method = 1;
        }

	    $res = add_dos_link($link,$target,$title,$method);
	
        if($res){
		    echo "<p>Your new link: <a href='".$SITELINK.$res."' target='_blank'>".$SITELINK.$res."</a><br/>Please, be responsible.</p>";
	    } else {
	        die("<p>Link insertion failed for unspecified reasons.</p>");
        }

    } else {
	    require_once($STATIC_INCLUDE_PATH."create.inc");
    }
?>

<br/><br/>
<span class="footer">
<p>
Disclaimer: I am not responsible for any malicious use of this demonstration, nor any damages caused by it. It was created as an example of the serious consequences of the Internet's increased reliance upon URL shortners, as well as how easy it is to create an unwitting DDoS botnet using new HTML5 features without actually exploiting a single computer. It is intended only for demonstration and testing purposes; if you target a site that is not yours, you are responsible for the consequences.</p>

<p>
If you believe that you have been a victim of abuse due to the actions of this site's users, or you wish to add your site to a list of protected domains, please contact me at supernothing 4T spareclockcycles D0T org. Please note that simply by being on this list, you are *not* magically protected against the attack demonstrated here, only from those originating from this site. I (and many others) have posted on <a href="http://spareclockcycles.org/2010/12/22/follow-up-on-d0z-me-some-thoughts/" target="_blank">various mitagation techniques</a> that might alleviate some of the effects of such an attack, but a permanent solution will probably require browser updates.
</p>
<br/><p>All code used on this site is released under the GPLv3, and is available <a href="http://spareclockcycles.org/downloads/code/dosme.tar.gz">here</a>.</p>
<p>
<a href="http://www.eff.org/">Coding is not a crime.</a> [eff.org]
</p>
</span>
</body>
</html>

<?php
    include_once("config.php");
    include_once("header.inc");
    include_once("functions.php");

    if($_POST){
	    $link = $_POST['link'];
	    $target = $_POST['target'];
        if (isValidURL($link)&&isValidURL($target)){
            $target = escapeURL($target);
            $link = escapeURL($link);
        } else {
            die("Invalid url entered.");
        }
        $title = mysql_real_escape_string(htmlentities($_POST['title']));
	$res = add_dos_link($link,$target,$title);
	
        if($res){
		    include("create_success.php");
	    } else {
		    include("create_failed.inc");
	    }

    } else {
	    include("create.inc");
    }

    include_once("footer.inc");
?>

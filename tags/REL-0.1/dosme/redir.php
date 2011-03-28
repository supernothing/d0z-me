<?php
include_once("config.php");
include_once("functions.php");
	$hash = $_GET['hash'];
	if(!isValidHash($hash)){
        die("You ride the fail whale.");
    }
    $res = lookup_hash($hash);
    if($res){
	$row = mysql_fetch_assoc($res);
        $title = $row['title'];
        $link = $row['link'];
        $target = stripslashes($row['target']);
        include_once("embed.php");
        }else{
        echo "Link not found: ".mysql_error();
    }
?>

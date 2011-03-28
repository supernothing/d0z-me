<?php
include_once("../db_config.php");

//Validation and escape functions
function isValidURL($url)
{
	return	preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/*)?(\?.*)?$|i', $url);
}

function isValidHash($hash)
{
    return preg_match("|^([a-zA-Z0-9]+)$|",$hash);
}

function escapeURL($url) {
    $temp = explode("?",$url);

    if(count($temp)>1){
        return str_replace("%3D","=",$temp[0]."?".urlencode($temp[1]));
    } else {
        return $url;
    }
}

//Database functions
function lookup_hash($hash){
	$hash = mysql_escape_string($hash);
	return mysql_query("SELECT * FROM dos_links WHERE hash='".$hash."';");
}

function insert_new_entry($hash,$link,$title,$target) {
	return mysql_query("INSERT INTO `dos_links` (`hash`,`link`,`title`,`target`) VALUES ('".$hash."','".mysql_real_escape_string($link)."','".$title."','".mysql_real_escape_string($target)."');");
}

//Hash functions

//takes a string input, int length and optionally a string charset
//returns a hash 'length' digits long made up of characters a-z,A-Z,0-9 or those specified by charset
//credit: Moss at stackoverflow - http://stackoverflow.com/users/345657/Moss
function custom_hash($input, $length, $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'){
    $output = '';
    $input = md5($input); //this gives us a nice random hex string regardless of input
    do{
        foreach (str_split($input,8) as $chunk){
            srand(hexdec($chunk));
            $output .= substr($charset, rand(0,strlen($charset)), 1);
        }
        $input = md5($input);

    } while(strlen($output) < $length);

    return substr($output,0,$length);
}

function calc_new_hash($input){
	$len = 4;
	$flag = false;
	while(1){
	$hash = custom_hash($input,$len);
	if(mysql_num_rows(lookup_hash($hash))==0){
		break;
	}
	$len++;
	}
	return $hash;
}

//Higher level functions
function add_dos_link($link,$target,$title) {
    //expects escaped input
	if(strrpos($target, "spareclockcycles.org")||strrpos($target,"d0z.me")){
		return false;
	}
	$res = mysql_query("SELECT * FROM dos_links WHERE link='".mysql_real_escape_string($link)."' AND target='".mysql_real_escape_string($target)."' AND title='".$title."';");
	if(mysql_num_rows($res)!=0) {
		$row = mysql_fetch_assoc($res);
		return $row['hash'];
	} else {
		$hash = calc_new_hash($link.$target.$title);
		$res = insert_new_entry($hash,$link,$title,$target);
		
		echo mysql_error();
		if($res) {
			return $hash;
		} else {
			return false;
		}
	}
}
?>

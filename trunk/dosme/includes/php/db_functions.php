<?php
require_once($PHP_INCLUDE_PATH."db_connect.php");

//Executes all queries
function exec_query($query) {
    $res = mysql_query($query) or die($ERROR_MSG);
    return $res;
}

//Insertion queries

//Inserts a banned domain into table
function insert_new_banned($dmn){
    $dmn = mysql_escape_string($dmn);
    return exec_query("INSERT INTO `banned` (`domain`) VALUES ('".$dmn."');");
}

//Inserts a new shortened link
//Expects that entry has been checked and approved
function insert_new_entry($hash,$link,$title,$target,$method) {
	return exec_query("INSERT INTO `dos_links` (`hash`,`link`,`title`,`target`,`use_get`) VALUES ('".$hash."','".mysql_real_escape_string($link)."','".mysql_real_escape_string($title)."','".mysql_real_escape_string($target)."','".$method."');");
}

//Select queries

//Checks if banned domain is in table
function lookup_banned($dmn){
    $dmn = mysql_escape_string($dmn);
    return exec_query("SELECT * FROM banned WHERE domain='".$dmn."';");
}

//Checks for hash in link table
function lookup_hash($hash){
	$hash = mysql_escape_string($hash);
	return exec_query("SELECT * FROM dos_links WHERE hash='".$hash."';");
}

//Higher level functions

//Query stuff

//Parses target URL and checks to see if that domain is allowed
//Returns true if banned, false if not
//Always returns false if $IGNORE_BANNED_DOMAINS is true in config.php
function is_banned_domain($url) {
    
    if($IGNORE_BANNED_DOMAINS){
        return false;
    }

    require_once($PHP_INCLUDE_PATH."parse_domain.php");

    $domain = get_base_domain($url); 
    
    if(mysql_num_rows(lookup_banned($domain))!=0) {
        return true;
    } else {
        return false;
    }
}

function get_hash_entry($hash){
    require_once($PHP_INCLUDE_PATH."validate.php");
	if(!isValidHash($hash)){
        die($ERROR_MSG);
    }
    return lookup_hash($hash);
}

//Add stuff

//Applies some basic checks to ensure it's at least vaguely domain-like
//Then inserts the domain ban
function add_banned_domain($domain) {
    if(strlen($domain) <= 255 && preg_match('[a-z0-9-]+(.[a-z0-9-]+)*')){
        insert_new_banned($domain);
        return true;
    }else{
        return false;
    }
}

//Checks submission and inserts if found to be valid
function add_dos_link($link,$target,$title,$method) {
    require_once($PHP_INCLUDE_PATH."hash.php");
    require_once($PHP_INCLUDE_PATH."validate.php");
    
    if (isValidURL($link)&&isValidURL($target)){
        $target = escapeURL($target);
        $link = escapeURL($link);
    } else {
        die("Invalid url entered.");
    }

    $title = htmlentities($_POST['title']);
    
    if(is_banned_domain($target)){
            die("This domain is disallowed.");
    }
    
    $res = exec_query("SELECT * FROM dos_links WHERE link='".mysql_real_escape_string($link)."' AND target='".mysql_real_escape_string($target)."' AND title='".mysql_real_escape_string($title)."' AND use_get=".$method.";");
	if(mysql_num_rows($res)!=0) {
		$row = mysql_fetch_assoc($res);
		return $row['hash'];
	} else {
		$hash = calc_new_hash($link.$target.$title);
		$res = insert_new_entry($hash,$link,$title,$target,$method);
		return $hash;
	}
}

?>

<?php
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

?>

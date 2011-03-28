<?php
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
?>

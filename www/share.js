//
// var share = document.getElementById("hash_id");
// var post = document.getElementById("post_id");



treaty.getToken(function(token){
  treaty.consumeToken(token, function(fingerprint){
    if(fingerprint.deviceId){
    updateShare(fingerprint.deviceId);
    console.log("here");
  }
  });
});
function updateShare(visitor){
  var url = 'shareCounter';
  var method = 'POST';
  var params = 'visitors_id='+visitor;
  params += '&post_id='+document.getElementById("post_id").value;
  params += '&hash_id='+document.getElementById("hash_id").value;
  dosend(url,method,params);
}
function dosend(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      console.log(xhr.responseText);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}

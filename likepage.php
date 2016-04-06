<?php
	$actionlike = $_GET['v2'];
	$dst = $_GET['v1'];
?>

<!DOCTYPE html>
<html>
<head>
<title>RAPI</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="-1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>

<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="stylesheet" type="text/css" href="css/materialize.min.css">

</head>

<body class="wrapper">

<div id="fb-root"></div>

<script src="http://connect.facebook.net/en_US/all.js"></script>

<script>

	FB.init({
	appId :'xxx',
			status : true, // check login status
			cookie : true, // enable cookies to allow the server to access the session
			xfbml : true, // parse XFBML
			oauth : true, // enable OAuth 2.0
	});

	FB.getLoginStatus(function(response) {
		FB.api('/me', function(response) {
		    console.log('Good to see you, ' + response.name + '.');
		  });
		FB.api('/me/likes/104581442995140', function(response) {
		    console.log(response.data);
		    if(response.data == ''){
		    	console.log('no');
		    }else{
		    	console.log('ok');
		    	console.log(document.getElementById('actionlike').value);
		    	top.window.location = 'login.php?status=like&actionlike='+document.getElementById('actionlike').value+'&dst='+document.getElementById('dst').value;
		    }
		});
	});

</script>

<script>

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=1398661563766746";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

<script>
	FB.Event.subscribe('edge.create', function(href, widget) {
		console.log('like-ok');
		top.window.location = 'login.php?status=like&actionlike='+document.getElementById('actionlike').value+'&dst='+document.getElementById('dst').value;
	});
</script>

<input type="hidden" name="actionlike" id="actionlike" value="<?php echo $actionlike; ?>" />
<input type="hidden" name="dst" id="dst" value="<?php echo $dst; ?>" />

<div class="container">
<div class="row">
<div class="col s6">
  	<div class="box-like">
      <div class="box-like-h">RAPI</div>
      <p>ให้บริการ Internet, ระบบจัดการใช้งาน, และออกแบบระบบ Internet ภายในอาคาร </p>           
	</div>
</div>
<div class="col s6">
	<div class="fb-like" data-href="https://www.facebook.com/BuriramUTD/?fref=nf" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
</div>
</div>
</div>

<script src="js/jquery.min.js"></script>	
<script src="js/materialize.min.js"></script>	

</body>
</html>
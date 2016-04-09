<?php
    if( isset($_GET['actionlike']) && isset($_GET['dst']) ){
    	$linkloginonly=$_GET['actionlike'];
    	$linkorig = $_GET['dst'];
    }else{
    	$mac = ((isset($_POST['mac']))?$_POST['mac']:'');
	    $ip = ((isset($_POST['ip']))?$_POST['ip']:'');
	    $username = ((isset($_POST['username']))?$_POST['username']:'');
	    $linklogin = ((isset($_POST['link-login']))?$_POST['link-login']:'');
	    $linkorig = ((isset($_POST['link-orig']))?$_POST['link-orig']:'');
	    $error = ((isset($_POST['error']))?$_POST['error']:'');
	    $trial = ((isset($_POST['trial']))?$_POST['trial']:'');
	    $loginby = ((isset($_POST['login-by']))?$_POST['login-by']:'');
	    $chapid = ((isset($_POST['chap-id']))?$_POST['chap-id']:'');
	    $chapchallenge = ((isset($_POST['chap-challenge']))?$_POST['chap-challenge']:'');
	    $linkloginonly = ((isset($_POST['link-login-only']))?$_POST['link-login-only']:'');
	    $linkorigesc = ((isset($_POST['link-orig-esc']))?$_POST['link-orig-esc']:'');
	    $macesc = ((isset($_POST['mac-esc']))?$_POST['mac-esc']:'');
	    $identity = ((isset($_POST['identity']))?$_POST['identity']:'');
	    $bytesinnice = ((isset($_POST['bytes-in-nice']))?$_POST['bytes-in-nice']:'');
	    $bytesoutnice = ((isset($_POST['bytes-out-nice']))?$_POST['bytes-out-nice']:'');
	    $sessiontimeleft = ((isset($_POST['session-time-left']))?$_POST['session-time-left']:'');
	    $uptime = ((isset($_POST['uptime']))?$_POST['uptime']:'');
	    $refreshtimeout = ((isset($_POST['refresh-timeout']))?$_POST['refresh-timeout']:'');  
	    $linkstatus = ((isset($_POST['link-status']))?$_POST['link-status']:''); 
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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



<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {  
    if (response.status === 'connected') {     
      addmt();
    } else if (response.status === 'not_authorized') {
       alert('ไม่สามารถเข้าสู่ระบบได้');
    } else {
      //alert('ไม่สามารถเข้าสู่ระบบได้');
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    /*FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });*/
    FB.login(function(response) {
		if (response.authResponse) {
			addmt();
		}
	}, {scope: 'email,public_profile'});
  }

  window.fbAsyncInit = function() {
	FB.init({
		appId      : 'xxx',
		cookie     : true,  // enable cookies to allow the server to access 
		
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.5' // use graph api version 2.5
	});

	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});

  };



  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // login ไดเส่งไปลง mikrotik
  function addmt() {
    FB.api('/me?locale=en_US&fields=name,id', function(response) {
      console.log('Successful login for: ' + response.name);
     
     $.post('http://x.x.x.x/postmanage_mt/manage-mt.php', {'username':response.id, 'ifb':'ifb'}, function (data) {
		 	if(data.msg == 'ok'){
      			$('#username').val(response.id);
      			//$( "#login" ).submit();
      			doLogin();
      		}else if(data.msg == 'no'){
      			alert('ไม่สามารถเชื่อมต่ออุปกรณ์ได้');
      			fbLogoutUser();
      		}else{
      			alert('ชื่อผู้ใช้งานไม่สามารถใช้งานได้');
      			fbLogoutUser();
      		}

		}, 'json');	

    });
  }

  function fbLogoutUser() {
	FB.getLoginStatus(function(response) {
	    if (response && response.status === 'connected') {

	        FB.logout(function(response) {
	            document.location.reload();
	        });
	    } else if (response.status === 'not_authorized') 
	        {
	            FB.logout(function(response) {
	            	document.location.reload();
	            });
	        }
 });}

</script>

<script type="text/javascript" src="md5.js"></script>
<script type="text/javascript">

<!--
    function doLogin() {

    	var urldata = get_query();

		var myParam = urldata['status'];
		var actionlike = urldata['actionlike'];
		var dst = urldata['dst'];

		if(typeof myParam === 'undefined'){
			location.href = 'likepage.php?v1='+document.login.dst.value+'&v2='+document.getElementById('login').action;
			return false;
		}else{	
			document.getElementById("login").action = actionlike;
			document.getElementById("dst").value = dst;	

			document.login.username.value = document.login.username.value;
			//document.login.password.value = hexMD5('<?php echo $chapid; ?>' + document.login.password.value + '<?php echo $chapchallenge; ?>');			
			document.login.submit();
			return false;
		}
   }

   function get_query(){
	    var url = location.search;
	    var qs = url.substring(url.indexOf('?') + 1).split('&');
	    for(var i = 0, result = {}; i < qs.length; i++){
	        qs[i] = qs[i].split('=');
	        result[qs[i][0]] = decodeURIComponent(qs[i][1]);
	    }
	    return result;
	}

	function mylogin() {
	    var u = document.getElementById("username").value;
	    var p = document.getElementById("password").value;

	    if(u == ''){
	    	alert('กรุณากรอกชื่อผู้ใช้งาน');
	    }else{
	    	document.login.username.value = u;
			document.login.password.value = hexMD5('<?php echo $chapid; ?>' + p + '<?php echo $chapchallenge; ?>');	
			document.login.submit();
			return false;
	    }
	}

//-->
</script>



<!--<br>
<a href="javascript:void(0)" onclick="fbLogoutUser()">logout</a>
<br>-->


<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">

		<form class="login-form" id="login" name="login" action="<?php echo $linkloginonly; ?>" method="post">

			<input type="hidden" name="dst" id="dst" value="<?php echo $linkorig; ?>" />
			<input type="hidden" name="popup" value="true" />
	
	        <div class="row">
	          <div class="input-field col s12 center">
	            <img src="img/rapi.png" alt="" class="responsive-img valign profile-image-login">
	            <p class="center login-form-text">rapi - เข้าใช้งานอินเตอร์เน็ต</p>
	          </div>
	        </div>

	        <div class="row margin">
	          <div class="input-field col s12">
	            <i class="mdi-social-person-outline prefix"></i>
	            <input id="username" name="username" type="text" />
	            <label for="username" class="center-align">ชื่อผู้ใช้งาน</label>
	          </div>
	        </div>
	        <div class="row margin">
	          <div class="input-field col s12">
	            <i class="mdi-action-lock-outline prefix"></i>
	            <input id="password" name="password" type="password"/>
	            <label for="password">รหัสผ่าน</label>
	          </div>
	        </div>
	        <div class="row">
	          <div class="input-field col s12">
	            <a href="#" id="loginmt" onclick="mylogin()" class="btn waves-effect waves-light col s12 btngame">เข้าใช้งาน</a>
				<a href="#" class="btn waves-effect waves-light  indigo darken-2 col s12 btngame" onclick="checkLoginState();">เข้าใช้งานด้วย Facebook</a>
	          </div>
	        </div>
	        <div class="row">
	          <div class="input-field col s12">
	            <p class="margin medium-small"><a href="<?php echo 'register.php?actionlike='.$linkloginonly; ?>">สมัครใช้งานอินเตอร์เน็ต!</a></p>
	          </div>      
	        </div>

        </form>

    </div>
</div>
					 
						  
<script src="js/jquery.min.js"></script>	
<script src="js/materialize.min.js"></script>	

</body>
</html>

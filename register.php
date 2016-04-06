<?php
  $actionlike = $_GET['actionlike'];
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

<input type="hidden" name="actionlike" id="actionlike" value="<?php echo $actionlike; ?>" />

<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form" >
        <div class="row">
          <div class="input-field col s12 center">
            <img src="img/rapi.png" alt="" class="responsive-img valign profile-image-login">
            <p class="center login-form-text">rapi - สมัครเข้าใช้งานอินเตอร์เน็ต</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" name="username" type="text" class="validate">
            <label for="username" class="center-align">ชื่อผู้ใช้งาน</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password">
            <label for="password">รหัสผ่าน</label>
          </div>
        </div>
         <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" name="email" type="email">
            <label for="email" class="center-align">อีเมล์</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <a href="javascript:void(0)" id="btnregis" class="btn waves-effect waves-light col s12">สม้ครใช้งาน</a>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">พร้อมเข้าใช้งานอินเตอร์เน็ต? <a href="<?php echo $actionlike; ?>">เข้าใช้งาน</a></p>
          </div>
        </div>
      </form>
    </div>
</div>
					 						  
<script src="js/jquery.min.js"></script>	
<script src="js/materialize.min.js"></script>	
<script src="js/app.js"></script>	

</body>
</html>

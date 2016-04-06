(function(){


	/**
	 * register
	 */
	$('#btnregis').click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		var email = $('#email').val();

		var actionlike = $('#actionlike').val();

		if (username == '' || password == '') {
			alert('กรุณากรอกข้อมูล');

			if(password == ''){ $('#password').focus(); }
			if(username == ''){ $('#username').focus(); }

		}else{
			$.post('http://x.x.x.x/postmanage_mt/manage-mt.php', {'username':username, "password":password, "email":email}, function (data) {
			    
	      		if(data.msg == 'ok'){
	      			alert('สมัครใช้งานเรียบร้อยแล้ว');
	      			$('#username, #password, #email').val('');
	      			window.location.href = actionlike;
	      		}else if(data.msg == 'no'){
	      			alert('ไม่สามารถเชื่อมต่ออุปกรณ์ได้');
	      		}else{
	      			alert('ชื่อผู้ใช้งานไม่สามารถใช้งานได้');
	      		}

			}, 'json');
		}
	});




})();
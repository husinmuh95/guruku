
function formhash(form, password) {
	var p = document.createElement("input");
	
	form.appendChild(p);
	p.name = "p";
	p.type = "hidden";
	p.value = hex_sha512(password.value);
	
	password.value = "";
	form.submit();
}

function regformhash(form, uid, email, password, conf) {
	if(uid.value == '' || email.value == '' || password.value == '' || conf.value == '') {
		alert('Anda harus menyediakan semua detail yang diperlukan. Silahkan coba lagi');
		return false;
	}
	
	var re = /^\w+$/;
	if(!re.test(form.username.value)) {
		alert("Username harus mengandung hanya huruf, angka, dan garis bawah. Silahkan coba lagi");
		form.username.focus();
		return false;
	}
	
	if(password.value.length < 6) {
		alert("Password harus setidaknya sepanjang 6 karakter. Silahkan coba lagi");
		form.password.focus();
		return false;
	}
	
	var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
	if(!re.test(password.value)) {
		alert("Password harus mengandung setidaknya satu angka, satu huruf kecil dan satu huruf besar. Silahkan coba lagi");
		return false;
	}
	
	if(password.value != conf.value) {
		alert("Password dan konfirmasi Anda tidak cocok. Silahkan coba lagi");
		form.password.focus();
		return false;
	}
	
	var p = document.createElement("input");
	
	form.appendChild(p);
	p.name = "p";
	p.type = "hidden";
	p.value = hex_sha512(password.value);
	
	password.value = "";
	conf.value = "";
	
	form.submit();
	return true;
}
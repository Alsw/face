window.onload = function() {

	// 选择图片  
	document.getElementById('file-uploader-one').onchange = function() {

		var img = event.target.files[0];

		if (!img) {
			return;
		}

		// 判断图片格式  
		if (!(img.type.indexOf('image') == 0 && img.type && /\.(?:jpg|png)$/.test(img.name))) {
			alert('图片格式不正确');
			return;
		}

		var reader = new FileReader();

		reader.readAsDataURL(img);

		reader.onload = function(e) { // reader onload start  
				// ajax 上传图片  
				document.getElementById('img-one').src = e.target.result;
				// $.post("server.php", {
				// 	img: e.target.result
				// }, function(ret) {
				// 	if (ret.img != '') {
				// 		alert('upload success');
				// 		$('#showimg').html('<img src="' + ret.img + '">');
				// 	} else {
				// 		alert('upload fail');
				// 	}
				// }, 'json');
			} // reader onload end  
	}
	document.getElementById('file-uploader-two').onchange = function() {

		var img = event.target.files[0];

		if (!img) {
			return;
		}

		// 判断图片格式  
		if (!(img.type.indexOf('image') == 0 && img.type && /\.(?:jpg|png)$/.test(img.name))) {
			alert('图片格式不正确');
			return;
		}

		var reader = new FileReader();

		reader.readAsDataURL(img);

		reader.onload = function(e) {

			document.getElementById('img-two').src = e.target.result;

			// $.post("server.php", {
			// 	img: e.target.result
			// }, function(ret) {
			// 	if (ret.img != '') {
			// 		alert('upload success');
			// 		$('#showimg').html('<img src="' + ret.img + '">');
			// 	} else {
			// 		alert('upload fail');
			// 	}
			// }, 'json');
		}
	}

}
$('.search-btn-one').click(function(event) {
	/* Act on the event */
	let imgPath = $(this).next('input').val();
	if (imgPath == '') {
		alert('请填写图片url')
	}
	$('#img-one').attr('src', imgPath);
});
$('.search-btn-two').click(function(event) {
	/* Act on the event */
	let imgPath = $(this).next('input').val();
	console.log(imgPath);
	if (imgPath == '') {
		alert('请填写图片url')
	}
	$('#img-two').attr('src', imgPath);
});
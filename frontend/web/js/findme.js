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
			let imgPath = e.target.result;
			$.ajax({
					url: 'index.php?r=face/facedetect',
					type: 'post',
					dataType: 'json',
					data: {
						img_base64: e.target.result
					},
				})
				.done(function(data) {
					console.log(data);
					$('#img-one').attr('src', imgPath).data('message', data.faces);
					let face = data.faces[0].attributes;
					let htmls = '<span id="' + data.faces[0].id + '">第一个人</span>';
					htmls += '<span>性别:' + ((face.gender[0].kind === 'female') ? '女' : '男') + '</span>';
					htmls += '<span>颜值:' + face.beauty + '</span>'
					htmls += '<span>种族:' + face.race[0].kind + '</span>'
					htmls += '<span>年龄:' + face.age + '</span>'
					htmls += '<span>表情:' + face.expression[0].kind + '</span>'

					$('.result-one').html(htmls).attr('data-status', 'true');
					checkFace();

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					$('#img-one').attr('src', imgPath);
				});

		}
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
			$.ajax({
					url: 'index.php?r=face/facedetect',
					type: 'post',
					dataType: 'json',
					data: {
						img_base64: e.target.result
					},
				})
				.done(function(data) {
					console.log(data);
					$('#img-two').attr('src', e.target.result).data('message', data.faces);
					let face = data.faces[0].attributes;
					let htmls = '<span id = "' + data.faces[0].id + '" > 第二个人 </span>';
					htmls += '<span>性别:' + ((face.gender[0].kind === 'female') ? '女' : '男') + '</span>';
					htmls += '<span>颜值:' + face.beauty + '</span>'
					htmls += '<span>种族:' + face.race[0].kind + '</span>'
					htmls += '<span>年龄:' + face.age + '</span>'
					htmls += '<span>表情:' + face.expression[0].kind + '</span>'

					$('.result-two').html(htmls).attr('data-status', 'true');
					checkFace();

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					$('#img-two').attr('src', e.target.result);
				});

		}
	}

}
let checkFace = function() {
	let one = $('.result-one');
	let two = $('.result-two');
	if (one.data('status') == true && two.data('status') == true) {
		$.ajax({
				url: 'index.php?r=face/facecompare',
				type: 'post',
				dataType: 'json',
				data: {
					faceid1: one.children('span').eq(0).attr('id'),
					faceid2: two.children('span').eq(0).attr('id')
				},
			})
			.done(function(data) {
				let htmls = '<span>是同一个人的概率：' + data.score * 100 + '%</span>';
				$('.result-desc').html(htmls);


			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {

			});
	}
}
$('.search-btn-one').click(function(event) {
	/* Act on the event */
	let imgPath = $(this).next('input').val();
	if (imgPath == '') {
		alert('请填写图片url')
	}
	$.ajax({
			url: 'index.php?r=face/facedetect',
			type: 'post',
			dataType: 'json',
			data: {
				img_url: imgPath
			},
		})
		.done(function(data) {
			$('#img-one').attr('src', imgPath).data('message', data.faces);
			let face = data.faces[0].attributes;
			let htmls = '<span id="' + data.faces[0].id + '">第一个人</span>';
			htmls += '<span>性别:' + ((face.gender[0].kind === 'female') ? '女' : '男') + '</span>';
			htmls += '<span>颜值:' + face.beauty + '</span>'
			htmls += '<span>种族:' + face.race[0].kind + '</span>'
			htmls += '<span>年龄:' + face.age + '</span>'
			htmls += '<span>表情:' + face.expression[0].kind + '</span>'

			$('.result-one').html(htmls).attr('data-status', 'true');
			checkFace();

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			$('#img-one').attr('src', imgPath);
		});



});
$('.search-btn-two').click(function(event) {
	let imgPath = $(this).next('input').val();
	if (imgPath == '') {
		alert('请填写图片url')
	}
	$.ajax({
			url: 'index.php?r=face/facedetect',
			type: 'post',
			dataType: 'json',
			data: {
				img_url: imgPath
			},
		})
		.done(function(data) {
			$('#img-two').attr('src', imgPath).data('message', data.faces);
			let face = data.faces[0].attributes;
			let htmls = '<span id = "' + data.faces[0].id + '" > 第二个人 </span>';
			htmls += '<span>性别:' + ((face.gender[0].kind === 'female') ? '女' : '男') + '</span>';
			htmls += '<span>颜值:' + face.beauty + '</span>'
			htmls += '<span>种族:' + face.race[0].kind + '</span>'
			htmls += '<span>年龄:' + face.age + '</span>'
			htmls += '<span>表情:' + face.expression[0].kind + '</span>'

			$('.result-two').html(htmls).attr('data-status', 'true');
			checkFace();

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			$('#img-two').attr('src', imgPath);
		});
});
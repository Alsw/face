window.onload = function() {

	// 选择图片  
	facedetect('zero', function(id) {
		$.ajax({
				url: 'index.php?r=face/facecelebrity',
				type: 'post',
				dataType: 'json',
				data: {
					faceid: id
				},
			})
			.done(function(data) {
				let face = data.people;
				let htmls = '<span">跟你相似的人</span></br>';
				$.each(face, function(index, val) {
					let num = index + 1;
					let score = val.score.toFixed(4) * 100;
					let name = (val.chinese_name == '') ? val.english_name : val.chinese_name;
					if (index <= 8) {
						htmls += '<span">' + num + name + ':' + score.toFixed(2) + '%</span> </br>';
					}
				})
				$('.result-zero').append(htmls);

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {});
	});
	
}
var facedetect = function(id, callback) {
	console.log(id)
	document.getElementById('file-uploader-' + id).onchange = function() {
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
					$('#img-' + id).attr('src', e.target.result).data('message', data.faces);
					let face = data.faces[0].attributes;
					let htmls = '<span id = "' + data.faces[0].id + '" ></span>';
					// htmls += '<span>性别:' + ((face.gender[0].kind === 'female') ? '女' : '男') + '</span>';
					// htmls += '<span>颜值:' + face.beauty + '</span>'
					// htmls += '<span>种族:' + face.race[0].kind + '</span>'
					// htmls += '<span>年龄:' + face.age + '</span>'
					// htmls += '<span>表情:' + face.expression[0].kind + '</span>'

					$('.result-' + id).html(htmls).attr('data-status', 'true');
					callback(data.faces[0].id);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					$('#img-' + id).attr('src', e.target.result);
				});

		}
	}
}

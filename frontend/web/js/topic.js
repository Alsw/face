$('#topic-parentid').on('change', function(event) {
	console.log($(this).val());

	$.ajax({
			url: 'index.php?r=topic/column',
			type: 'post',
			dataType: 'json',
			data: {
				parentId: $(this).val(),
			},
		})
		.done(function(data) {
			console.log(data);
			var htmls = '';
			$.each(data.data, function(index, val) {
				htmls += ' <option value="' + index + '">' + val + '</option>';
			});
			$('#topic-columnid').html(htmls);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

});
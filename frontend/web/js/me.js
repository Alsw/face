$(window).load(function() {
	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails"
	});
});
$('#myTab').on('click', 'li', function(event) {
	$(this).addClass('active').siblings('li').removeClass('active');

});
jQuery(document).ready(function($) {
	$id = $('.tab-pane').attr('id');
	$('#myTab').children('#' + $id).addClass('active').siblings('li').removeClass('active');
});
$('.goodCount').on('click', 'p', function(event) {
	if ($(this).hasClass('active')) {
		$(this).removeClass('active').children('.count').text(~~$(this).text() - 1);
		$.ajax({
				url: 'index.php?r=like/delete',
				type: 'post',
				dataType: 'json',
				data: {
					objectId: $(this).parents('.goodCount').data('id'),
					objectType: 'answer',
				},
			})
			.done(function(data) {
				if (data.status !== 200) {
					alert('评论失败')
				}
			})

	} else {
		$(this).addClass('active').children('.count').text(~~$(this).text() + 1);
		$.ajax({
				url: 'index.php?r=like/create',
				type: 'post',
				dataType: 'json',
				data: {
					objectId: $(this).parents('.goodCount').data('id'),
					objectType: 'answer',
				},
			})
			.done(function(data) {
				if (data.status !== 200) {
					alert('评论失败')
				}
			})

	}
});
$('#myTabContent').on('click', '.detail', function(event) {
	if ($(this).data('type') == 0) {
		$(this).data('type', '1').prev('.value-content').css({
			display: 'block',
		}).prevAll('.value-abstrat').css({
			display: ' none',
		});
	} else {
		$(this).data('type', '0').prev('.value-content').css({
			display: 'none',
		}).prevAll('.value-abstrat').css({
			display: 'block',
		});
	}
});
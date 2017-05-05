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
$('.SubTabs a:first').on('click', function(event) {
	console.log(1)
	$(this).addClass('is-active').siblings('a').removeClass('is-active');
	$('.myAt').css({
		display: 'block',
	});
	$('.atMe').css({
		display: 'none',
	});
});
$('.SubTabs a:last').on('click', function(event) {
	$(this).addClass('is-active').siblings('a').removeClass('is-active');
	$('.atMe').css({
		display: 'block',
	});
	$('#useralbum-description').css('height', '40px');
	$('.myAt').css({
		display: 'none',
	});
});

$('.picture').on('click', 'a', function(event) {
	var htmls = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	htmls += '<div class="modal-dialog modal-lg">';
	htmls += '<div class="modal-content">';
	htmls += '<div class="modal-header">';
	htmls += '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
	htmls += '<h4 class="modal-title" id="project-1-label">图片描述</h4>';
	htmls += '</div>';
	htmls += '<div class="modal-body">';
	htmls += '<div class="row">';
	htmls += '<div class="col-md-6">';
	htmls += '<p style="margin-bottom:10px;">' + $(this).data('message') + '</p>';
	htmls += '</div>';
	htmls += '<div class="col-md-6"><img style="max-width:300px;" src="' + $(this).children('img')[0].src + '">';
	htmls += '</div>';
	htmls += '</div>';
	htmls += '</div>';
	htmls += '<div class="modal-footer">';
	htmls += '<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close </button>';
	htmls += '</div>';
	htmls += '</div>';
	htmls += '</div>';
	htmls += '</div>';

	$('.dialogs').html(htmls)
});
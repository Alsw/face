$('#topic-parentid').on('change', function(event) {
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
$('.answer-comment').on('click', 'button', function(event) {

	$.ajax({
		url: 'index.php?r=comment/create',
		type: 'post',
		dataType: 'json',
		data: {
			content: $(this).parents('.answer-comment').find('#comment-text').val(),
			objectType: 'answer',
			objectId: $(this).parents('.answer-comment').find('#objectData').data('id'),
			toUserId: 0,
			_csrf: $('#_csrf').val()
		},
		success: function(data) {
			if (data.status === 205) {
				location.href = "index.php?=user/login"
			}
			if (data.status === 200) {
				window.location.reload();
			}
		},
		error: function() {
			alert('error');
		}
	})
});
// $('#comment-footer button').on('click', function() {
// 	$.ajax({
// 		url: 'index.php?r=comment/create',
// 		type: 'post',
// 		dataType: 'json',
// 		data: {
// 			content: $('#comment-text').val(),
// 			objectType: 'topic',
// 			objectId: $('#objectData ').data('id'),
// 			toUserId: 0,
// 			_csrf: $('#_csrf').val()
// 		},
// 		success: function(data) {
// 			if (data.status === 205) {
// 				location.href = "index.php?=user/login"
// 			}
// 			if (data.status === 200) {
// 				window.location.reload();
// 			}
// 		},
// 		error: function() {
// 			alert('error');
// 		}
// 	})

// });
$('.Comments').on('click', '.topic-huifu', function() {
	$('.CommentItem-editor').css({
		display: 'none',
	});
	$(this).parent().next().css({
		display: 'block',
	});

});
$('.quxiao').click(function(event) {
	$(this).parents('.CommentItem-editor').css({
		display: 'none',
	});
});
$('.Comments').on('click', '.dialog', function(event) {
	$.ajax({
			url: 'index.php?r=comment/show',
			type: 'post',
			dataType: 'json',
			data: {
				objectType: 'comment',
				objectId: $(this).parents('#comment-id').data('id'),
				_csrf: $('#_csrf').val()
			},
		})
		.done(function(data) {
			console.log(data);
			let htmls = '';
			htmls += ' <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
			htmls += '    <div class="modal-dialog" role="document">';
			htmls += '<div class="modal-content">';
			htmls += '  <div class="modal-header">';
			htmls += ' <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			htmls += ' <h4 class="modal-title" id="myModalLabel">查看对话</h4>';
			htmls += ' </div>';
			htmls += '<div class="modal-body">';
			htmls += ' <div>';
			$.each(data, function(index, val) {
				htmls += ' <div class="CommentItem">';
				htmls += '   <div>';
				htmls += '  <div class="CommentItem-meta">';
				htmls += '<span> ';
				htmls += '<a href="/index.php?r=user%2Fperson&id=1=' + val.userId + '"><img src="http://www.facefrontend.com' + val.userAvatar + '" class="media-object img-cricle"  style="width:25px; height:25px; display:inline-block;" /></a>';
				htmls += ' </span>';
				htmls += '<span>' + val.userName + '</span>';
				htmls += '<span><span class="topic-huifu">回复</span><span>' + val.toUser + '</span></span>';
				htmls += ' <span class="topic-time">' + val.createdTime + '</span>';
				htmls += ' </div>';
				htmls += '<div class="RichText CommentItem-content">';
				htmls += val.value.content;
				htmls += '</div>';
				htmls += ' <div class="CommentItem-footer topic-comment" >';
				htmls += '</div></div></div>';
			});

			htmls += '</div></div></div></div></div>';

			$('body').append(htmls);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});



});

$('.Comments').on('click', '.pinglun', function(event) {
	$.ajax({
		url: 'index.php?r=comment/create',
		type: 'post',
		dataType: 'json',
		data: {
			content: $(this).parent().prev().children('.Input').val(),
			objectType: 'comment',
			objectId: $(this).parents('#comment-id').data('id'),
			toUserId: $(this).parents('#comment-id').data('userid'),
			_csrf: $('#_csrf').val()
		},
		success: function(data) {
			if (data.status === 205) {
				location.href = "index.php?=user/login"
			}
			if (data.status === 200) {
				window.location.reload();
			}
		},
		error: function() {
			alert('error');
		}
	})

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
$('.Comments').on('click', '.like-count', function(event) {
	if ($(this).hasClass('like-active')) {
		$(this).removeClass('like-active').text(~~$(this).text() - 1);
		$.ajax({
				url: 'index.php?r=like/delete',
				type: 'post',
				dataType: 'json',
				data: {
					objectId: $(this).parents('#comment-id').data('id'),
					objectType: 'comment',
				},
			})
			.done(function(data) {
				if (data.status !== 200) {
					alert('评论失败')
				}
			})

	} else {
		$(this).addClass('like-active').text(~~$(this).text() + 1);
		$.ajax({
				url: 'index.php?r=like/create',
				type: 'post',
				dataType: 'json',
				data: {
					objectId: $(this).parents('#comment-id').data('id'),
					objectType: 'comment',
				},
			})
			.done(function(data) {
				if (data.status !== 200) {
					alert('评论失败')
				}
			})

	}
});

$(".answer").on('click', 'a', function(event) {
	$('.answer-main').css({
		display: 'block',
	});
});
$('#dynamic').on('click', '.detail', function(event) {
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
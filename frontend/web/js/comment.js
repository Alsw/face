$('#createComment').on('click', function() {
    $.ajax({
        url: 'index.php?r=comment/create',
        type: 'post',
        dataType: 'json',
        data: {
            content: $('#comment-text').val(),
            objectType: 'article',
            objectId: $('#objectData ').data('id'),
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
$('.media-list').on('click', '.huifu a', function() {
    var status = $(this).parents('.media-right').next('.person');
    if (status.css('display') === 'none') {
        $('.person').css({
            display: 'none',
        });
        status.css({
            display: 'block'
        }).children('textarea').focus();



    } else {
        status.css({
            display: 'none'
        })
    }

});
$('.media-list').on('click', '.media-body', function() {
    $('.person').css({
        display: 'none',
    });
});
$('.media-list').on('click', '#createComment', function() {
    $.ajax({
        url: 'index.php?r=comment/create',
        type: 'post',
        dataType: 'json',
        data: {
            content: $(this).parents('.person').children('#comment-text').val(),
            objectType: 'comment',
            objectId: $(this).parents('.media').data('id'),
            toUserId: $(this).parents('.person').prev('.media-right').data('id'),
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
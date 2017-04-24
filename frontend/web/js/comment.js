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
                console.log(data);
                var data = data.data;
                var htmls = `  <li class="media">
                                <div class="media-left">
                                    <a href="user/index">
                                        <img class="media-object img-cricle" src=${'http://www.facefrontend.com'  + data.userAvatar} width="45" height="45" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">${data.userName}</h4>
                                    <span>${data.createdTime}</span>
                                    <p>${data.content}</p>
                                </div>
                                <div class="media-right ">
                                    <div class="huifu">
                                        <a href="#">回复</a>
                                    </div>
                                </div>
                                <div class="dev"></div>
                            </li>`;
                $('.media-list').prepend(htmls);

            }
        },
        error: function() {
            alert('error');
        }
    })
});
$('.media-list').on('click', '.huifu a', function() {
    var status = $(this).parents('.media-right').nextAll('.person');
    if (status.css('display') === 'none') {
        $('.person').css({
            display: 'none',
        });
        status.css({
            display: 'block'
        })

    } else {
        status.css({
            display: 'none'
        })
    }

});

$('.person #createComment').on('click', function() {
    $.ajax({
        url: 'index.php?r=comment/create',
        type: 'post',
        dataType: 'json',
        data: {
            content: $(this).parents('.person').children('#comment-text').val(),
            objectType: 'comment',
            objectId: $(this).parents('.media').data('id'),
            toUserId: $(this).parents('.media-right').data('id'),
            _csrf: $('#_csrf').val()
        },
        success: function(data) {

        },
        error: function() {
            alert('error');
        }
    })
});
$('#createComment').on('click', function() {
    $.ajax({
        url: 'index.php?r=comment/create',
        type: 'post',
        dataType: 'json',
        data: {
            content: $('#comment-text').val(),
            objectType: parseInt($('#objectData .objectType').text()),
            objectId: parseInt($('#objectData .objectId').text()),
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
                                    <a href="#">
                                        <img class="media-object img-cricle" src="images/1.jpg" width="45" height="45" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Media heading</h4>
                                    <span>2015年2月1日</span>
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
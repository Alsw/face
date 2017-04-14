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
                console.log(data.data);
            }
        },
        error: function() {
            alert('error');
        }
    })
});
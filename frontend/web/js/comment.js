$('#createComment').on('click', function() {
    alert(123);
    $.ajax({
            url: 'index.php?r=comment',
            type: 'post',
            dataType: 'json',
            data: {
                content: $('#comment-text').val(),
                objectType: $('#objectData .objectId').text(),
                objectId: $('#objectData .objectType').text()
            },
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
});
// $('#createComment').on('click', function() {
//     $.ajax({
//         url: '/index.php?r=comment/create',
//         type: 'post',
//         dataType: 'json',
//         data: {
//             content: $('#comment-text').val(),
//             objectType: $('#objectData .objectId').text(),
//             objectId: $('#objectData .objectType').text(),
//             _csrf: $('#_csrf').val()
//         },
//         success: function(data) {
//             console.log(data);
//         },
//         error: function() {
//             alert('cuowu');
//         }
//     })
// });

$.ajax({
    url: '/index.php?r=comment/create',
    type: 'post',
    dataType: 'json',
    data: {
        content: 123,

    },
    success: function(data) {
        console.log(data);
    },
    error: function() {
        alert('cuowu');
    }
})
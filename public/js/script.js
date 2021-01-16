$(document).ready(function() {
    let resendComment = true;
    let liked = false;
    function sendComment(formData) {
        $.ajax({
            type: "POST",
            url: '/api/comment',
            data: formData, // serializes the form's elements.
            success: function(data)
            {
                if (data.success == 0) {
                    if (resendComment) {
                        resendComment = false;
                        sendComment(formData)
                    } else {
                        $('#comment_info').html('<p class="text-danger">Comment was not sent</p>');
                    }
                } else {
                    $('#comment_info').html('<p class="text-success">Comment was successfully send!</p>')
                }
            },
        });
    }

    $('#comment_form').submit(function (evt) {
        evt.preventDefault();
        let formData = $(this).serialize();
        $(this).remove();
        $('#comment_info').html('<p class="text-warning">Sending Comment ... </p>')
        sendComment(formData)
     });


    $('#likeForm').submit(function (evt) {
        evt.preventDefault();
        if (!liked) {
            liked = true;
            let viewFormData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: '/api/likeArticle',
                data: viewFormData, // serializes the form's elements.
                success: function(data)
                {
                    $('#likesCount').text(data.likes)
                },
            });
        }

     });

    window.setTimeout(function () {
        let viewFormData = $('#viewForm').serialize();
        $.ajax({
            type: "POST",
            url: '/api/addViewCount',
            data: viewFormData, // serializes the form's elements.
            success: function(data)
            {
                $('#viewsCount').text(data.views)
            },
        });
    }, 5000 );
});
